<?php

namespace App\Http\Controllers;

use App\Models\InformasiTanggalJasa;
use Illuminate\Http\Request;
use App\Models\Notifikasi;
use App\Models\ServisJasa;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class NotifikasiController extends Controller
{
    // **1. Ambil Notifikasi untuk User yang Login**
    public function index()
    {
        $notifikasi = Notifikasi::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();
        return response()->json($notifikasi);
    }

    // **2. Tandai Notifikasi sebagai Dibaca**
    public function markAsRead($id)
    {
        $notifikasi = Notifikasi::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $notifikasi->status = 'read';
        $notifikasi->save();

        return response()->json(['message' => 'Notifikasi ditandai sebagai dibaca']);
    }

    // **3. Tandai Semua Notifikasi sebagai Dibaca**
    public function markAllAsRead()
    {
        Notifikasi::where('user_id', Auth::id())->update(['status' => 'read']);
        return response()->json(['message' => 'Semua notifikasi telah dibaca']);
    }

    // **4. Setujui Jadwal**

    public function approve($id)
    {
        try {
            // Cek apakah notifikasi ditemukan
            $notifikasi = Notifikasi::where('id', $id)->first(); // Atau firstOrFail()

            if (!$notifikasi) {
                return response()->json(['success' => false, 'message' => 'Notifikasi tidak ditemukan.'], 404);
            }

            // Ambil ID servis_jasa terkait
            $servis_jasa_id = $notifikasi->servis_jasa_id;

            // Ambil data servis_jasa untuk mendapatkan tanggalnya
            $servisJasa = ServisJasa::where('id', $servis_jasa_id)->first();

            if (!$servisJasa || !$servisJasa->tanggal) {
                return response()->json(['success' => false, 'message' => 'Tanggal servis tidak ditemukan.'], 404);
            }

            // Format tanggal servis
            $tanggal_servis = Carbon::parse($servisJasa->tanggal)->format('d F Y');

            // **Update semua notifikasi yang memiliki servis_jasa_id yang sama**
            Notifikasi::where('servis_jasa_id', $servis_jasa_id)
                ->update([
                    'status' => 'disetujui',
                    'pesan' => "Tanggal servis telah disetujui pada tanggal " . $tanggal_servis
                ]);

            // **Create data InformasiTanggalJasa baru**
            InformasiTanggalJasa::create([
                'servis_jasa_id' => $servis_jasa_id,
                'tanggal' => $servisJasa->tanggal, // Gunakan tanggal dari servisJasa yang terkait
            ]);

            // Mengembalikan response sukses
            return response()->json([
                'success' => true,
                'message' => 'Semua notifikasi terkait servis ini telah diperbarui menjadi disetujui pada tanggal ' . $tanggal_servis,
            ]);
        } catch (\Exception $e) {
            \Log::error('Error saat approve notifikasi: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengubah status notifikasi.',
            ], 500);
        }
    }

    // **5. Ajukan Tanggal Baru**
    public function changeDate(Request $request, $id)
    {

        try {
            // Validasi input tanggal
            $validator = Validator::make($request->all(), [
                'servis_jasa_id' => 'required|exists:servis_jasa,id',
                'tanggal' => 'required|date|after_or_equal:today',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validasi gagal',
                    'errors' => $validator->errors(), // Perbaikan di sini
                ], 400);
            }

            // Cari data layanan berdasarkan ID
            $servisLayanan = ServisJasa::findOrFail($id);
            $oldDate = Carbon::parse($servisLayanan->tanggal)->format('d M Y');
            $newDate = Carbon::parse($request->tanggal)->format('d M Y');

            // Update tanggal
            $servisLayanan->tanggal = $request->tanggal;
            $servisLayanan->save();

            // Kirim notifikasi ke user jika user_id ada
            if (!empty($servisLayanan->user_id)) {
                Notifikasi::create([
                    'user_id' => $servisLayanan->user_id,
                    'servis_jasa_id' => $request->servis_jasa_id,
                    'pesan' => "Jadwal servis telah diubah oleh user dari $oldDate menjadi $newDate.",
                    'status' => 'negosiasi',
                    'type' => 'servis_jasa',
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Tanggal berhasil diperbarui dan notifikasi dikirim ke user.',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }
}
