<?php

use App\Http\Controllers\Api\AnimalController;
use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DashboardController;

// Endpoit aberto: Login e Emissão de Tokens
Route::post('/login', [AuthController::class, 'login']);

// Endpoints Protegidos por Bearer Token via Sanctum
Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);

<<<<<<< HEAD
    Route::get('/dashboard', [DashboardController::class, 'index']);
=======
    Route::apiResource('animals', AnimalController::class);
>>>>>>> 78334b3b5188b16b6e6dca2a565eb464d4fba57a
});
