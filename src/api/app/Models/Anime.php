<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\OnAirData;

class Anime extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'img_file_name',
        'summary',
    ];

    public function favoriteUsers()
    {
        return $this->belongsToMany(User::class, 'favorites')
                    ->withPivot('id')
                    ->withTimestamps();
    }

    public function onAirData()
    {
        return $this->hasMany(OnAirData::class);
    }
}
