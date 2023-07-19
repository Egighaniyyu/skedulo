<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('penjadwalans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_penugasan')->constrained('penugasans')->cascadeOnDelete();
            $table->foreignId('id_guru')->constrained('data_gurus')->cascadeOnDelete();
            $table->foreignId('id_mapel')->constrained('mata_pelajarans')->cascadeOnDelete();
            $table->foreignId('id_ruangan')->constrained('ruangans')->cascadeOnDelete();
            $table->foreignId('id_hari')->constrained('waktu_belajars')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penjadwalans');
    }
};
