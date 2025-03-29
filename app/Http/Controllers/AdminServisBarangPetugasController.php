<?php

namespace App\Http\Controllers;

use App\Models\ServisBarang;
use App\Models\ServisBarangPetugas;
use App\Models\User;
use Illuminate\Http\Request;

class AdminServisBarangPetugasController extends Controller
{
    // Controller untuk halaman petugas servis
    public function index()
    {
        // Ambil ID user yang sedang login
        $userId = auth()->id();

        // Ambil data servis yang sedang ditangani oleh petugas yang login
        $servisBarangPetugas = ServisBarang::whereHas('servisBarangPetugas', function ($query) use ($userId) {
            $query->where('petugas_id', $userId);
        })->with(['jenisBarang', 'jenisKerusakan', 'servisBarangPetugas.petugas'])->get();

        return view('dashboard.servisBarangPetugas', compact('servisBarangPetugas'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'proses' => 'required|in:diproses,selesai'
        ]);

        $servisBarang = ServisBarang::findOrFail($id);
        $servisBarang->proses = $request->proses;
        $servisBarang->save();

        return response()->json([
            'success' => true,
            'message' => 'Status proses berhasil diperbarui.'
        ]);
    }
}
