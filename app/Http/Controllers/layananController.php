<?php

namespace App\Http\Controllers;

use App\Models\jenisKerusakan;
use App\Models\jenisLayanan;
use Illuminate\Http\Request;

class layananController extends Controller
{
    public function index()
    {
        $jenisKerusakan = jenisKerusakan::all();
        $jenisLayanan = jenisLayanan::all();

        return view('home.service', compact('jenisKerusakan', 'jenisLayanan'));
    }
}
