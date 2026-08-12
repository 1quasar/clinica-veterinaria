<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;


Route::get('/', function () {
    return view('welcome');
});


/**
 * Rotas do Dashboard
 */
Route::middleware('auth')->group(function () {
    Route::get('/dashboard',  [DashboardController::class, 'index'])
        ->name('dashboard');
});




/**
 * Rotas de Login
 */
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');

Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');