<?php

namespace App\Http\Controllers;

use App\Models\jenisBarang;
use Illuminate\Http\Request;

class jenisBarangController extends Controller
{
    public function index()
    {
        $jenisBarangList = jenisBarang::all();
        return view('dashboard.kategoriBarang', compact('jenisBarangList'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        try {
            jenisBarang::create($validatedData);

            return response()->json([
                'success' => true,
                'message' => 'Jenis Barang berhasil ditambahkan.'
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
        $jenisBarang = jenisBarang::findOrFail($id);

        // Validate the data
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        // Update the produk with the validated data
        $jenisBarang->update($validatedData);

        return response()->json([
            'success' => true,
            'message' => 'Jenis Barang berhasil diperbarui.'
        ]);
    }

    public function destroy($id)
    {
        $jenisBarang = jenisBarang::find($id);

        if ($jenisBarang) {

            // Hapus data produk
            $jenisBarang->delete();

            return response()->json(['success' => true, 'message' => 'Jenis Barang berhasil dihapus']);
        }

        return response()->json(['success' => false, 'message' => 'Jenis Barang tidak ditemukan']);
    }
}
