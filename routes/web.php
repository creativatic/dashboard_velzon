<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ProgramacionController;
use App\Http\Controllers\AdelantoController;
use App\Http\Controllers\QrTisurController;
use App\Http\Controllers\DetalleProgramacionController;
use App\Http\Controllers\TisurController;
use App\Http\Controllers\ExpedienteController;
use App\Http\Controllers\SeguimientoController;

Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->middleware('permission:ver dashboard')
        ->name('dashboard');

    // Perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Solo administrador
    Route::middleware('role:Administrador')->group(function () {
        Route::resource('users', UserController::class)->except(['show']);
        Route::resource('roles', RoleController::class)->except(['show']);
        Route::resource('permissions', PermissionController::class)->except(['show']);
        Route::resource('programacions', ProgramacionController::class)->except(['show']);
        // Adelantos
        Route::resource('adelantos', AdelantoController::class)->except(['show']);
        // QR Tisur
        Route::resource('qr_tisurs', QrTisurController::class)->except(['show']);
        // Detalles
        Route::resource('detalleprogramacion', DetalleProgramacionController::class)->except(['show']);
        // Tisur
        Route::resource('tisur', TisurController::class)->except(['show']);
        // Expediente
        Route::resource('expediente', ExpedienteController::class)->except(['show']);
        //  Seguimiento
        Route::resource('seguimientos', SeguimientoController::class)->except(['show']);

    });
});

// Registro
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);

// Login
Route::get('/', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login.store');
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

// Recuperación de contraseña
Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])->middleware('guest')->name('password.request');
Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])->middleware('guest')->name('password.email');
Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])->middleware('guest')->name('password.reset');
Route::post('/reset-password', [NewPasswordController::class, 'store'])->middleware('guest')->name('password.update');
