<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function index($anime_id) {
        $comments = Comment::where('anime_id', '=', $anime_id)->get();
        return response()->json($comments);
    }

    public function create(Request $request)
    {
        $request->validate([
            'anime_id' => ['required', 'integer'],
            'user_id' => ['required', 'integer'],
            'comment' => ['required'],
            'stars' => ['integer', 'required', 'min:0', 'max:5'],
        ]);

        $user_id = Auth::id();
        $comment = Comment::create([
            'anime_id' => $request->anime_id,
            'user_id' => $user_id,
            'comment' => $request->comment,
            'stars' => $request->stars,
        ]);
        return response()->json($comment);
    }
}
