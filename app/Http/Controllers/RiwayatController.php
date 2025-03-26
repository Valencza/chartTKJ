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
        $jasaBarang = ServisBarang::where('user_id', $userId)
            ->where('status', 'paid')
            ->get();

            $jasaLayanan = ServisJasa::where('user_id', $userId)
            ->where('status', 'paid')
            ->get();

        return view('home.riwayat', compact('orders', 'jasaBarang', 'jasaLayanan'));
    }
}
