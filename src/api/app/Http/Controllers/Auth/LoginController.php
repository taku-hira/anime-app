<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return response()->json(['name' => Auth::user()->name, 'message' => 'ログインしました'], 200);
        } else {
            return response()->json(['message' => 'ログイン失敗しました'], 403);
        }
    }

    public function logout()
    {
        Auth::logout();
        return response()->json(['message' => 'ログアウトしました'], 200);
    }
}
