<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function index($anime_id) {
        $comments = Comment::where('anime_id', '=', $anime_id)->get();
        return response()->json($comments);
    }
}
