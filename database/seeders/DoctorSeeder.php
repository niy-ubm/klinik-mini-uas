<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Doctor::create([
            'poli_id' => 1, // Poli Umum
            'name' => 'dr. Zaen Ahmadi',
            'schedule_day' => 'Senin',
            'start_time' => '08:00',
            'end_time' => '12:00'
        ]);

        \App\Models\Doctor::create([
            'poli_id' => 2, // Poli Gigi
            'name' => 'drg. Siti Aminah',
            'schedule_day' => 'Selasa',
            'start_time' => '10:00',
            'end_time' => '14:00'
        ]);
    }

}
