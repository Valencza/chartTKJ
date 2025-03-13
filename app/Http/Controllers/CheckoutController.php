<?php

namespace App\Http\Controllers;

use Midtrans\Config;
use Midtrans\Snap;
use App\Models\Alamat;
use App\Models\Cart;
use App\Models\Checkout;
use App\Models\CheckoutDetail;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CheckoutController extends Controller
{
    public function __construct()
    {
        // Konfigurasi Midtrans
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = false; // Ubah ke true jika sudah di produksi
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    public function index($slug, Request $request)
    {
        $user = Auth::user();
        $alamatList = Alamat::where('id_user', Auth::id())->get();

        // Ambil produk berdasarkan slug
        $produk = Produk::where('slug', $slug)->firstOrFail();

        // Ambil jumlah dari request, default ke 1
        $jumlah = max(1, (int) $request->input('jumlah', 1));

        // Validasi stok
        if ($jumlah > $produk->stok_in) {
            return redirect()->back()->with('error', 'Jumlah melebihi stok yang tersedia.');
        }

        // Hitung subtotal
        $subtotal = $produk->harga * $jumlah;
        $diskon = 0; // Kosongkan diskon
        $total = $subtotal - $diskon; // Total pembayaran

        // Simpan produk yang dibeli dalam $keranjang
        $keranjang = [
            [
                'produk' => $produk,
                'jumlah' => $jumlah,
                'subtotal' => $subtotal
            ]
        ];

        return view('home.checkout', compact('user', 'alamatList', 'produk', 'jumlah', 'subtotal', 'diskon', 'total', 'keranjang'));
    }

    public function store(Request $request)
    {
        try {
            Log::info('Data diterima di CheckoutController:', $request->all());

            // Validasi
            $request->validate([
                'produk_id' => 'required|array',
                'produk_id.*' => 'exists:produk,id',
                'jumlah' => 'required|array',
                'jumlah.*' => 'integer|min:1',
                'alamat' => 'required|exists:alamat,id'
            ]);

            // Konfigurasi Midtrans
            \Midtrans\Config::$serverKey = config('services.midtrans.server_key');
            \Midtrans\Config::$isProduction = config('services.midtrans.is_production');
            \Midtrans\Config::$isSanitized = true;
            \Midtrans\Config::$is3ds = true;

            // Ambil user yang sedang login
            $user = Auth::user();
            $email = $user->email; // Email diambil dari users

            // Ambil data alamat
            $alamat = \App\Models\Alamat::findOrFail($request->alamat);
            $noTelpon = $alamat->no_telpon; // No telpon diambil dari alamat

            $totalHarga = 0;
            $orderItems = [];

            foreach ($request->produk_id as $index => $produkId) {
                $produk = \App\Models\Produk::find($produkId);
                if (!$produk) {
                    return response()->json(['error' => 'Produk tidak ditemukan'], 400);
                }
                $totalHarga += $produk->harga * $request->jumlah[$index];

                $orderItems[] = [
                    'id' => $produk->id,
                    'name' => $produk->nama,
                    'price' => $produk->harga,
                    'quantity' => $request->jumlah[$index]
                ];
            }

            // Simpan Order
            $order = new \App\Models\Order();
            $order->user_id = $user->id;
            $order->alamat_id = $request->alamat;
            $order->total = $totalHarga;
            $order->status = 'pending';
            $order->save();

            // Simpan detail produk ke tabel order_items
            foreach ($request->produk_id as $index => $produkId) {
                $produk = \App\Models\Produk::find($produkId);
                if ($produk) {
                    \App\Models\OrderItem::create([
                        'order_id' => $order->id,
                        'produk_id' => $produk->id,
                        'jumlah' => $request->jumlah[$index],
                        'harga' => $produk->harga, // Harga per unit
                        'subtotal' => $produk->harga * $request->jumlah[$index], // Total harga per item
                    ]);
                }
            }

            // Buat transaksi Midtrans
            $transaction = [
                'transaction_details' => [
                    'order_id' => $order->id,
                    'gross_amount' => $totalHarga,
                ],
                'customer_details' => [
                    'first_name' => $alamat->nama, // Nama diambil dari alamat
                    'email' => $email, // Email diambil dari users
                    'phone' => $noTelpon, // No telpon diambil dari alamat
                ],
                'item_details' => $orderItems,
            ];

            $snapToken = \Midtrans\Snap::getSnapToken($transaction);
            Log::info('Snap Token:', ['snapToken' => $snapToken]);

            return response()->json(['snapToken' => $snapToken]);
        } catch (\Exception $e) {
            Log::error('Checkout Error:', ['message' => $e->getMessage()]);
            return response()->json(['error' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    public function callback(Request $request)
    {
        try {
            // Ambil Server Key dari konfigurasi
            $serverKey = config('services.midtrans.server_key');

            // Validasi signature key
            $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);
            if ($hashed !== $request->signature_key) {
                Log::warning("Signature key tidak valid untuk Order ID: " . $request->order_id);
                return response()->json(['error' => 'Invalid signature key'], 403);
            }

            // Cari order berdasarkan order_id
            $order = Order::find($request->order_id);
            if (!$order) {
                Log::error("Order tidak ditemukan: " . $request->order_id);
                return response()->json(['error' => 'Order not found'], 404);
            }

            // Cek status transaksi
            switch ($request->transaction_status) {
                case 'capture':
                case 'settlement':
                    // Perbarui status order menjadi "paid"
                    $order->update(['status' => 'paid']);
                    \Log::info("Order berhasil dibayar: " . $order->id);

                    // Kurangi stok produk setelah pembayaran berhasil
                    foreach ($order->items as $item) {
                        $produk = Produk::find($item->produk_id);
                        if ($produk) {
                            $produk->stok -= $item->jumlah;
                            $produk->save();
                        }
                    }
                    \Log::info("Stok produk diperbarui untuk Order ID: " . $order->id);
                    break;

                case 'pending':
                    // Status tetap "pending", stok tidak berubah
                    $order->update(['status' => 'pending']);
                    Log::info("Order masih pending: " . $order->id);
                    break;

                case 'deny':
                case 'cancel':
                case 'expire':
                    // Jika pembayaran gagal/expired, status order menjadi "canceled"
                    $order->update(['status' => 'canceled']);
                    Log::warning("Order dibatalkan/expired: " . $order->id);
                    break;

                default:
                    Log::warning("Status transaksi tidak dikenali untuk Order ID: " . $order->id);
                    return response()->json(['error' => 'Unknown transaction status'], 400);
            }

            return response()->json(['message' => 'Transaction processed'], 200);
        } catch (\Exception $e) {
            Log::error("Error di Callback Midtrans: " . $e->getMessage());
            return response()->json(['error' => 'Terjadi kesalahan'], 500);
        }
    }
}
