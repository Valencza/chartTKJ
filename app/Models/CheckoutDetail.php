<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckoutDetail extends Model
{
    use HasFactory;

    protected $fillable = ['checkout_id', 'product_id', 'jumlah', 'harga_satuan', 'total_harga'];

    public function checkout() {
        return $this->belongsTo(Checkout::class);
    }

    public function product() {
        return $this->belongsTo(Produk::class);
    }
}
