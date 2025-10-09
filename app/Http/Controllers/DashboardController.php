<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Mostrar el panel principal (Dashboard)
     */
    public function index()
    {
        // Puedes enviar datos a la vista si lo deseas
        $user = Auth::user();
        $pageTitle = 'Panel Principal';

        // Aquí puedes agregar datos dinámicos del sistema (ej. ventas, usuarios, etc.)
        $stats = [
            'usuarios' => 25,   // Ejemplo estático (luego puedes reemplazar por User::count())
            'ventas' => 120,
            'ingresos' => 3400.75,
        ];

        return view('dashboard', compact('user', 'pageTitle', 'stats'));
    }

    /**
     * Ejemplo de otra sección dentro del dashboard (opcional)
     */
    public function analytics()
    {
        $pageTitle = 'Reportes y Analíticas';
        return view('dashboard.analytics', compact('pageTitle'));
    }
}