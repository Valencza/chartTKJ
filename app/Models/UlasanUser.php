<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UlasanUser extends Model
{
    use HasFactory;

    protected $table = 'ulasan_user'; // Pastikan sesuai dengan nama tabel di database
    protected $fillable = ['user_id', 'message'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
