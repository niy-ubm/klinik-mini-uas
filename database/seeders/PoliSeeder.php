<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PoliSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $polis = ['Umum', 'Gigi', 'Anak', 'Kandungan', 'Penyakit Dalam'];
        foreach ($polis as $p) {
            \App\Models\Poli::create(['name' => $p]);
        }
    }
}
