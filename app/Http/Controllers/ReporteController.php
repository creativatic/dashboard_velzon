<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EntregaEpp;
use Illuminate\Support\Facades\DB;

class ReporteController extends Controller
{
    public function index(Request $request)
    {
        $orden = $request->get('orden_trabajo');

        $registros = collect();

        if ($orden) {

            $registros = EntregaEpp::query()
                ->join('personas', 'personas.id', '=', 'epp_persona.persona_id')
                ->select(
                    'personas.dni',
                    'personas.nombres as persona',

                    DB::raw('COUNT(epp_persona.id) as total_epps'),
                    DB::raw('SUM(epp_persona.cantidad) as cantidad_total'),

                    DB::raw('MAX(epp_persona.fecha_entrega) as ultima_entrega'),
                    DB::raw('MAX(epp_persona.fecha_devolucion) as fecha_devolucion'),

                    DB::raw('MAX(epp_persona.numero_vale) as numero_vale'),
                    'epp_persona.orden_trabajo',
                    DB::raw('MAX(epp_persona.observacion) as observacion')
                )
                ->where('epp_persona.orden_trabajo', $orden)
                ->groupBy(
                    'personas.id',
                    'personas.dni',
                    'personas.nombres',
                    'epp_persona.orden_trabajo'
                )
                ->orderBy('personas.nombres')
                ->paginate(15)->withQueryString();
        }

        return view('reportes.index', compact('registros', 'orden'));
    }
}
