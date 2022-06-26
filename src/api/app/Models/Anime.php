<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\OnAirData;
use Illuminate\Support\Facades\Auth;

class Anime extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'img_file_name',
        'summary',
    ];

    protected $appends = [
        'favorite_by_user',
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

    public function getFavoriteByUserAttribute()
    {
        if (Auth::guest()) {
            return false;
        }
        return $this->favoriteUsers->contains(function ($user) {
            return $user->id === Auth::user()->id;
        });
    }
}
