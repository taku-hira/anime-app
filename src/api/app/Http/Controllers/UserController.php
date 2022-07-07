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

}
