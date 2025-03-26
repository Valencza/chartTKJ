<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jenisBarang extends Model
{
    use HasFactory;

    // Tentukan nama tabel yang benar
    protected $table = 'jenis_barang';

    protected $fillable = [
        'nama',
    ];

    public function jenisKerusakan()
    {
        return $this->hasMany(JenisKerusakan::class, 'id_jenisBarang');
    }
    
}
