<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OnAirData extends Model
{
    use HasFactory;

    protected $fillable = [
        'anime_id',
        'on_air_date',
        'on_air_info',
    ];
}
