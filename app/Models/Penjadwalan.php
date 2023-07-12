<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjadwalan extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'id';
    public function penugasan()
    {
        return $this->belongsTo(Penugasan::class, 'id_penugasan');
    }
    public function guru()
    {
        return $this->belongsTo(DataGuru::class, 'id_guru');
    }
    public function mapel()
    {
        return $this->belongsTo(MataPelajaran::class, 'id_mapel');
    }
    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'id_ruangan');
    }
    public function waktu()
    {
        return $this->belongsTo(WaktuBelajar::class, 'id_hari');
    }
}
