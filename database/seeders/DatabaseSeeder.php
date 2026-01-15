<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat User Admin buat Login
        User::create([
            'name' => 'Admin Utama',
            'email' => 'admin@klinik.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        // 2. Panggil Seeder Poli & Dokter
        $this->call([
            PoliSeeder::class,
            DoctorSeeder::class,
        ]);
    }
}
