<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriProduk extends Model
{
    use HasFactory;

    // Tentukan nama tabel yang benar
    protected $table = 'kategori_produk';

    protected $fillable = [
        'nama',
    ];

    /**
     * Relasi ke produk
     */
    public function produk()
    {
        return $this->hasMany(Produk::class, 'id_kategoriProduk');
    }
    

}
