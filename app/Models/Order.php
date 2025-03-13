<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'alamat_id', 'status', 'total'];

    public function getTotalAttribute($value)
    {
        return $value ?? 0; // Bisa menyebabkan total tetap null
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Jika Order memiliki relasi dengan model Pembeli
    public function pembeli()
    {
        return $this->belongsTo(User::class, 'user_id'); // Pastikan 'user_id' adalah kolom yang ada di tabel orders
    }

    public function alamat()
    {
        return $this->belongsTo(Alamat::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }

    public function details()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getSubtotalAttribute()
    {
        return $this->items->sum(function ($item) {
            return $item->harga * $item->jumlah;
        });
    }
}
