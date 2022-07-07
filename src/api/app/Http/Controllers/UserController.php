<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;

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
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$user->id.',id'],
            'prefecture_id' => ['integer', 'required', 'min:1', 'max:47'],
        ]);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->prefecture_id = $request->prefecture_id;
        $user->save();

        return response()->json($user,200);
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => ['required', Rules\Password::defaults()],
        ]);
        $user = User::findOrFail(Auth::id());
        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json($user, 200);
    }

    public function destroy()
    {
        $user = User::findOrFail(Auth::id());
        $user->delete();
        return response()->json(['message' => '削除完了しました'], 200);
    }
}
