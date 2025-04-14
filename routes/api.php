<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\FlagController;
use Illuminate\Support\Facades\Route;

// Authentication routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login'])->name('login');

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    // User routes
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);
    
    // Country routes
    Route::apiResource('countries', CountryController::class);
    
    // Flag routes
    Route::post('/countries/{country}/flag', [FlagController::class, 'uploadFlag']);
    Route::get('/countries/{country}/flag', [FlagController::class, 'getFlag']);
});