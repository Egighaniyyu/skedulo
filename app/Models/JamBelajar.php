<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JamBelajar extends Model
{
    use HasFactory;
    protected $table = 'jam_belajars';
    protected $guarded = [];
    protected $primaryKey = 'id';
}
