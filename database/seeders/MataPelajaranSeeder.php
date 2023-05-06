<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MataPelajaran;

class MataPelajaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MataPelajaran::create([
            'mapel' => 'PAI',
        ]);
        MataPelajaran::create([
            'mapel' => 'Quran Hadist',
        ]);
        MataPelajaran::create([
            'mapel' => 'Fiqih',
        ]);
        MataPelajaran::create([
            'mapel' => 'SKI',
        ]);
        MataPelajaran::create([
            'mapel' => 'PKN',
        ]);
        MataPelajaran::create([
            'mapel' => 'Bahasa Indonesia',
        ]);
        MataPelajaran::create([
            'mapel' => 'Matematika',
        ]);
        MataPelajaran::create([
            'mapel' => 'Bahasa Inggris',
        ]);
        MataPelajaran::create([
            'mapel' => 'Biologi',
        ]);
        MataPelajaran::create([
            'mapel' => 'Fisika',
        ]);
        MataPelajaran::create([
            'mapel' => 'IPS',
        ]);
        MataPelajaran::create([
            'mapel' => 'TIK',
        ]);
        MataPelajaran::create([
            'mapel' => 'Bahasa Arab',
        ]);
        MataPelajaran::create([
            'mapel' => 'Budi Pekerti',
        ]);
        MataPelajaran::create([
            'mapel' => 'SBK & Prakarya',
        ]);
        MataPelajaran::create([
            'mapel' => 'Penjas',
        ]);
        MataPelajaran::create([
            'mapel' => 'Tauhid',
        ]);
        MataPelajaran::create([
            'mapel' => 'Ummi',
        ]);
    }
}
