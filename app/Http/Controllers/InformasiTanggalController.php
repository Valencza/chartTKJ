<?php

namespace App\Http\Controllers;

use App\Models\InformasiTanggal;
use App\Models\Notifikasi;
use App\Models\ServisBarang;
use Illuminate\Http\Request;
use Carbon\Carbon;

class InformasiTanggalController extends Controller
{

    public function index()
    {
        $informasiTanggal = InformasiTanggal::with(['servisBarang.user', 'servisBarang.petugas', 'servisBarang.jenisBarang'])->get();

        return view('dashboard.tanggalServis', compact('informasiTanggal')); // Menampilkan tampilan

    }

    public function updateDiterima(Request $request, $id)
    {
        $request->validate([
            'tanggal_diterima' => 'required|date',
        ]);

        // Cari data berdasarkan ID
        $tanggal = InformasiTanggal::where('servis_barang_id', $id)->first();
        if (!$tanggal) {
            return response()->json(['success' => false, 'message' => 'Data tidak ditemukan.'], 404);
        }

        // Update tanggal diterima
        $tanggal->update([
            'tanggal_diterima' => $request->tanggal_diterima,
        ]);

        // Ambil data servis barang terkait
        $servisBarang = $tanggal->servisBarang;

        if (!$servisBarang) {
            return response()->json(['success' => false, 'message' => 'Data servis barang tidak ditemukan.'], 404);
        }

        // Ambil jenis barang dan jenis kerusakan dari relasi
        $jenisBarang = $servisBarang->jenisBarang->nama ?? 'Tidak Diketahui';
        $jenisKerusakan = $servisBarang->jenisKerusakan->nama ?? 'Tidak Diketahui';

        // Format tanggal diterima ke dalam format yang lebih mudah dibaca
        $formattedDate = \Carbon\Carbon::parse($request->tanggal_diterima)->format('d M Y');

        // Membuat notifikasi dengan status NULL dan type 'servis_barang'
        Notifikasi::create([
            'user_id' => $servisBarang->user_id, // Pastikan user_id ada di ServisBarang
            'servis_barang_id' => $servisBarang->id,
            'pesan' => "Barang {$jenisBarang} Anda dengan kerusakan {$jenisKerusakan} telah diterima oleh kami pada tanggal {$formattedDate}.",
            'status' => null, // Status dibuat NULL sesuai permintaan
            'type' => 'servis_barang', // Type ditetapkan sebagai 'servis_barang'
        ]);

        return response()->json(['success' => true, 'message' => 'Tanggal diterima berhasil diperbarui.']);
    }

    public function updateDiserahkan(Request $request, $id)
    {
        $request->validate([
            'tanggal_diserahkan' => 'required|date',
        ]);

        // Cari data berdasarkan ID
        $tanggal = InformasiTanggal::where('servis_barang_id', $id)->first();
        if (!$tanggal) {
            return response()->json(['success' => false, 'message' => 'Data tidak ditemukan.'], 404);
        }

        // Update tanggal diterima
        $tanggal->update([
            'tanggal_diserahkan' => $request->tanggal_diserahkan,
        ]);

        // Ambil data servis barang terkait
        $servisBarang = $tanggal->servisBarang;

        if (!$servisBarang) {
            return response()->json(['success' => false, 'message' => 'Data servis barang tidak ditemukan.'], 404);
        }

        // Ambil jenis barang dan jenis kerusakan dari relasi
        $jenisBarang = $servisBarang->jenisBarang->nama ?? 'Tidak Diketahui';
        $jenisKerusakan = $servisBarang->jenisKerusakan->nama ?? 'Tidak Diketahui';

        // Format tanggal diterima ke dalam format yang lebih mudah dibaca
        $formattedDate = \Carbon\Carbon::parse($request->tanggal_diserahkan)->format('d M Y');

        // Membuat notifikasi dengan status NULL dan type 'servis_barang'
        Notifikasi::create([
            'user_id' => $servisBarang->user_id, // Pastikan user_id ada di ServisBarang
            'servis_barang_id' => $servisBarang->id,
            'pesan' => "Barang {$jenisBarang} Anda dengan kerusakan {$jenisKerusakan} telah diserahkan oleh kami dan diterima oleh anda pada tanggal {$formattedDate}.",
            'status' => null, // Status dibuat NULL sesuai permintaan
            'type' => 'servis_barang', // Type ditetapkan sebagai 'servis_barang'
        ]);

        return response()->json(['success' => true, 'message' => 'Tanggal diterima berhasil diperbarui.']);
    }
}
