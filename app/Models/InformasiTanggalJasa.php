<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformasiTanggalJasa extends Model
{
    use HasFactory;

    protected $table = 'informasi_tanggal_jasa';

    protected $fillable = [
        'servis_jasa_id',
        'tanggal',
    ];

    public function servisJasa()
    {
        return $this->belongsTo(ServisJasa::class, 'servis_jasa_id');
    }
}
