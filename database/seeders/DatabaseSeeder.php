<?php

namespace Database\Seeders;

use App\Models\ServisJasa;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        ServisJasa::create([
            'order_id' => 'ORD-67DA31DD81488',
            'user_id' => 3,
            'nama' => 'Garcia Valencza',
            'alamat' => 'Jl. Surabaya Gg. 100',
            'telepon' => '081339059343',
            'jenis_jasa_id' => 2,
            'deskripsi' => 'Installasi WIFI',
            'tanggal' => now(),
            'harga' => 230000,
            'status' => 'pending',
            'proses' => 'Menunggu',
        ]);
    }
}
