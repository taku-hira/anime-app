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
        $favorite = new Favorite();
        $favorite->user_id = $user_id;
        $favorite->anime_id = $anime_id;
        $favorite->save();
        return $favorite;
    }
}
