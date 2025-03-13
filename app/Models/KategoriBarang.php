<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriBarang extends Model
{
    use HasFactory;

    // Tentukan nama tabel yang benar
    protected $table = 'kategori_barang';

    protected $fillable = [
        'nama',
        'harga',
    ];
}
