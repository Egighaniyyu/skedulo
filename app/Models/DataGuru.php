<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class DataGuru extends Authenticatable
{
    use Notifiable, HasFactory;
    protected $guarded = [];
}
