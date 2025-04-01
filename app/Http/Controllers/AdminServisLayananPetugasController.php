<?php

namespace App\Http\Controllers;

use App\Models\Notifikasi;
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

        // Cari data servis jasa berdasarkan ID
        $servisLayanan = ServisJasa::findOrFail($id);

        // Perbarui status proses
        $servisLayanan->proses = $request->proses;
        $servisLayanan->save();

        // Ambil data petugas
        $petugasNama = $servisLayanan->servisLayananPetugas->petugas->nama ?? 'Petugas Tidak Diketahui';
        $alamat = $servisLayanan->alamat ?? 'Alamat Tidak Diketahui';

        // Tentukan pesan berdasarkan status proses
        if ($request->proses === 'dalam perjalanan') {
            $pesan = "Petugas {$petugasNama} sedang dalam perjalanan menuju ke {$alamat}.";
        } elseif ($request->proses === 'diproses') {
            $pesan = "Petugas {$petugasNama} sedang mengerjakan pesanan anda.";
        } elseif ($request->proses === 'selesai') {
            $pesan = "Petugas {$petugasNama} telah menyelesaikan servis Anda.";
        }

        // Membuat notifikasi dengan status NULL dan type 'servis_jasa'
        Notifikasi::create([
            'user_id' => $servisLayanan->user_id, // Pastikan user_id ada di ServisJasa
            'servis_jasa_id' => $servisLayanan->id,
            'pesan' => $pesan,
            'status' => null, // Status dibuat NULL sesuai permintaan
            'type' => 'servis_barang', // Type ditetapkan sebagai 'servis_jasa'
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Status proses berhasil diperbarui.'
        ]);
    }
}
