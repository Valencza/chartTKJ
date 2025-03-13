<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'produk_id', 'jumlah'];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }
}
