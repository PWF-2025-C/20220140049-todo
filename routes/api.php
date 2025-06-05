<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Login route (tidak perlu auth)
Route::post('/login', [AuthController::class, 'login']);

// Routes yang memerlukan autentikasi JWT
Route::middleware('auth:api')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
});
