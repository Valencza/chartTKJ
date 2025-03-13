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
        Schema::create('ulasan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user')
                ->constrained('users')
                ->onDelete('cascade');
                
            $table->foreignId('id_produk')
                ->nullable()
                ->constrained('produk')
                ->nullOnDelete();

            // $table->foreignId('id_serviceBarang')
            //     ->nullable()
            //     ->constrained('service_barang', 'id_serviceBarang')
            //     ->nullOnDelete();

            // $table->foreignId('id_serviceJasa')
            //     ->nullable()
            //     ->constrained('service_jasa', 'id_serviceJasa')
            //     ->nullOnDelete();

            $table->integer('rating');
            $table->text('deskripsi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ulasan');
    }
};
