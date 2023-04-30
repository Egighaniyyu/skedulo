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
        MataPelajaran::created([
            'mapel' => 'PAI',
        ]);
        MataPelajaran::created([
            'mapel' => 'Quran Hadist',
        ]);
        MataPelajaran::created([
            'mapel' => 'Fiqih',
        ]);
        MataPelajaran::created([
            'mapel' => 'SKI',
        ]);
        MataPelajaran::created([
            'mapel' => 'PKN',
        ]);
        MataPelajaran::created([
            'mapel' => 'Bahasa Indonesia',
        ]);
        MataPelajaran::created([
            'mapel' => 'Matematika',
        ]);
        MataPelajaran::created([
            'mapel' => 'Bahasa Inggris',
        ]);
        MataPelajaran::created([
            'mapel' => 'Biologi',
        ]);
        MataPelajaran::created([
            'mapel' => 'Fisika',
        ]);
        MataPelajaran::created([
            'mapel' => 'IPS',
        ]);
        MataPelajaran::created([
            'mapel' => 'TIK',
        ]);
        MataPelajaran::created([
            'mapel' => 'Bahasa Arab',
        ]);
        MataPelajaran::created([
            'mapel' => 'Budi Pekerti',
        ]);
        MataPelajaran::created([
            'mapel' => 'SBK & Prakarya',
        ]);
        MataPelajaran::created([
            'mapel' => 'Penjas',
        ]);
        MataPelajaran::created([
            'mapel' => 'Tauhid',
        ]);
        MataPelajaran::created([
            'mapel' => 'Ummi',
        ]);
    }
}
