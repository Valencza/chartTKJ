<?php

namespace App\Http\Controllers;

use App\Models\jenisLayanan;
use Illuminate\Http\Request;

class jenisLayananController extends Controller
{
    public function index()
    {
        $jenisLayananList = jenisLayanan::all();
        return view('dashboard.jasaLayanan', compact('jenisLayananList'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
        ]);

        try {
            jenisLayanan::create($validatedData);

            return response()->json([
                'success' => true,
                'message' => 'Jasa Layanan berhasil ditambahkan.'
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
        $jenisLayanan = jenisLayanan::findOrFail($id);

        // Validate the data
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',    
        ]);

        // Update the produk with the validated data
        $jenisLayanan->update($validatedData);

        return response()->json([
            'success' => true,
            'message' => 'Jasa Layanan berhasil diperbarui.'
        ]);
    }

    public function destroy($id)
    {
        $jenisLayanan = jenisLayanan::find($id);

        if ($jenisLayanan) {

            // Hapus data produk
            $jenisLayanan->delete();

            return response()->json(['success' => true, 'message' => 'Jasa Layanan berhasil dihapus']);
        }

        return response()->json(['success' => false, 'message' => 'Jasa Layanan tidak ditemukan']);
    }
}
