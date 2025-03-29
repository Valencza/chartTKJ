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
        Schema::table('produk', function (Blueprint $table) {
            // Mengubah tipe kolom 'spesifikasi' menjadi JSON
            $table->json('spesifikasi')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('produk', function (Blueprint $table) {
            // Mengubah kembali kolom 'spesifikasi' ke tipe sebelumnya (misalnya TEXT atau lainnya)
            $table->text('spesifikasi')->nullable()->change();
        });
    }
};
