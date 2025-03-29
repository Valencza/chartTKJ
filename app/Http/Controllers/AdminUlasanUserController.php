<?php

namespace App\Http\Controllers;

use App\Models\UlasanUser;
use Illuminate\Http\Request;

class AdminUlasanUserController extends Controller
{
    public function index()
    {
        $ulasan = UlasanUser::all();
        return view('dashboard.ulasanUser', compact('ulasan'));
    }


    public function destroy($id)
    {
        try {
            $ulasan = UlasanUser::findOrFail($id);

            // Pastikan tidak ada referensi yang mencegah penghapusan
            $ulasan->user()->dissociate();
            
            // Hapus ulasan
            $ulasan->delete();

            return response()->json([
                'success' => true,
                'message' => 'Ulasan berhasil dihapus.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Kesalahan server: ' . $e->getMessage(),
            ]);
        }
    }
}
