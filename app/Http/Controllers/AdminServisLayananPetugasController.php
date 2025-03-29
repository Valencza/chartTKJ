<?php

namespace App\Http\Controllers;

use App\Models\ServisJasa;
use Illuminate\Http\Request;

class AdminServisLayananPetugasController extends Controller
{
    // Controller untuk halaman petugas servis
    public function index()
    {
        // Ambil ID user yang sedang login
        $userId = auth()->id();

        // Ambil data servis yang sedang ditangani oleh petugas yang login
        $servisLayananPetugas = ServisJasa::whereHas('servisLayananPetugas', function ($query) use ($userId) {
            $query->where('petugas_id', $userId);
        })->with(['jenisJasa', 'servisLayananPetugas.petugas'])->get();

        return view('dashboard.servisLayananPetugas', compact('servisLayananPetugas'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'proses' => 'required|in:dalam perjalanan,diproses,selesai'
        ]);

        $servisLayanan = ServisJasa::findOrFail($id);
        $servisLayanan->proses = $request->proses;
        $servisLayanan->save();

        return response()->json([
            'success' => true,
            'message' => 'Status proses berhasil diperbarui.'
        ]);
    }
}
