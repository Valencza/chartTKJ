<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Produk;
use App\Models\User;
use Illuminate\Http\Request;

class AdminNotifikasiProdukController extends Controller
{
    public function index()
    {
        // Ambil semua order yang memiliki produk_id pada OrderItem dan notifikasi dengan order_id yang tidak null
        $notifikasiOrder = Order::whereHas('items', function ($query) {
            $query->whereNotNull('produk_id'); // Memastikan hanya OrderItem yang memiliki produk_id yang tidak null
        })
            ->with(['notifikasi' => function ($query) {
                // Jika Anda mengganti produk_id dengan order_id pada notifikasi
                $query->whereNotNull('order_id'); // Memastikan hanya notifikasi yang memiliki order_id yang tidak null
            }, 'user', 'items.produk']) // Termasuk relasi produk pada items
            ->get();

        return view('dashboard.notifikasiProduk', compact('notifikasiOrder'));
    }
}
