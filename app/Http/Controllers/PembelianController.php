<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\KategoriProduk;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PembelianController extends Controller
{

    public function index($kategori = null)
    {
        $kategoriProdukList = KategoriProduk::all();

        // Ambil produk sesuai kategori, atau semua jika kategori tidak dipilih
        $produkShow = $kategori
            ? Produk::where('kategori_id', $kategori)->get()
            : Produk::all();

        return view('home.pembelian', compact('produkShow', 'kategoriProdukList'));
    }

    public function show($slug)
    {
        // Ambil data produk berdasarkan slug
        $produk = Produk::where('slug', $slug)->firstOrFail();

        // Hitung rata-rata rating dari tabel ulasan berdasarkan id_produk
        $totalRating = \App\Models\Ulasan::where('id_produk', $produk->id)->avg('rating') ?? 0;

        // Kirim data ke view
        return view('home.detail-produk', compact('produk', 'totalRating'));
    }

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

}
