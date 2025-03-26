<?php

namespace App\Http\Controllers;

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
        try {
            $servisBarang = ServisBarang::findOrFail($id);
            $servisBarang->status = $request->status;
            $servisBarang->save();

            return response()->json(['success' => true, 'message' => 'Status berhasil diperbarui.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan.'], 500);
        }
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
