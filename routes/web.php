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
use App\Http\Controllers\ReporteController;


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
        Route::resource('programacions', ProgramacionController::class);

        // Buscadores
        Route::get('/programaciones/search', [ExpedienteController::class, 'buscarProgramacion'])->name('programaciones.search');
        Route::get('/programacion/{id}', [ProgramacionController::class, 'showJson']);

        //Route::get('/tisurs/search', [ExpedienteController::class, 'buscarTisur'])->name('tisurs.search');
        //Route::get('/detalles/search', [ExpedienteController::class, 'buscarDetalle'])->name('detalles.search');


        // Adelantos
        Route::resource('adelantos', AdelantoController::class)->only(['index', 'edit', 'update']);

        // Route::resource('adelantos', AdelantoController::class)->except(['show']);
        // QR Tisur
        Route::get('/reportes/reporte-qr', [ReporteController::class, 'reporteQr'])->name('reportes.reporte_qr');
        Route::get('/reportes/exportar-qr', [ReporteController::class, 'exportQr'])->name('reportes.export_qr');
        //Route::get('/programacions/reporte-qr', [ProgramacionController::class, 'reporteQr'])->name('programacions.reporte_qr');
        // Detalles
        //Route::resource('detalleprogramacion', DetalleProgramacionController::class)->except(['show']);
        Route::resource('detalleprogramacion', DetalleProgramacionController::class);
        // Tisur
        Route::resource('tisur', TisurController::class)->except(['show']);
        // Expediente
        Route::resource('expediente', ExpedienteController::class);
        // 🔹 Ruta AJAX para obtener datos de Programación por ID
        Route::get('/expediente/programacion/{id}', [ExpedienteController::class, 'getProgramacion'])->name('expediente.getProgramacion');
        Route::get('/expediente/tisur/{id}', [ExpedienteController::class, 'getTisur']);
        Route::get('/expediente/detalle/{id}', [ExpedienteController::class, 'getDetalle']);
        Route::get('/expediente/{id}', [ExpedienteController::class, 'show'])->name('expediente.show');
        Route::get('/expediente/{id}/edit', [ExpedienteController::class, 'edit'])->name('expediente.edit');
        Route::get('/expediente/precio-tn', [ExpedienteController::class, 'getPrecioTn']);



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
