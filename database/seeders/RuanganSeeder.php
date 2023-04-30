<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Ruangan;

class RuanganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Ruangan::created([
            'ruangan' => '7A',
        ]);
        Ruangan::created([
            'ruangan' => '7B',
        ]);
        Ruangan::created([
            'ruangan' => '7C',
        ]);
        Ruangan::created([
            'ruangan' => '8A',
        ]);
        Ruangan::created([
            'ruangan' => '8B',
        ]);
        Ruangan::created([
            'ruangan' => '8C',
        ]);
        Ruangan::created([
            'ruangan' => '9A',
        ]);
        Ruangan::created([
            'ruangan' => '9B',
        ]);
        Ruangan::created([
            'ruangan' => '9C',
        ]);
    }
}
