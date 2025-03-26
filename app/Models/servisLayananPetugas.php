<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class servisLayananPetugas extends Model
{
    use HasFactory;

    protected $table = 'servis_layanan_petugas';

    protected $fillable = [
        'servis_layanan_id',
        'petugas_id'
    ];

    public function servisLayanan()
    {
        return $this->belongsTo(ServisJasa::class, 'servis_layanan_id');
    }

    public function petugas()
    {
        return $this->belongsTo(User::class, 'petugas_id');
    }
}
