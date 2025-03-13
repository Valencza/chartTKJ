<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    // 🔹 Menambahkan Produk ke Keranjang
    public function addToCart(Request $request)
    {
        // Validasi inputan
        $validated = $request->validate([
            'produk_id' => 'required|exists:produk,id', // Pastikan produk ada
            'jumlah' => 'required|integer|min:1', // Pastikan jumlah adalah integer positif
        ]);

        $user = Auth::user();

        // Pastikan user sudah login
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Silakan login terlebih dahulu.']);
        }

        // Cek apakah produk sudah ada di keranjang
        $cart = Cart::where('user_id', $user->id)
            ->where('produk_id', $request->produk_id)
            ->first();

        if ($cart) {
            // Jika sudah ada, tambahkan jumlah
            $cart->increment('jumlah', $request->jumlah);
        } else {
            // Jika belum ada, buat baru
            Cart::create([
                'user_id' => $user->id,
                'produk_id' => $request->produk_id,
                'jumlah' => $request->jumlah
            ]);
        }

        // Mengirimkan data cart yang sudah diperbarui
        return response()->json([
            'success' => true,
            'message' => 'Produk berhasil ditambahkan ke keranjang!',
            'cart' => Cart::where('user_id', $user->id)->with('produk')->get() // Mengirimkan data cart yang terbaru
        ]);
    }

    public function getCart()
    {
        $user = auth()->user();

        // Pastikan user sudah login
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Silakan login terlebih dahulu.']);
        }

        // Ambil hanya produk yang ditambahkan oleh user yang login
        $cart = Cart::where('user_id', $user->id)->with('produk')->get();

        return response()->json([
            'success' => true,
            'cart' => $cart
        ]);
    }


    // 🔹 Menghapus Produk dari Keranjang
    public function removeFromCart($id)
    {
        $user = auth()->user();

        // Pastikan user sudah login
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Silakan login terlebih dahulu.']);
        }

        // Cari item di keranjang milik user yang sedang login
        $cartItem = Cart::where('id', $id)->where('user_id', $user->id)->first();

        if ($cartItem) {
            $cartItem->delete();
            return response()->json(['success' => true, 'message' => 'Item dihapus dari keranjang']);
        }

        return response()->json(['success' => false, 'message' => 'Item tidak ditemukan atau bukan milik Anda']);
    }
}
