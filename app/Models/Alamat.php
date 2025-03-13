<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alamat extends Model
{
    use HasFactory;

    protected $table = 'alamat';
    protected $fillable = ['id_user', 'nama', 'no_telpon', 'alamat'];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
