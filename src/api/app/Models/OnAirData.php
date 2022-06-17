<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OnAirData extends Model
{
    use HasFactory;

    protected $fillable = [
        'on_air_data',
        'on_air_info',
    ];
}
