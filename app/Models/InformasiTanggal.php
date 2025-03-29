<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformasiTanggal extends Model
{
    use HasFactory;

    protected $table = 'informasi_tanggal';

    protected $fillable = [
        'servis_barang_id',
        'tanggal_diterima',
        'tanggal_diserahkan',
    ];

    public function servisBarang()
    {
        return $this->belongsTo(ServisBarang::class, 'servis_barang_id');
    }
}
