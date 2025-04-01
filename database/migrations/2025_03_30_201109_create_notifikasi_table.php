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
        Schema::create('notifikasi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('produk_id')->constrained('order_items')->onDelete('cascade')->nullable();
            $table->foreignId('servis_barang_id')->constrained('servis_barang')->onDelete('cascade')->nullable();
            $table->foreignId('servis_jasa_id')->constrained('servis_jasa')->onDelete('cascade')->nullable();
            $table->text('pesan');
            $table->enum('status', ['negosiasi', 'disetujui'])->default('negosiasi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifikasi');
    }
};
