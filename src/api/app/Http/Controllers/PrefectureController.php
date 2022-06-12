<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prefecture;

class PrefectureController extends Controller
{
    public function getPrefectureData()
    {
        $prefectures = Prefecture::get(['id', 'name']);
        return response()->json($prefectures, 200);
    }
}
