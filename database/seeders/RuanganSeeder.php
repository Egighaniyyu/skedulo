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
        Ruangan::create([
            'ruangan' => '7A',
        ]);
        Ruangan::create([
            'ruangan' => '7B',
        ]);
        Ruangan::create([
            'ruangan' => '7C',
        ]);
        Ruangan::create([
            'ruangan' => '8A',
        ]);
        Ruangan::create([
            'ruangan' => '8B',
        ]);
        Ruangan::create([
            'ruangan' => '8C',
        ]);
        Ruangan::create([
            'ruangan' => '9A',
        ]);
        Ruangan::create([
            'ruangan' => '9B',
        ]);
        Ruangan::create([
            'ruangan' => '9C',
        ]);
    }
}
