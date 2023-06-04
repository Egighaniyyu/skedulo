<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\JamBelajar;

class JamBelajarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        JamBelajar::create([
            'hari' => 'Senin',
            'jumlah_jam' => 10,
        ]);
        JamBelajar::create([
            'hari' => 'Selasa',
            'jumlah_jam' => 11,
        ]);
        JamBelajar::create([
            'hari' => 'Rabu',
            'jumlah_jam' => 10,
        ]);
        JamBelajar::create([
            'hari' => 'Kamis',
            'jumlah_jam' => 11,
        ]);
        JamBelajar::create([
            'hari' => 'Jumat',
            'jumlah_jam' => 6,
        ]);
    }
}
