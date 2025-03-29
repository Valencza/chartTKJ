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
        Schema::create('servis_barang', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Relasi ke tabel users
            $table->foreignId('barang_id')->constrained('jenis_barang')->onDelete('cascade'); // Relasi ke tabel barang
            $table->foreignId('jenis_kerusakan_id')->constrained('jenis_kerusakan')->onDelete('cascade'); // Relasi ke jenis_kerusakan
            $table->string('telepon');
            $table->text('kerusakan')->nullable(); // Sesuai dengan controller
            $table->integer('harga');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('servis_barang');
    }
};
