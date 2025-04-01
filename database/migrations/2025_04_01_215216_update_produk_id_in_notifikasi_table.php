<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('notifikasi', function (Blueprint $table) {
            // Menambahkan kolom produk_id dengan foreign key yang terhubung ke order_items
            $table->foreignId('order_id')->nullable()->constrained('orders')->onDelete('cascade')->after('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
       //
    }
};
