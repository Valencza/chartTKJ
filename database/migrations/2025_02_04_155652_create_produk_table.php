<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('produk', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_kategoriProduk')->constrained('kategori_produk')->onDelete('cascade');
            $table->string('gambar')->nullable();
            $table->string('nama');
            $table->decimal('harga', 12, 2);
            $table->text('deskripsi');
            $table->text('spesifikasi');
            $table->integer('stok_out')->default(0);
            $table->integer('stok_in');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produk');
    }
};
