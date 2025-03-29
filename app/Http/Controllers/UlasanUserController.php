<?php

namespace App\Http\Controllers;

use App\Models\UlasanUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UlasanUserController extends Controller
{
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        // Simpan ke database
        UlasanUser::create([
            'user_id' => Auth::id(),
            'message' => $request->message,
        ]);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('index')->with('success', 'Pesan berhasil dikirim.');
    }
}
