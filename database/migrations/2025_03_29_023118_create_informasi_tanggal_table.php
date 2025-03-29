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
        Schema::create('informasi_tanggal', function (Blueprint $table) {
            $table->id();
            $table->foreignId('servis_barang_id')->constrained('servis_barang')->onDelete('cascade');
            $table->dateTime('tanggal_diterima');
            $table->dateTime('tanggal_diserahkan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('informasi_tanggal');
    }
};
