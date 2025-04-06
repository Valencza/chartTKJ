<?php

namespace App\Http\Controllers;

use App\Models\Portofolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminPortofolioController extends Controller
{

    public function index()
    {
        $portofolioList = Portofolio::all();
        return view('dashboard.portofolio', compact('portofolioList'));
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                'nama' => 'required|string|max:255',
                'klien' => 'required|string|max:255',
                'lokasi' => 'required|string|max:255',
                'deskripsi' => 'required|string',
                'tanggalProyek' => 'required|date', // Pastikan ini format tanggal
            ]);

            // Upload gambar jika ada
            if ($request->hasFile('gambar')) {
                $image = $request->file('gambar');
                $filename = Str::slug($request->nama) . '-' . time() . '.' . $image->getClientOriginalExtension();

                $image->move(public_path('img/portofolio'), $filename);

                $validatedData['gambar'] = 'img/portofolio/' . $filename;
            }

            // Handle spesifikasi (Menyimpan hanya 'spesifikasi_key')
            // Handle detail (Bisa lebih dari 1)
            $details = [];
            if ($request->has('detail_key')) {
                foreach ($request->detail_key as $detail) {
                    if (!empty($detail)) {
                        $details[] = $detail;
                    }
                }
            }
            $validatedData['detail'] = json_encode($details);

            Portofolio::create($validatedData);

            return response()->json([
                'success' => true,
                'message' => 'Portofolio berhasil ditambahkan.'
            ], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal!',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan pada server. ' . $e->getMessage()
            ], 500);
        }
    }


    public function update(Request $request, $id)
    {
        $portofolio = Portofolio::findOrFail($id);

        // Validate the data
        $validatedData = $request->validate([
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'nama' => 'required|string|max:255',
            'klien' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggalProyek' => 'required|string|max:255',
        ]);

        // Check if the image is being updated
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($portofolio->gambar && file_exists(public_path($portofolio->gambar))) {
                unlink(public_path($portofolio->gambar));
            }

            // Simpan gambar baru
            $image = $request->file('gambar');
            $filename = Str::slug($request->nama) . '-' . time() . '.' . $image->getClientOriginalExtension();

            $image->move(public_path('img/portofolio'), $filename);

            $validatedData['gambar'] = 'img/portofolio/' . $filename;
        } else {
            $validatedData['gambar'] = $portofolio->gambar;
        }

        // Simpan detail dalam JSON
        if ($request->has('detail_key')) {
            $detail = [];
            foreach ($request->detail_key as $key) {
                if (!empty($key)) { // Pastikan hanya data yang tidak kosong yang disimpan
                    $detail[] = $key;
                }
            }
            $validatedData['detail'] = json_encode($detail);
        } else {
            $validatedData['detail'] = json_encode([]); // Jika tidak ada input, simpan array kosong
        }

        // Update the portofolio with the validated data
        $portofolio->update($validatedData);

        return response()->json([
            'success' => true,
            'message' => 'Portofolio berhasil diperbarui.'
        ]);
    }


    public function destroy($id)
    {
        $portofolio = Portofolio::find($id);

        if ($portofolio) {
            // Cek jika gambar ada dan hapus dari folder public/img/portofolio
            if ($portofolio->gambar && file_exists(public_path($portofolio->gambar))) {
                unlink(public_path($portofolio->gambar));
            }

            // Hapus data portofolio
            $portofolio->delete();

            return response()->json(['success' => true, 'message' => 'Portofolio berhasil dihapus']);
        }

        return response()->json(['success' => false, 'message' => 'Portofolio tidak ditemukan']);
    }
}
