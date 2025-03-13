<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\KategoriProduk;
use App\Models\Produk;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index()
    {
        $produkList = Produk::all();
        $kategoriProdukList = KategoriProduk::all(); // Ambil semua kategori
        return view('dashboard.produk', compact('produkList', 'kategoriProdukList'));
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'id_kategoriProduk' => 'required|exists:kategori_produk,id',
                'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                'nama' => 'required|string|max:255',
                'harga' => 'required|numeric|min:0',
                'deskripsi' => 'required|string',
                'spesifikasi' => 'nullable|string',
                'stok_out' => 'required|integer|min:0',
                'stok_in' => 'required|integer|min:0',
            ]);

            if ($request->hasFile('gambar')) {
                $imagePath = $request->file('gambar')->store('img/produk', 'public');
                $validatedData['gambar'] = $imagePath;
            }

            Produk::create($validatedData);

            return response()->json([
                'success' => true,
                'message' => 'Produk berhasil ditambahkan.'
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
        $produk = Produk::findOrFail($id);

        $validatedData = $request->validate([
            'id_kategoriProduk' => 'required|exists:kategori_produk,id',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,gif,svg|max:2048',
            'nama' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'deskripsi' => 'required|string',
            'spesifikasi' => 'required|string',
            'stok_out' => 'required|integer',
            'stok_in' => 'required|integer',
        ]);

        if ($request->hasFile('gambar')) {
            if ($produk->gambar && Storage::exists('public/' . $produk->gambar)) {
                Storage::delete('public/' . $produk->gambar);
            }
            $imagePath = $request->file('gambar')->store('img/produk', 'public');
            $validatedData['gambar'] = $imagePath;
        }

        $produk->update($validatedData);

        return response()->json([
            'success' => true,
            'message' => 'Produk berhasil diperbarui.'
        ]);
    }


    public function destroy($id)
    {
        $produk = Produk::find($id);

        if ($produk) {
            // Cek jika gambar ada dan hapus dari storage
            if ($produk->gambar && Storage::exists('public/' . $produk->gambar)) {
                Storage::delete('public/' . $produk->gambar);
            }

            // Hapus data produk
            $produk->delete();

            return response()->json(['success' => true, 'message' => 'Produk berhasil dihapus']);
        }

        return response()->json(['success' => false, 'message' => 'Produk tidak ditemukan']);
    }
}
