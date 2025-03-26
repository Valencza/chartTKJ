<?php

namespace App\Http\Controllers;

use App\Models\ServisBarangPetugas;
use App\Models\ServisJasa;
use App\Models\servisLayananPetugas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminservisLayananController extends Controller
{
    public function index()
    {
        $servisJasa = ServisJasa::with(['user', 'jenisJasa'])->get();
        $petugas = User::where('role', 'petugas')->get();
        return view('dashboard.servisLayanan', compact('servisJasa', 'petugas'));
    }

    public function show($id)
    {
        $servisJasa = ServisJasa::with(['jenisLayanan'])->findOrFail($id);
        $petugas = User::where('role', 'petugas')->get();

        return view('dashboard.servisLayanan', compact('servisLayanan', 'petugas'));
    }

    public function update(Request $request, $id)
    {
        try {
            // Validasi input sebelum update
            $validator = Validator::make($request->all(), [
                'status' => 'required|in:paid,pending,canceled'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validasi gagal',
                    'errors' => $validator->errors()
                ], 400);
            }

            $servisLayanan = ServisJasa::findOrFail($id);
            $servisLayanan->status = $request->status;
            $servisLayanan->save();

            return response()->json(['success' => true, 'message' => 'Status berhasil diperbarui.']);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function petugas(Request $request)
    {
        $request->validate([
            'servis_layanan_id' => 'required|exists:servis_jasa,id',
            'petugas_id' => 'required|exists:users,id',
        ]);

        // Hapus petugas lama jika sudah ada
        servisLayananPetugas::where('servis_layanan_id', $request->servis_layanan_id)->delete();

        // Simpan data penugasan
        servisLayananPetugas::create([
            'servis_layanan_id' => $request->servis_layanan_id,
            'petugas_id' => $request->petugas_id,
        ]);

        return redirect()->route('orderServisLayanan')->with('success', 'Petugas berhasil ditugaskan.');
    }
}
