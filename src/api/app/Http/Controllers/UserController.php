<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return response()->json($user, 200);
    }

    public function update(Request $request)
    {
        $user = User::findOrFail(Auth::id());
        $request->validate([
            'name' => ['required', 'string', 'max:20'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'prefecture_id' => ['integer', 'required', 'min:1', 'max:47'],
        ]);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->prefecture_id = $request->prefecture_id;
        $user->save();

        return response()->json($user,200);
    }
}
