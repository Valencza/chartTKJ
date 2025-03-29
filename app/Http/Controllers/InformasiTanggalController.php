<?php

namespace App\Http\Controllers;

use App\Models\InformasiTanggal;
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
    
        return response()->json(['success' => true, 'message' => 'Tanggal diserahkan berhasil diperbarui.']);
    }
}
