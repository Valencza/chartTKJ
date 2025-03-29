<?php

namespace App\Http\Controllers;

use App\Models\KategoriProduk;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class ProdukController extends Controller
{
    public function index()
    {
        $produkList = Produk::all();
        $kategoriProdukList = KategoriProduk::all(); // Ambil semua kategori
        return view('dashboard.produk', compact('produkList', 'kategoriProdukList'));
    }

    public function getProduct($id)
    {
        $product = Produk::with('kategori')->findOrFail($id);
        return response()->json($product);
    }

    public function store(Request $request)
    {
        try {
            // Validasi data
            $validatedData = $request->validate([
                'id_kategoriProduk' => 'required|exists:kategori_produk,id',
                'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                'nama' => 'required|string|max:255',
                'harga' => 'required|numeric|min:0',
                'deskripsi' => 'required|string',
                'stok_out' => 'required|integer|min:0',
                'stok_in' => 'required|integer|min:0',
            ]);

            // Proses upload gambar dengan kompresi (optional)
            if ($request->hasFile('gambar')) {
                $image = $request->file('gambar');
                $namaFile = Str::slug($request->nama) . '-' . time() . '.' . $image->getClientOriginalExtension();

                // Simpan gambar ke storage/app/public/img/produk
                $image->storeAs('public/img/produk', $namaFile);

                // Simpan path gambar ke database (tanpa 'public/' agar sesuai dengan asset storage)
                $validatedData['gambar'] = 'img/produk/' . $namaFile;
            }

            // Handle spesifikasi (Mendukung lebih dari 1 spesifikasi) //
            $spesifikasi = [];
            if ($request->has('spesifikasi_key') && $request->has('spesifikasi_value')) {
                foreach ($request->spesifikasi_key as $index => $key) {
                    if (!empty($key) && !empty($request->spesifikasi_value[$index])) {
                        // Menyimpan dalam bentuk key-value JSON
                        $spesifikasi[$key] = $request->spesifikasi_value[$index];
                    }
                }
            }

            // Simpan spesifikasi sebagai JSON, jika kosong maka simpan array kosong
            $validatedData['spesifikasi'] = !empty($spesifikasi) ? json_encode($spesifikasi) : json_encode([]);

            // Create product
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
        try {
            $produk = Produk::findOrFail($id);

            $validatedData = $request->validate([
                'id_kategoriProduk' => 'required|exists:kategori_produk,id',
                'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'nama' => 'required|string|max:255',
                'harga' => 'required|numeric|min:0',
                'deskripsi' => 'required|string',
                'stok_out' => 'required|integer|min:0',
                'stok_in' => 'required|integer|min:0',
            ]);

            // Jika ada gambar baru, hapus gambar lama
            if ($request->hasFile('gambar')) {
                // Hapus gambar lama jika ada
                if ($produk->gambar && Storage::exists('public/' . $produk->gambar)) {
                    Storage::delete('public/' . $produk->gambar);
                }

                // Proses upload gambar baru
                $image = $request->file('gambar');
                $namaFile = Str::slug($request->nama) . '-' . time() . '.' . $image->getClientOriginalExtension();
                $imagePath = 'img/produk/' . $namaFile;

                // Simpan gambar baru
                $image->storeAs('public/img/produk', $namaFile);

                // Simpan path ke database
                $validatedData['gambar'] = 'img/produk/' . $namaFile;
            }


            // Simpan spesifikasi dalam JSON
            if ($request->has('spesifikasi_key') && $request->has('spesifikasi_value')) {
                $spesifikasi = [];
                foreach ($request->spesifikasi_key as $index => $key) {
                    if (!empty($key) && !empty($request->spesifikasi_value[$index])) {
                        $spesifikasi[$key] = $request->spesifikasi_value[$index];
                    }
                }
                $validatedData['spesifikasi'] = json_encode($spesifikasi);
            } else {
                $validatedData['spesifikasi'] = json_encode([]);
            }

            $produk->update($validatedData);

            return response()->json([
                'success' => true,
                'message' => 'Produk berhasil diperbarui.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Kesalahan server: ' . $e->getMessage(),
            ]);
        }
    }

    public function destroy($id)
    {
        try {
            $produk = Produk::findOrFail($id);

            // Hapus gambar jika ada sebelum menghapus produk
            if ($produk->gambar && Storage::exists('public/' . $produk->gambar)) {
                Storage::delete('public/' . $produk->gambar);
            }

            $produk->delete();

            return response()->json([
                'success' => true,
                'message' => 'Produk berhasil dihapus.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Kesalahan server: ' . $e->getMessage(),
            ]);
        }
    }

    public function edit($id)
    {
        $produk = Produk::findOrFail($id);
        $kategoriProdukList = KategoriProduk::all();

        // Decode spesifikasi dari JSON ke array
        $produk->spesifikasi = json_decode($produk->spesifikasi, true);

        return response()->json([
            'produk' => $produk,
            'kategoriProdukList' => $kategoriProdukList
        ]);
    }
}
