<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\NewPasswordController;

Route::get('/dashboard', function () {
    return view('dashboard'); // crea resources/views/dashboard.blade.php
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Registro
Route::get('/register', [RegisteredUserController::class, 'create'])
    ->name('register'); // formulario

Route::post('/register', [RegisteredUserController::class, 'store']);

// Ruta principal -> login
Route::get('/', [AuthenticatedSessionController::class, 'create'])
    ->name('login');

Route::get('/login', [AuthenticatedSessionController::class, 'create'])
    ->name('login'); // vista de login

Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login.store');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');

// Solicitud de enlace de restablecimiento (muestra formulario de "olvidé mi contraseña")
Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
    ->middleware('guest')
    ->name('password.request');

// Envía el email con el enlace
Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
    ->middleware('guest')
    ->name('password.email');

// Formulario para restablecer la contraseña desde el enlace recibido
Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
    ->middleware('guest')
    ->name('password.reset');

// Guarda la nueva contraseña
Route::post('/reset-password', [NewPasswordController::class, 'store'])
    ->middleware('guest')
    ->name('password.update');