<?php

namespace App\Http\Controllers;

use App\Models\jenisBarang;
use App\Models\jenisKerusakan;
use Illuminate\Http\Request;

class jenisKerusakanController extends Controller
{
    public function index()
    {
        $jenisKerusakanList = jenisKerusakan::all();
        $jenisBarangList = jenisBarang::all(); // Ambil semua kategori
        return view('dashboard.jasaKerusakan', compact('jenisKerusakanList', 'jenisBarangList'));
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'id_jenisBarang' => 'required|exists:jenis_barang,id',
                'nama' => 'required|string|max:255',
                'harga' => 'required|numeric|min:0',
            ]);

            jenisKerusakan::create($validatedData);

            return response()->json([
                'success' => true,
                'message' => 'Jenis Kerusakan berhasil ditambahkan.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Kesalahan server: ' . $e->getMessage(),
            ]);
        }
    }


    public function update(Request $request, $id)
    {
        $jenisKerusakan = jenisKerusakan::findOrFail($id);

        $validatedData = $request->validate([
            'id_jenisBarang' => 'required|exists:jenis_barang,id',
            'nama' => 'required|string|max:255',
            'harga' => 'required|numeric',
        ]);

        $jenisKerusakan->update($validatedData);

        return response()->json([
            'success' => true,
            'message' => 'Jenis Kerusakan berhasil diperbarui.'
        ]);
    }

    public function destroy($id)
    {
        $jenisKerusakan = jenisKerusakan::find($id);

        if ($jenisKerusakan) {

            // Hapus data produk
            $jenisKerusakan->delete();

            return response()->json(['success' => true, 'message' => 'Jenis Kerusakan berhasil dihapus']);
        }

        return response()->json(['success' => false, 'message' => 'Jenis Kerusakan tidak ditemukan']);
    }
}
