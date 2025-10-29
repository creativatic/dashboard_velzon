<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;   // ✅ Importante
use App\Models\Persona;              // ✅ Importante
use App\Models\Epp;     

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

    public function buscarPorDni($dni)
    { 
        $persona = Persona::where('dni', $dni)->first();

        if (!$persona) {
            return response()->json(['error' => 'No se encontró ninguna persona con ese DNI.'], 404);
        }

        // 🔹 Agrupamos las entregas por nombre y AHORA POR ID de EPP
        $entregas = DB::table('epp_persona')
            ->join('epps', 'epp_persona.epp_id', '=', 'epps.id')
            ->select(
                'epps.nombre as epp',
                'epps.id as epp_id', // <--- ¡Añadido!
                DB::raw('SUM(epp_persona.cantidad) as total_entregado'),
                DB::raw('MAX(epp_persona.fecha_entrega) as ultima_entrega'),
                DB::raw('MAX(epp_persona.fecha_devolucion) as ultima_devolucion')
            )
            ->where('persona_id', $persona->id)
            ->groupBy('epps.nombre', 'epps.id') // <--- ¡Añadido al GROUP BY!
            ->orderBy('epps.nombre')
            ->get();

        return response()->json([
            'persona' => $persona,
            'entregas' => $entregas
        ]);
    }

    public function detallesEntrega($dni, $nombreEpp)
    {
        $persona = Persona::where('dni', $dni)->first();

        if (!$persona) {
            return response()->json(['error' => 'Persona no encontrada'], 404);
        }

        $detalles = DB::table('epp_persona')
            ->join('epps', 'epp_persona.epp_id', '=', 'epps.id')
            ->select(
                'epps.nombre as epp',
                'epp_persona.cantidad',
                'epp_persona.fecha_entrega',
                'epp_persona.fecha_devolucion',
                'epp_persona.observacion'
            )
            ->where('persona_id', $persona->id)
            ->where('epps.nombre', $nombreEpp)
            ->orderByDesc('epp_persona.fecha_entrega')
            ->get();

        return response()->json($detalles);
    }

    // DashboardController.php
public function detalles($personaId, $eppId)
{
    $detalles = \DB::table('epp_persona')
        ->where('persona_id', $personaId)
        ->where('epp_id', $eppId)
        ->select('cantidad', 'fecha_entrega', 'fecha_devolucion', 'observacion')
        ->orderBy('fecha_entrega', 'desc')
        ->get();

    return response()->json($detalles);
}


}