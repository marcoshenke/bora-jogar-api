<?php

use App\Http\Controllers\Auth\PasswordResetController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterPlayerController;

// public routes
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/forgot-password', [PasswordResetController::class, 'sendResetLink']);
Route::post('/reset-password', [PasswordResetController::class, 'resetPassword']);
Route::post('/verify-reset-token', [PasswordResetController::class, 'verifyToken']);

// protect routes
Route::middleware('auth:sanctum')->group(function () {
    Route::post('create-player', [RegisterPlayerController::class, 'store']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);
});
