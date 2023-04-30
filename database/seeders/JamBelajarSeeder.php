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
        JamBelajar::created([
            'hari' => 'Senin',
            'jumlah_jam' => 10,
        ]);
        JamBelajar::created([
            'hari' => 'Selasa',
            'jumlah_jam' => 11,
        ]);
        JamBelajar::created([
            'hari' => 'Rabu',
            'jumlah_jam' => 11,
        ]);
        JamBelajar::created([
            'hari' => 'Kamis',
            'jumlah_jam' => 11,
        ]);
        JamBelajar::created([
            'hari' => 'Jumat',
            'jumlah_jam' => 6,
        ]);
    }
}
