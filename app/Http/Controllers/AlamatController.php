<?php

namespace App\Http\Controllers;

use App\Models\Alamat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AlamatController extends Controller
{

    public function getAlamat()
    {
        $alamat = Alamat::where('id_user', Auth::id())->get();
        return response()->json($alamat);
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
            'no_telpon' => 'required|string|max:15',
            'alamat' => 'required|string',
        ]);

        try {
            // Simpan ke database
            Alamat::create([
                'id_user' => Auth::id(),
                'nama' => $request->nama,
                'no_telpon' => $request->no_telpon,
                'alamat' => $request->alamat,
            ]);

            return redirect()->route('index')->with('success', 'Alamat berhasil disimpan!');
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}
