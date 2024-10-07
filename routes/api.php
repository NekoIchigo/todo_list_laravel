<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post("/login", "AuthController@login");

Route::middleware("auth:sanctum")->group(function() {

    Route::post("/logout", "AuthController@logout");
});
