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
        Schema::create('jenis_kerusakan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_jenisBarang')->constrained('jenis_barang')->onDelete('cascade');
            $table->string('nama');
            $table->decimal('harga', 10, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jenis_kerusakan');
    }
};
