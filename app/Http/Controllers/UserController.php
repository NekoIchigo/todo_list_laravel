<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\ApiResponseTraits;
use DB;
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
        $users = User::with("userDetail")->paginate(10);
        return $this->sendResponse($users, "User List");
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
            "first_name" => "required",
            "last_name" => "required",
            "email" => "required|email",
            "user_type" => "required",
        ]);
        try {
            DB::beginTransaction();

            $password = Str::random(5);
            $formData['password'] = Hash::make($password);
            $user = User::create($formData);
            $user->userDetail()->create($formData);

            DB::commit();
            return $this->sendResponse([], "User Successfully Created.");
        } catch (\Throwable $th) {
            DB::rollBack();
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
        $formData = $request->validate([
            "username" => "required",
            "first_name" => "required",
            "last_name" => "required",
            "email" => "required|email",
            "user_type" => "required",
        ]);
        try {
            DB::beginTransaction();

            $user = User::findOrFail($id);
            $user->update($formData);
            $user->userDetail()->update($formData);

            DB::commit();
            return $this->sendResponse([], "User Successfully Updated.");
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->sendError($th, "Something went wrong");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return $this->sendResponse([], "User Successfully Deleted.");
    }
}
