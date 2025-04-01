<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServisBarang extends Model
{
    use HasFactory;

    protected $table = 'servis_barang'; // Pastikan ini sesuai dengan nama tabel di database

    protected $fillable = [
        'order_id',
        'user_id',
        'nama',
        'telepon',
        'barang_id',
        'jenis_kerusakan_id',
        'merk',
        'kerusakan',
        'backUp',
        'harga',
        'password',
        'status',
        'proses',
    ];

    protected $casts = [
        'harga' => 'decimal:2',
    ];

    protected $with = ['user', 'jenisBarang', 'jenisKerusakan'];

    // Relasi dengan User (Opsional, jika ada hubungan dengan tabel users)
    public function user()
    {
        return $this->belongsTo(user::class, 'user_id');
    }

    public function petugas()
    {
        return $this->hasOneThrough(User::class, ServisBarangPetugas::class, 'servis_barang_id', 'id', 'id', 'petugas_id');
    }


    public function servisBarangPetugas()
    {
        return $this->hasOne(ServisBarangPetugas::class, 'servis_barang_id');
    }

    public function jenisBarang()
    {
        return $this->belongsTo(jenisBarang::class, 'barang_id', 'id');
    }

    public function jenisKerusakan()
    {
        return $this->belongsTo(jenisKerusakan::class, 'jenis_kerusakan_id', 'id');
    }

    public function informasiTanggal()
    {
        return $this->hasOne(InformasiTanggal::class, 'servis_barang_id');
    }

    public function notifikasi()
    {
        return $this->hasMany(Notifikasi::class, 'servis_barang_id');
    }
}
