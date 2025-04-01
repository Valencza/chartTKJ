<?php

namespace App\Http\Controllers;

use App\Models\ServisBarang;
use App\Models\User;
use Illuminate\Http\Request;

class AdminNotifikasiServisBarangController extends Controller
{
    public function index()
    {
        $servisBarang = ServisBarang::with(['user', 'jenisBarang', 'jenisKerusakan', 'notifikasi'])->get();
        $petugas = User::where('role', 'petugas')->get();
        return view('dashboard.notifikasiServis', compact('servisBarang', 'petugas'));
    }
}
