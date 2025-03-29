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
        Schema::table('servis_barang', function (Blueprint $table) {
            $table->string('merk')->nullable()->after('jenis_kerusakan_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('servis_barang', function (Blueprint $table) {
            $table->string('merk')->nullable()->after('jenis_kerusakan_id');
        });
    }
};
