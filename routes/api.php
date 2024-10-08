<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ToDoController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post("/login", [AuthController::class, "login"]);

Route::middleware("auth:sanctum")->group(function() {
    Route::apiResources([
        "users" => UserController::class,
        "todos" => ToDoController::class,
    ]);
    Route::post("/logout", [AuthController::class, "logout"]);
});
