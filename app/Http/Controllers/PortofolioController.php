<?php

namespace App\Http\Controllers;

use App\Models\Portofolio;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class PortofolioController extends Controller
{

    public function index()
    {
        // Ambil data portofolio dengan pagination (6 per halaman)
        $portofolios = Portofolio::orderBy('created_at', 'desc')->paginate(6);
        return view('home.portofolio', compact('portofolios'));
    }

    public function detailportfolio($slug)
    {
        // Ambil portofolio berdasarkan slug, jika tidak ditemukan tampilkan 404
        $portofolioDetail = Portofolio::where('slug', $slug)->firstOrFail();
        return view('home.detail-portofolio', compact('portofolioDetail'));
    }
}
