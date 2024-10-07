<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponseTraits;
use Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    use ApiResponseTraits;

    public function login(Request $request) {
        $formData = $request->validate([
            "username" => "required",
            "password" => "required",
        ]);

        if(Auth::attempt($formData)) {
            return $this->sendResponse([
                "user_type" => auth()->user()->user_type,
            ], "Login Successful");
        } else {
            return $this->sendError([], "Incorrect username or password");
        }
    }

    public function logout() {
        auth()->user()->tokens()->delete();
        return $this->sendResponse([], "Logout successful");
    }
}
