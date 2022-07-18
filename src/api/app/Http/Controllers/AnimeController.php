<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anime;

class AnimeController extends Controller
{
    const SEASONS = [
        1 => '2022年春アニメ',
        2 => '2022年夏アニメ',
        3 => '2022年秋アニメ',
    ];

    public function index($season)
    {

        $anime_list = Anime::with('favoriteUsers')->where('on_air_season', '=', self::SEASONS[$season])->get();
        return response()->json($anime_list);
    }

    public function show($id)
    {
        $anime_detail = Anime::findOrFail($id);
        return $anime_detail;
    }
}
