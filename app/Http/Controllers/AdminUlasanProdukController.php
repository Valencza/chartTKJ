<?php

namespace App\Http\Controllers;

use App\Models\Ulasan;
use Illuminate\Http\Request;

class AdminUlasanProdukController extends Controller

{
    public function index()
    {
        $ulasan = Ulasan::all();
        return view('dashboard.ulasan', compact('ulasan'));
    }


    public function destroy($id)
    {
        try {
            $ulasan = Ulasan::findOrFail($id);

            // Pastikan tidak ada referensi yang mencegah penghapusan
            $ulasan->user()->dissociate();
            $ulasan->produk()->dissociate();

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
