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

        // 🔹 Consulta con PAGINACIÓN (12 por página)
        $entregas = DB::table('epp_persona')
            ->join('epps', 'epp_persona.epp_id', '=', 'epps.id')
            ->select(
                'epps.id as epp_id',
                'epps.nombre as epp',
                'epps.unidades_medidas',
                DB::raw('SUM(epp_persona.cantidad) as total_entregado'),
                DB::raw('SUM(CASE WHEN epp_persona.fecha_devolucion IS NOT NULL THEN epp_persona.cantidad ELSE 0 END) as total_devuelto_epp'),
                DB::raw('MAX(epp_persona.fecha_entrega) as ultima_entrega'),
                DB::raw('MAX(epp_persona.fecha_devolucion) as ultima_devolucion')
            )
            ->where('persona_id', $persona->id)
            ->groupBy('epps.id', 'epps.nombre', 'epps.unidades_medidas')
            ->orderBy('epps.nombre')
            ->paginate(5); // <<<<<<<<<<<<<<<<<< PAGINACIÓN ACTIVADA

        // 🔹 Totales globales
        $totalDevueltoGlobal = DB::table('epp_persona')
            ->where('persona_id', $persona->id)
            ->whereNotNull('fecha_devolucion')
            ->sum('cantidad');

        $totalEntregadoGlobal = DB::table('epp_persona')
            ->where('persona_id', $persona->id)
            ->sum('cantidad');

        return response()->json([
            'persona' => $persona,
            'entregas' => $entregas->items(),

            'links' => [
                'current_page' => $entregas->currentPage(),
                'last_page' => $entregas->lastPage(),
                'next' => $entregas->nextPageUrl(),
                'prev' => $entregas->previousPageUrl(),
            ],

            'total_devuelto_global' => $totalDevueltoGlobal,
            'total_entregado_global' => $totalEntregadoGlobal
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
            ->paginate(10);

            return response()->json([
                'persona' => $persona,
                'entregas' => $entregas->items(),

                // 👇 Paginación completa
                'pagination' => [
                    'current_page' => $entregas->currentPage(),
                    'last_page' => $entregas->lastPage(),
                    'next' => $entregas->nextPageUrl(),
                    'prev' => $entregas->previousPageUrl(),
                    'total' => $entregas->total(),
                ],

                'total_devuelto_global' => $totalDevueltoGlobal,
                'total_entregado_global' => $totalEntregadoGlobal
            ]);
    }

    // DashboardController.php
    public function detalles($personaId, $eppId)
    {
        $detalles = DB::table('epp_persona')
            ->join('epps', 'epp_persona.epp_id', '=', 'epps.id') // ✅ Unimos con epps
            ->where('epp_persona.persona_id', $personaId)
            ->where('epp_persona.epp_id', $eppId)
            ->select(
                'epp_persona.cantidad',
                'epps.unidades_medidas', // ✅ Añadido
                'epp_persona.fecha_entrega',
                'epp_persona.fecha_devolucion',
                'epp_persona.observacion'
            )
            ->orderBy('epp_persona.fecha_entrega', 'desc')
            ->get();

        return response()->json($detalles);
    }

    public function autocompleteDni(Request $request)
    {
        $term = $request->get('term');

        $resultados = Persona::where('dni', 'LIKE', "%{$term}%")
            ->orWhere('nombres', 'LIKE', "%{$term}%")
            ->select('dni', 'nombres')
            ->limit(10)
            ->get();

        // Devolvemos en formato compatible con jQuery UI Autocomplete
        $sugerencias = $resultados->map(function ($persona) {
            return [
                'label' => "{$persona->dni} - {$persona->nombres}",
                'value' => $persona->dni,
            ];
        });

        return response()->json($sugerencias);
    }

}