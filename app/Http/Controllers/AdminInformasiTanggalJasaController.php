<?php

namespace App\Http\Controllers;

use App\Models\InformasiTanggalJasa;
use Illuminate\Http\Request;

class AdminInformasiTanggalJasaController extends Controller
{
    public function index()
    {
        $informasiTanggal = InformasiTanggalJasa::with(['servisJasa.user', 'servisJasa.petugas', 'servisJasa.jenisLayanan'])->get();

        return view('dashboard.tanggalJasa', compact('informasiTanggal'));
    }
}
