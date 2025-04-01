<?php

namespace App\Http\Controllers;

use App\Models\KategoriProduk;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminStokController extends Controller
{
    public function index()
    {
        $produkList = Produk::all();
        $kategoriProdukList = KategoriProduk::all(); // Ambil semua kategori
        return view('dashboard.stok', compact('produkList', 'kategoriProdukList'));
    }

    public function update(Request $request, $id)
    {
        try {
            $produk = Produk::findOrFail($id);

            $validatedData = $request->validate([
                'stok_in' => 'required|integer|min:0',
            ]);

            $produk->update($validatedData);

            return response()->json([
                'success' => true,
                'message' => 'Stok berhasil diperbarui.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Kesalahan server: ' . $e->getMessage(),
            ]);
        }
    }

}
