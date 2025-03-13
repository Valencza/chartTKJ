<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Ulasan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UlasanController extends Controller
{
    // Simpan ulasan baru
    public function store(Request $request, $slug)
    {

        // Validasi data ulasan
        $request->validate([
            'deskripsi' => 'required|string|max:500',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        // Cari produk berdasarkan slug
        $produk = Produk::where('slug', $slug)->first();
        if (!$produk) {
            return response()->json(['message' => 'Produk tidak ditemukan'], 404);
        }

        // Simpan ulasan ke database
        $produk->ulasan()->create([
            'id_user' => Auth::id(),
            'id_produk' => $produk->id, // Pastikan kolom id_produk ada
            'rating' => $request->input('rating'),
            'deskripsi' => $request->input('deskripsi'),
        ]);


        return response()->json(['message' => 'Ulasan berhasil disimpan'], 200);
    }
}
