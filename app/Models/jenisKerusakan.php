<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jenisKerusakan extends Model
{
    use HasFactory;

    // Tentukan nama tabel yang benar
    protected $table = 'jenis_kerusakan';

    protected $fillable = [
        'id_jenisBarang',
        'nama',
        'harga',
    ];

    public function jenisBarang()
    {
        return $this->belongsTo(JenisBarang::class, 'barang_id'); // Pastikan konsisten dengan database
    }
}
