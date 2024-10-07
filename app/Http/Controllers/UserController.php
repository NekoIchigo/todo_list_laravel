<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\ApiResponseTraits;
use Hash;
use Illuminate\Http\Request;
use Str;

class UserController extends Controller
{
    use ApiResponseTraits;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $formData = $request->validate([
            "username" => "required",
            "email" => "required|email",
            "user_type" => "required",
        ]);
        try {
            $password = Str::random(5);
            $formData['password'] = Hash::make($password);
            $user = User::create($formData);
            return $this->sendResponse([], "User Successfully Created.");
        } catch (\Throwable $th) {
            return $this->sendError($th, "Something went wrong");
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
