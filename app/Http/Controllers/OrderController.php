<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // Menampilkan daftar order pengguna yang sedang login
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();

        return view('home.orders', compact('orders'));
    }

    // Menampilkan detail order berdasarkan ID
    public function show($id)
    {
        $order = Order::with('items.produk')->where('user_id', Auth::id())->findOrFail($id);

        return view('home.order_detail', compact('order'));
    }
}
