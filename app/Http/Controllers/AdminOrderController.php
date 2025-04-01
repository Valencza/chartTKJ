<?php

namespace App\Http\Controllers;

use App\Models\Notifikasi;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    public function index()
    {
        // Memuat relasi order-item dan produk
        $orders = Order::with(['items.produk', 'pembeli'])->get();  // Memuat OrderItem dan relasi produk serta pembeli
        return view('dashboard.order', compact('orders'));
    }

    // Method untuk update status order
    public function update(Request $request, $id)
    {
        // Validasi input status
        $request->validate([
            'status' => 'required|in:paid,pending,canceled',
        ]);

        // Cari order berdasarkan ID
        $order = Order::findOrFail($id);

        // Simpan status lama untuk perbandingan
        $oldStatus = $order->status;

        // Update status order
        $order->status = $request->input('status');
        $order->save();

        // Jika status order berubah menjadi 'paid', perbarui stok produk & buat notifikasi
        if ($order->status == 'paid' && $oldStatus != 'paid') {
            foreach ($order->items as $item) {
                $produk = $item->produk; // Ambil data produk dari order_item

                // Pastikan produk ada
                if ($produk) {
                    // Kurangi stok_in dan tambahkan stok_out berdasarkan jumlah produk yang dibeli
                    $produk->stok_in -= $item->jumlah;
                    $produk->stok_out += $item->jumlah;
                    $produk->save();

                    // **Notifikasi untuk User**
                    Notifikasi::create([
                        'user_id'  => $order->user_id, // Mengambil user yang melakukan order
                        'order_id' => $order->id, // Menggunakan ID dari Order
                        'pesan'    => "Anda telah membayar pesanan produk {$produk->nama} sebanyak {$item->jumlah} item dengan total Rp " . number_format($item->jumlah * $produk->harga, 0, ',', '.'),
                        'status'   => null, // Pastikan ini sesuai dengan database (nullable atau default)
                        'type'     => 'orders', // Pastikan ini sesuai dengan database
                    ]);

                    // **Notifikasi untuk Admin**
                    // Cek role user untuk menentukan siapa yang akan menerima notifikasi
                    $admin = User::where('role', 'admin')->first(); // Ambil user dengan role admin

                    if ($admin) {
                        Notifikasi::create([
                            'user_id'  => $admin->id, // ID admin yang menerima notifikasi
                            'order_id' => $order->id, // Menggunakan ID dari Order
                            'pesan'    => "Pesanan dengan ID {$order->id} telah dibayar oleh {$order->user->nama}. Produk yang dibeli: {$produk->nama} sebanyak {$item->jumlah} item dengan total Rp " . number_format($item->jumlah * $produk->harga, 0, ',', '.'),
                            'status'   => null, // Pastikan ini sesuai dengan database (nullable atau default)
                            'type'     => 'orders', // Pastikan ini sesuai dengan database
                        ]);
                    }
                }
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Status order berhasil diperbarui dan notifikasi telah dikirim.',
        ]);
    }
}
