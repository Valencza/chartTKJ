<?php

namespace App\Http\Controllers;

use App\Models\KategoriJasa;
use Illuminate\Http\Request;

class kategoriJasaController extends Controller
{
    public function index()
    {
        $kategoriJasaList = KategoriJasa::all();
        return view('dashboard.kategoriJasa', compact('kategoriJasaList'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
        ]);

        try {
            KategoriJasa::create($validatedData);

            return response()->json([
                'success' => true,
                'message' => 'Kategori Jasa berhasil ditambahkan.'
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
        $kategoriJasa = KategoriJasa::findOrFail($id);

        // Validate the data
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
        ]);

        // Update the produk with the validated data
        $kategoriJasa->update($validatedData);

        return response()->json([
            'success' => true,
            'message' => 'Kategori Jasa berhasil diperbarui.'
        ]);
    }

    public function destroy($id)
    {
        $kategoriJasa = KategoriJasa::find($id);

        if ($kategoriJasa) {

            // Hapus data produk
            $kategoriJasa->delete();

            return response()->json(['success' => true, 'message' => 'Kategori Jasa berhasil dihapus']);
        }

        return response()->json(['success' => false, 'message' => 'Kategori Jasa tidak ditemukan']);
    }
}
