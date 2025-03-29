<?php

namespace App\Http\Controllers;

use App\Models\jenisBarang;
use App\Models\jenisKerusakan;
use App\Models\jenisLayanan;
use App\Models\Portofolio;
use App\Models\ServisBarang;
use App\Models\ServisJasa;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;
use Illuminate\Support\Str; // Tambahkan di atas controller untuk membuat UUID
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class serviceController extends Controller
{

    public function index()
    {
        $jenisBarang = jenisBarang::all(); // Ambil semua jenis barang
        $jenisKerusakan = JenisKerusakan::select('id', 'id_jenisBarang as barang_id', 'nama', 'harga')->get(); // Ambil id, barang_id, dan nama jenis kerusakan
        $jenisLayanan = jenisLayanan::all();
        $portfolios = Portofolio::latest()->take(3)->get(); // Ambil 3 data terbaru

        return view('home.service', compact('jenisBarang', 'jenisKerusakan', 'jenisLayanan', 'portfolios'));
    }

    public function getJenisKerusakan($barang_id)
    {
        $kerusakan = JenisKerusakan::where('id_jenisBarang', $barang_id)->get(); // Pastikan field-nya benar

        if ($kerusakan->isEmpty()) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        return response()->json($kerusakan);
    }

    public function storeServisBarang(Request $request)
    {
        $request->validate([
            'telepon' => 'required|string',
            'barang_id' => 'required|exists:jenis_barang,id',
            'jenis_kerusakan_id' => 'required|exists:jenis_kerusakan,id',
            'merk' => 'required|string',
            'kerusakan' => 'nullable|string',
            'harga' => 'required|string',
            'status' => 'required',
            'proses' => 'required',
            'backUp' => 'nullable|in:iya,tidak',
            'password' => 'nullable|string',
        ]);

        // Konversi harga ke angka (hapus Rp, titik, dll.)
        $harga = preg_replace('/[^\d]/', '', $request->harga);

        $orderID = 'ORD-' . Str::upper(Str::random(10)); // Generate Order ID

        // Simpan ke database
        $servis = ServisBarang::create([
            'order_id' => $orderID,
            'user_id' => auth()->id(),
            'telepon' => $request->telepon,
            'barang_id' => $request->barang_id,
            'jenis_kerusakan_id' => $request->jenis_kerusakan_id,
            'merk' => $request->merk,
            'kerusakan' => $request->kerusakan,
            'harga' => $harga,
            'status' => $request->status,
            'proses' => $request->proses,
            'backUp' => $request->backUp, // Tambahkan backUp
            'password' => $request->password, // Tambahkan password
        ]);

        // Proses pembayaran dengan Midtrans
        return $this->payServisBarang($servis);
    }


    public function payServisBarang($servis)
    {
        // Konfigurasi Midtrans
        \Midtrans\Config::$serverKey = config('services.midtrans.server_key');
        \Midtrans\Config::$isProduction = config('services.midtrans.is_production');
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        // Data transaksi ke Midtrans
        $transaction = [
            'transaction_details' => [
                'order_id' => $servis->order_id,
                'gross_amount' => (int) $servis->harga,
            ],
            'customer_details' => [
                'first_name' => auth()->user()->nama ?? 'Pelanggan',
                'phone' => $servis->telepon,
            ],
            'callbacks' => [
                'finish' => route('serviceBarang.paymentCallback', ['order_id' => $servis->order_id]), // Callback ke fungsi pembayaran
            ],
        ];

        try {
            $snapToken = \Midtrans\Snap::getSnapToken($transaction);
            return response()->json(['token' => $snapToken]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function paymentCallbackServis(Request $request)
    {
        $order_id = $request->order_id;
        $transaction_status = $request->transaction_status;

        // Ambil data servis
        $servis = ServisBarang::where('order_id', $order_id)->first();

        if (!$servis) {
            return abort(404, 'Data servis tidak ditemukan.');
        }

        // Update status berdasarkan status transaksi Midtrans
        if ($transaction_status == 'settlement' || $transaction_status == 'capture') {
            $servis->status = 'paid'; // Pembayaran sukses
        } elseif ($transaction_status == 'pending') {
            $servis->status = 'pending'; // Masih menunggu pembayaran
        } elseif ($transaction_status == 'deny' || $transaction_status == 'expire' || $transaction_status == 'cancel') {
            $servis->status = 'failed'; // Pembayaran gagal
        }

        $servis->save();

        return redirect()->route('serviceBarang.invoice', ['order_id' => $order_id]);
    }

    public function showInvoiceServis($order_id, Request $request)
    {
        $servis = ServisBarang::with('jenisKerusakan', 'jenisBarang', 'user')
            ->where('order_id', $order_id)
            ->first();

        $source = $request->query('source', 'riwayat'); // Default 'riwayat' jika tidak ada parameter


        if (!$servis) {
            return abort(404, 'Invoice tidak ditemukan.');
        }

        return view('home.invoiceServis', compact('servis', 'source'));
    }

    public function downloadInvoiceServisBarang($order_id)
    {
        $servis = ServisBarang::where('order_id', $order_id)->first();

        $pdf = PDF::loadView('home.invoiceBarang-pdf', compact('servis'));
        return $pdf->download('invoiceServis_' . $servis->order_id . '.pdf');
    }

    public function getHargaLayanan($id)
    {
        $layanan = jenisLayanan::find($id);

        // Debugging output
        if ($layanan) {
            dd($layanan);  // Melihat isi data layanan yang diambil
            return response()->json(['harga' => $layanan->harga]);
        }

        return response()->json(['message' => 'Layanan tidak ditemukan'], 404);
    }


    // Menyimpan data servis layanan
    public function storeServisLayanan(Request $request)
    {

        $request->validate([
            'alamat' => 'required|string',
            'telepon' => 'required|string',
            'jenisJasa' => 'required|exists:jenis_layanan,id',
            'deskripsi' => 'required|string',
            'tanggal' => 'required|date',
        ]);

        $layanan = JenisLayanan::findOrFail($request->jenisJasa);

        $orderID = 'ORD-' . strtoupper(uniqid());

        $servisJasa = ServisJasa::create([
            'order_id' => $orderID,
            'user_id' => auth()->id(),
            'nama' => auth()->user()->nama,
            'alamat' => $request->alamat,
            'telepon' => $request->telepon,
            'jenis_jasa_id' => $request->jenisJasa,
            'deskripsi' => $request->deskripsi,
            'tanggal' => $request->tanggal,
            'harga' => $layanan->harga,
            'status' => 'pending',
            'proses' => 'Menunggu',
        ]);

        return $this->payServisLayanan($servisJasa);
    }

    public function payServisLayanan($servisJasa)
    {
        // Konfigurasi Midtrans
        \Midtrans\Config::$serverKey = config('services.midtrans.server_key');
        \Midtrans\Config::$isProduction = config('services.midtrans.is_production');
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        $transaction = [
            'transaction_details' => [
                'order_id' => $servisJasa->order_id,
                'gross_amount' => (int) $servisJasa->harga,
            ],
            'customer_details' => [
                'first_name' => auth()->user()->nama ?? 'Pelanggan',
                'phone' => $servisJasa->telepon,
            ],
            'callbacks' => [
                'finish' => route('serviceLayanan.paymentCallback', ['order_id' => $servisJasa->order_id]), // Callback ke fungsi pembayaran
            ],
        ];

        try {
            $snapToken = \Midtrans\Snap::getSnapToken($transaction);
            return response()->json(['token' => $snapToken]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function paymentCallbackLayanan(Request $request)
    {
        $order_id = $request->order_id;
        $transaction_status = $request->transaction_status;

        // Ambil data servis
        $servisJasa = ServisJasa::where('order_id', $order_id)->first();

        if (!$servisJasa) {
            return abort(404, 'Data servis tidak ditemukan.');
        }

        // Update status berdasarkan status transaksi Midtrans
        if ($transaction_status == 'settlement' || $transaction_status == 'capture') {
            $servisJasa->status = 'paid'; // Pembayaran sukses
        } elseif ($transaction_status == 'pending') {
            $servisJasa->status = 'pending'; // Masih menunggu pembayaran
        } elseif ($transaction_status == 'deny' || $transaction_status == 'expire' || $transaction_status == 'cancel') {
            $servisJasa->status = 'failed'; // Pembayaran gagal
        }

        $servisJasa->save();

        return redirect()->route('serviceLayanan.invoice', ['order_id' => $order_id]);
    }

    public function showInvoiceLayanan($order_id, Request $request)
    {
        $servisJasa = ServisJasa::with('jenisJasa', 'user')
            ->where('order_id', $order_id)
            ->first();

        $source = $request->query('source', 'riwayat'); // Default 'riwayat' jika tidak ada parameter

        if (!$servisJasa) {
            return abort(404, 'Invoice tidak ditemukan.');
        }

        return view('home.invoiceJasa', compact('servisJasa'));
    }

    public function downloadInvoiceServisLayanan($order_id)
    {
        $servisJasa = ServisJasa::where('order_id', $order_id)->first();

        $pdf = PDF::loadView('home.invoiceJasa-pdf', compact('servisJasa'));
        return $pdf->download('invoiceLayanan_' . $servisJasa->order_id . '.pdf');
    }
}
