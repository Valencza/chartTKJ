<?php

namespace App\Http\Controllers;

use App\Models\InformasiTanggal;
use App\Models\ServisBarang;
use App\Models\ServisBarangPetugas;
use App\Models\User;
use Illuminate\Http\Request;

class adminServiceBarangController extends Controller
{
    public function index()
    {
        $servisBarang = ServisBarang::with(['jenisBarang', 'jenisKerusakan'])->get();

        // Ambil hanya user yang memiliki role 'petugas'
        $petugas = User::where('role', 'petugas')->get();

        return view('dashboard.servisBarang', compact('servisBarang', 'petugas'));
    }

    /**
     * Menampilkan detail servis barang berdasarkan ID.
     */
    public function show($id)
    {
        $servisBarang = ServisBarang::with(['jenisBarang', 'jenisKerusakan'])->findOrFail($id);
        $petugas = User::where('role', 'petugas')->get();

        return view('dashboard.servisBarang', compact('servisBarang', 'petugas'));
    }

    /**
     * Memperbarui status servis barang.
     */
    public function update(Request $request, $id)
    {
        $servisBarang = ServisBarang::findOrFail($id);
        $servisBarang->status = $request->status;
        $servisBarang->save(); // Simpan perubahan status

        // Jika status berubah menjadi "Paid", buat entri baru di informasi_tanggal
        if ($request->status === 'paid') {
            // Periksa apakah entri sudah ada untuk servis_barang_id
            $informasiTanggal = InformasiTanggal::where('servis_barang_id', $servisBarang->id)->first();

            if (!$informasiTanggal) {
                InformasiTanggal::create([
                    'servis_barang_id' => $servisBarang->id,
                    'tanggal_diterima' => null,
                    'tanggal_diserahkan' => null, // Biarkan null terlebih dahulu
                ]);
            } else {
                // Jika sudah ada, pastikan tanggal_diserahkan tetap null
                $informasiTanggal->update(['tanggal_diterima' => null]);
                $informasiTanggal->update(['tanggal_diserahkan' => null]);
            }
        }

        return response()->json(['success' => true, 'message' => 'Status berhasil diperbarui.']);
    }

    public function petugas(Request $request)
    {
        $request->validate([
            'servis_barang_id' => 'required|exists:servis_barang,id',
            'petugas_id' => 'required|exists:users,id',
        ]);

        // Hapus petugas lama jika sudah ada
        ServisBarangPetugas::where('servis_barang_id', $request->servis_barang_id)->delete();

        // Simpan petugas baru
        ServisBarangPetugas::create([
            'servis_barang_id' => $request->servis_barang_id,
            'petugas_id' => $request->petugas_id,
        ]);

        return redirect()->route('orderServisBarang')->with('success', 'Petugas berhasil diperbarui.');
    }
}
