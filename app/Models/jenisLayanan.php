<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jenisLayanan extends Model
{

    use HasFactory;

    // Tentukan nama tabel yang benar
    protected $table = 'jenis_layanan';

    protected $fillable = [
        'nama',
        'harga',
    ];

    // Define the relationship back to ServisJasa
    public function servisJasa()
    {
        return $this->hasMany(ServisJasa::class, 'jenis_jasa_id');
    }
}
