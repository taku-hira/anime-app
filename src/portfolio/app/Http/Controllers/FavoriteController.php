<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Favorite;

class FavoriteController extends Controller
{
    public function index()
    {
        $user_id = 1;
        $favorite_list = User::findOrFail($user_id)->favorites;
        return $favorite_list;
    }

    public function store($anime_id)
    {
        $user_id = 1;
        $user = User::findOrFail($user_id);
        $user->favorites()->detach($anime_id);
        $user->favorites()->attach($anime_id);
        return $user;
    }

    public function destroy($anime_id)
    {
        $user_id = 1;
        $user = User::findOrFail($user_id);
        $user->favorites()->detach($anime_id);
        return $user;
    }
}
