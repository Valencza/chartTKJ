<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifikasi extends Model
{
    use HasFactory;

    protected $table = 'notifikasi';

    protected $fillable = [
        'user_id',
        'order_id',
        'produk_id',
        'servis_barang_id',
        'servis_jasa_id',
        'pesan',
        'status',
        'type'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Pada model Notifikasi
    public function orderItem()
    {
        return $this->belongsTo(OrderItem::class, 'produk_id', 'produk_id'); // Menyesuaikan relasi dengan produk_id
    }

    // Untuk mendapatkan order_id
    public function order_id()
    {
        return $this->orderItem ? $this->orderItem->order_id : null;  // Mengambil order_id dari OrderItem
    }

    public function servisBarang()
    {
        return $this->belongsTo(ServisBarang::class);
    }

    public function servisJasa()
    {
        return $this->belongsTo(ServisJasa::class);
    }
}
