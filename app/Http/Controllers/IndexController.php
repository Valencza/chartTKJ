<?php

namespace App\Http\Controllers;

use App\Models\UlasanUser;
use Illuminate\Http\Request;

class IndexController extends Controller
{

    public function index()
    {
        // Ambil semua ulasan user dengan relasi user
        $ulasanUser = \App\Models\UlasanUser::with('user')->latest()->get();

        // Kirim ke view
        return view('home.index', compact('ulasanUser'));
    }


    public function show($slug)
    {
        // Ambil data produk berdasarkan slug
        $ulasanUser = UlasanUser::where('slug', $slug)->firstOrFail();

        // Kirim data ke view
        return view('home.index', compact('ulasanUser'));
    }
}
