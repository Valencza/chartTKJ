<?php

namespace App\Http\Controllers;

use App\Models\KategoriProduk;
use Illuminate\Http\Request;

class KategoriProdukController extends Controller
{
    public function index()
    {
        $kategoriProdukList = KategoriProduk::all();
        return view('dashboard.kategoriProduk', compact('kategoriProdukList'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        try {
            KategoriProduk::create($validatedData);

            return response()->json([
                'success' => true,
                'message' => 'Kategori Produk berhasil ditambahkan.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan pada server.'
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        $kategoriProduk = KategoriProduk::findOrFail($id);

        // Validate the data
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        // Update the produk with the validated data
        $kategoriProduk->update($validatedData);

        return response()->json([
            'success' => true,
            'message' => 'Kategori Produk berhasil diperbarui.'
        ]);
    }

    public function destroy($id)
    {
        $kategoriProduk = KategoriProduk::find($id);

        if ($kategoriProduk) {

            // Hapus data produk
            $kategoriProduk->delete();

            return response()->json(['success' => true, 'message' => 'Kategori Produk berhasil dihapus']);
        }

        return response()->json(['success' => false, 'message' => 'Kategori Produk tidak ditemukan']);
    }
}
