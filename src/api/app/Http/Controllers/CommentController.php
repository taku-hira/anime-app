<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function index($anime_id) {
        $comments = Comment::with('user')->where('anime_id', '=', $anime_id)->latest()->get();
        return response()->json($comments);
    }

    public function create(Request $request)
    {
        $request->validate([
            'anime_id' => ['required', 'integer'],
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

    public function update(Request $request, $id)
    {
        $comment = Comment::findOrFail($id);
        $request->validate([
            'comment' => ['required'],
            'stars' => ['integer', 'required', 'min:0', 'max:5'],
        ]);
        $comment->comment = $request->comment;
        $comment->stars = $request->stars;
        $comment->save();

        return response()->json($comment,200);
    }
}
