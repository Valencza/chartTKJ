<?php

namespace App\Http\Controllers;

use App\Models\Portofolio;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class PortofolioController extends Controller
{
    public function index()
{
    $portofolioList = Portofolio::all();
    return view('dashboard.portofolio', compact('portofolioList'));
}

public function display()
{
    $portofolioDisplay = Portofolio::all();
    return view('home.portofolio', compact('portofolioDisplay'));
}


public function detailportfolio($slug)
{
    $portofolioDetail = Portofolio::where('slug', $slug)->first();
    return view('home.portofolio-detail', compact('portofolioDetail'));
}

    public function store(Request $request)
{
    $validatedData = $request->validate([
        'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        'nama' => 'required|string|max:255',
        'klien' => 'required|string|max:255',
        'lokasi' => 'required|string|max:255',
        'deskripsi' => 'required|string',
        'tanggalProyek' => 'required|string|max:255',
    ]);

    if ($request->hasFile('gambar')) {
        $imagePath = $request->file('gambar')->store('img/portofolio', 'public');
        $validatedData['gambar'] = $imagePath;
    }

    try {
        Portofolio::create($validatedData);

        return response()->json([
            'success' => true,
            'message' => 'Portofolio berhasil ditambahkan.'
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
        // Delete the old image if it exists
        if ($portofolio->gambar && Storage::exists('public/' . $portofolio->gambar)) {
            Storage::delete('public/' . $portofolio->gambar);
        }

        // Upload the new image to the specified folder
        $imagePath = $request->file('gambar')->store('img/portofolio', 'public');
        $validatedData['gambar'] = 'img/portofolio/' . basename($imagePath); // Store relative image path
    } else {
        // If no new image is uploaded, retain the old image path
        $validatedData['gambar'] = $portofolio->gambar;
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
        // Cek jika gambar ada dan hapus dari storage
        if ($portofolio->gambar && Storage::exists('public/' . $portofolio->gambar)) {
            Storage::delete('public/' . $portofolio->gambar);
        }

        // Hapus data portofolio
        $portofolio->delete();

        return response()->json(['success' => true, 'message' => 'Portofolio berhasil dihapus']);
    }

    return response()->json(['success' => false, 'message' => 'Portofolio tidak ditemukan']);
}

}
