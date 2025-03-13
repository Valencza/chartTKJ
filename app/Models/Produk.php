<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Produk extends Model
{
    use HasFactory;

    // Tentukan nama tabel yang benar
    protected $table = 'produk';

    protected $fillable = [
        'id_kategoriProduk',
        'gambar',
        'nama',
        'harga',
        'deskripsi',
        'spesifikasi',
        'stok_out',
        'stok_in',
        'slug',
    ];

    /**
     * Kurangi stok_in dan tambahkan stok_out sesuai jumlah yang dibeli.
     */
    public function updateStock($jumlah) {
        $this->stok_in -= $jumlah;
        $this->stok_out += $jumlah;
        $this->save();
    }

    //handle slug otomatis

    // Event untuk otomatis mengisi slug
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($produk) {
            $produk->slug = Str::slug($produk->nama);
        });

        static::updating(function ($produk) {
            $produk->slug = Str::slug($produk->nama);
        });
    }

    /**
     * Relasi ke model Kategori
     */
    public function kategori()
    {
        return $this->belongsTo(KategoriProduk::class, 'id_kategoriProduk');
    }

    public function ulasan()
    {
        return $this->hasMany(ulasan::class, 'id_produk');
    }
}
