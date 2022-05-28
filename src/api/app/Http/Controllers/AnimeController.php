<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anime;

class AnimeController extends Controller
{
    public function index()
    {
        $anime_list = Anime::all();
        return $anime_list;
    }

    public function show($id)
    {
        $anime_detail = Anime::findOrFail($id);
        return $anime_detail;
    }
}
