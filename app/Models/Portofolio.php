<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Portofolio extends Model
{

    use HasFactory;

    use Sluggable;

    public function Sluggable():array
    {
        return
            [
                'slug' =>
                [
                    'source' => 'nama'
                ]
            ];
    }

    // Tentukan nama tabel yang benar
    protected $table = 'portofolio';

    protected $fillable = [
        'gambar',
        'nama',
        'klien',
        'lokasi',
        'deskripsi',
        'detail',
        'tanggalProyek',
    ];
}
