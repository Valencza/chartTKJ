<?php

namespace App\Http\Controllers;

use App\Models\KategoriBarang;
use Illuminate\Http\Request;

class kategoriBarangController extends Controller
{
    public function index()
    {
        $kategoriBarangList = KategoriBarang::all();
        return view('dashboard.kategoriBarang', compact('kategoriBarangList'));
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
        ]);

        try {
            KategoriBarang::create($validatedData);

            return response()->json([
                'success' => true,
                'message' => 'Kategori Barang berhasil ditambahkan.'
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
        $kategoriBarang = KategoriBarang::findOrFail($id);

        // Validate the data
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',    
        ]);

        // Update the produk with the validated data
        $kategoriBarang->update($validatedData);

        return response()->json([
            'success' => true,
            'message' => 'Kategori Barang berhasil diperbarui.'
        ]);
    }

    public function destroy($id)
    {
        $kategoriBarang = KategoriBarang::find($id);

        if ($kategoriBarang) {

            // Hapus data produk
            $kategoriBarang->delete();

            return response()->json(['success' => true, 'message' => 'Kategori Barang berhasil dihapus']);
        }

        return response()->json(['success' => false, 'message' => 'Kategori Barang tidak ditemukan']);
    }
}
