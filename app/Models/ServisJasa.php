<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServisJasa extends Model
{
    use HasFactory;

    protected $table = 'servis_jasa'; // Pastikan ini sesuai dengan nama tabel di database

    protected $fillable = [
        'order_id',
        'user_id',
        'nama',
        'alamat',
        'telepon',
        'jenis_jasa_id',
        'deskripsi',
        'tanggal',
        'harga',
        'status',
        'proses'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function petugas()
    {
        return $this->hasOneThrough(User::class, servisLayananPetugas::class, 'servis_layanan_id', 'id', 'id', 'petugas_id');
    }

    public function servisLayananPetugas()
    {
        return $this->hasOne(servisLayananPetugas::class, 'servis_layanan_id');
    }

    public function jenisJasa()
    {
        return $this->belongsTo(JenisLayanan::class, 'jenis_jasa_id');
    }
}
