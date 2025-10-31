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
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\EppController;
use App\Http\Controllers\EntregaEppController;

Route::middleware(['auth'])->group(function () {

    // Dashboard
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->middleware('permission:ver dashboard')
        ->name('dashboard');

    // Búsqueda por DNI
    Route::get('/dashboard/buscar/{dni}', [DashboardController::class, 'buscarPorDni'])->name('dashboard.buscar');

    // Detalles de EPP por Persona ID y EPP ID (Usado por JS)
    // Nota: He cambiado el nombre del parámetro de {persona} a {personaId} para mayor claridad
    Route::get('/dashboard/detalles/{personaId}/{eppId}', [DashboardController::class, 'detalles'])->name('dashboard.detalles');
    Route::get('/dashboard/autocomplete-dni', [DashboardController::class, 'autocompleteDni']);

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
        Route::resource('personas', PersonaController::class);  
        Route::get('/personas/buscar/{dni}', [PersonaController::class, 'buscar']);

        Route::resource('epps', EppController::class);
        //Route::get('entregas', [EntregaEppController::class, 'index'])->name('entregas.index');
        //Route::post('entregas/{persona}/asignar', [EntregaEppController::class, 'asignarEpp'])->name('entregas.asignar');
        //Route::post('entregas/{persona}/{epp}/devolver', [EntregaEppController::class, 'devolverEpp'])->name('entregas.devolver');

        Route::resource('entregas', EntregaEppController::class)->only(['index', 'store']);
        Route::put('entregas/{id}/devolver', [EntregaEppController::class, 'devolver'])->name('entregas.devolver');
        Route::put('entregas/{id}', [EntregaEppController::class, 'update'])->name('entregas.update');
        Route::get('entregas/{id}', [EntregaEppController::class, 'show'])->name('entregas.show');
        Route::get('/entregas/persona/{id}', [EntregaEppController::class, 'entregasPorPersona']);
        Route::get('/entregas/persona/{id}', [EntregaEppController::class, 'entregasPorPersona'])->name('entregas.persona');



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
