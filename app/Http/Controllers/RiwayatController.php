<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\ServisBarang;
use App\Models\ServisJasa;
use Illuminate\Http\Request;

class RiwayatController extends Controller
{
    public function showPaidOrders()
    {
        $userId = auth()->id(); // Ambil ID user yang sedang login

        $orders = Order::where('user_id', $userId)
            ->where('status', 'paid')
            ->get();

        $jasaBarang = ServisBarang::with('petugas') // Tambahkan eager loading
            ->where('user_id', $userId)
            ->where('status', 'paid')
            ->get();

        $jasaLayanan = ServisJasa::with('petugas')
            ->where('user_id', $userId)
            ->where('status', 'paid')
            ->get();

        return view('home.riwayat', compact('orders', 'jasaBarang', 'jasaLayanan'));
    }

    public function showInvoiceBarang(Request $request)
    {

        $source = $request->query('source', 'riwayat'); // Default 'riwayat' jika tidak ada parameter

        $order = Order::with('items.produk')->where('id', $request->order_id)->first();

        if (!$order) {
            abort(404, 'Invoice tidak ditemukan.');
        }

        return view('home.invoiceBarang', compact('order', 'source'));
    }

    public function showInvoiceServis($order_id, Request $request)
    {
        $source = $request->query('source', 'riwayat'); // Default 'riwayat' jika tidak ada parameter

        $servis = ServisBarang::with('jenisKerusakan', 'jenisBarang', 'user')
            ->where('order_id', $order_id)
            ->first();

        if (!$servis) {
            return abort(404, 'Invoice tidak ditemukan.');
        }

        return view('home.invoiceServis', compact('servis', 'source'));
    }


    public function showInvoiceJasa($order_id, Request $request)
    {

        $source = $request->query('source', 'riwayat'); // Default 'riwayat' jika tidak ada parameter

        $servisJasa = ServisJasa::with('jenisJasa', 'user')
            ->where('order_id', $order_id)
            ->first();

        if (!$servisJasa) {
            return abort(404, 'Invoice tidak ditemukan.');
        }

        return view('home.invoiceJasa', compact('servisJasa', 'source'));
    }
}
