<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServisBarangPetugas extends Model
{
    use HasFactory;

    protected $table = 'servis_barang_petugas';

    protected $fillable = [
        'servis_barang_id',
        'petugas_id'
    ];

    public function servisBarang()
    {
        return $this->belongsTo(ServisBarang::class, 'servis_barang_id');
    }

    public function petugas()
    {
        return $this->belongsTo(User::class, 'petugas_id');
    }
}
