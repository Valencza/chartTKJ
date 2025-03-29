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
            $table->enum('backUp', ['iya', 'tidak'])->nullable()->after('kerusakan');;
            $table->string('password')->nullable()->after('harga');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('servis_barang', function (Blueprint $table) {
            $table->enum('backUp', ['iya', 'tidak'])->nullable()->after('kerusakan');;
            $table->string('password')->nullable()->after('harga');
        });
    }
};
