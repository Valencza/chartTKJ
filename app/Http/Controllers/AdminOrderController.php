<?php

namespace App\Http\Controllers;

use App\Models\Order;
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
            'status' => 'required|in:pending,paid,canceled',
        ]);

        // Cari order berdasarkan ID
        $order = Order::findOrFail($id);

        // Simpan status lama untuk perbandingan
        $oldStatus = $order->status;

        // Update status order
        $order->status = $request->input('status');
        $order->save();

        // Jika status order berubah menjadi 'paid', perbarui stok produk
        if ($order->status == 'paid' && $oldStatus != 'paid') {
            // Loop untuk setiap item dalam order
            foreach ($order->items as $item) {
                // Ambil produk terkait
                $produk = $item->produk;

                // Pastikan produk ada
                if ($produk) {
                    // Kurangi stok_in dan tambahkan stok_out berdasarkan jumlah produk yang dibeli
                    $produk->stok_in -= $item->jumlah;
                    $produk->stok_out += $item->jumlah;

                    // Simpan perubahan stok produk
                    $produk->save();
                }
            }
        }

        // Mengembalikan response JSON, bisa berupa pesan sukses atau kesalahan
        return response()->json([
            'success' => true,
            'message' => 'Status order berhasil diperbarui.',
        ]);
    }
}