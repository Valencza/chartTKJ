<?php

namespace App\Http\Controllers;

use App\Models\Notifikasi;
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
        // Validasi input untuk status proses
        $request->validate([
            'proses' => 'required|in:diproses,selesai'
        ]);

        // Cari servis barang berdasarkan ID
        $servisBarang = ServisBarang::findOrFail($id);

        // Simpan status lama untuk memeriksa apakah status berubah
        $oldProsesStatus = $servisBarang->proses;

        // Update status proses servis barang
        $servisBarang->proses = $request->proses;
        $servisBarang->save();

        // Ambil petugas dan barang yang terkait dengan servis barang ini
        $petugas = $servisBarang->petugas;
        $barang = $servisBarang->jenisBarang;
        $kerusakan = $servisBarang->jenisKerusakan;

        // Menambahkan notifikasi jika status berubah
        if ($servisBarang->proses == 'diproses' && $oldProsesStatus != 'diproses') {
            // Notifikasi ketika status diubah menjadi "diproses"
            Notifikasi::create([
                'user_id' => $servisBarang->user_id,  // Notifikasi untuk user yang memiliki servis
                'servis_barang_id' => $servisBarang->id,  // Menggunakan servis_barang_id
                'pesan' => "Petugas {$petugas->nama} sedang dalam proses pengerjaan barang {$barang->nama} anda dengan kerusakan {$kerusakan->nama}.",
                'type' => 'servis_barang',
                'status' => null // Sesuaikan status sesuai dengan kebutuhan
            ]);
        }

        if ($servisBarang->proses == 'selesai' && $oldProsesStatus != 'selesai') {
            // Notifikasi ketika status diubah menjadi "selesai"
            Notifikasi::create([
                'user_id' => $servisBarang->user_id,  // Notifikasi untuk user yang memiliki servis
                'servis_barang_id' => $servisBarang->id,  // Menggunakan servis_barang_id
                'pesan' => "Petugas {$petugas->nama} telah menyelesaikan servis barang {$barang->nama} anda.",
                'type' => 'servis_barang',
                'status' => null // Sesuaikan status sesuai dengan kebutuhan
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Status proses berhasil diperbarui dan notifikasi telah dikirim.'
        ]);
    }
}
