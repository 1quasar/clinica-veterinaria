<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

// Redirecionamentos da raiz
Route::get('/', function () {
    return redirect()->route('login');
});


// Rotas para visitante (não autenticados)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});


// Rotas protedidas (autenticados e com conta ativa)
Route::middleware(['auth', 'user.active'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');    

    Route::get('/dashboard',  [DashboardController::class, 'index'])
        ->name('dashboard');

    // CRUD de usuários
    Route::middleware(['role:admin'])->group(function() {
        Route::resource('users', UserController::class)->parameters([
                'users' => 'user',
        ]);
    });
   
});


// Rotas de Autenticação
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');

Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');