<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request) {
        $formData = $request->validate([
            "username" => "required",
            "password" => "required",
        ]);

        if(Auth::attempt($formData)) {
            return response()->json([
                "success" => true,
                "message" => "Login Successful",
                "user_type" => auth()->user()->user_type,
            ]);
        }
    }

    public function logout() {
        auth()->user()->tokens()->delete();
        return response()->json([
            "success" => true,
            "message" => "Logout Successful",
        ]);
    }
}
