<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Anime extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'img_file_name',
        'summary',
    ];

    public function favoritePerson()
    {
        return $this->belongsToMany(User::class, 'favorites')
                    ->withPivot('id')
                    ->withTimestamps();
    }
}
