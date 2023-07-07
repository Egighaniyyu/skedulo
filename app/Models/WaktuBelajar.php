<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaktuBelajar extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'id';
    public function hari()
    {
        return $this->belongsTo(JamBelajar::class, 'id_hari');
    }
}
