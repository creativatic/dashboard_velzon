<?php

namespace App\Http\Controllers;

use App\Models\Epp;
use App\Models\Persona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EntregaEppController extends Controller
{
    public function index(Request $request)
    {
        $query = DB::table('epp_persona')
            ->join('personas', 'epp_persona.persona_id', '=', 'personas.id')
            ->select(
                'personas.id as persona_id',
                'personas.dni',
                // Si quieres nombre completo, cambia 'nombres' por CONCAT(personas.nombres, ' ', personas.apellidos)
                'personas.nombres as persona', 
                DB::raw('MAX(epp_persona.fecha_entrega) as ultima_entrega')
            )
            ->groupBy('personas.id', 'personas.dni', 'personas.nombres');

        // 🟢 NUEVO FILTRO: DNI
        if ($request->filled('dni')) {
            // Usamos 'like' para permitir búsquedas parciales
            $query->where('personas.dni', 'like', '%' . $request->dni . '%'); 
        }

        // 🔹 Filtro por fecha (si el usuario selecciona)
        if ($request->filled('desde')) {
            $query->whereDate('epp_persona.fecha_entrega', '>=', $request->desde);
        }

        if ($request->filled('hasta')) {
            $query->whereDate('epp_persona.fecha_entrega', '<=', $request->hasta);
        }

        $entregas = $query->orderByDesc('ultima_entrega')->paginate(8);

        // 🔹 Mantener los parámetros en los enlaces de paginación
        // ✅ AÑADIMOS 'dni' a la lista de parámetros a mantener
        $entregas->appends($request->only(['dni', 'desde', 'hasta'])); 

        $personas = Persona::orderBy('nombres')->get();
        $epps = Epp::where('estado', 1)->orderBy('nombre')->get();

        return view('entregas.index', compact('entregas', 'personas', 'epps'));
    }
    
    public function show($id)
    {
        $entrega = DB::table('epp_persona')
            ->join('personas', 'epp_persona.persona_id', '=', 'personas.id')
            ->join('epps', 'epp_persona.epp_id', '=', 'epps.id')
            ->select(
                'epp_persona.id',
                'epp_persona.persona_id',
                'epp_persona.epp_id',
                'personas.nombres as persona',
                'epps.nombre as epp',
                'epps.unidades_medidas', // ✅ agregamos esta línea
                'epp_persona.cantidad',
                'epp_persona.fecha_entrega',
                'epp_persona.fecha_devolucion',
                'epp_persona.observacion',
                'epp_persona.numero_vale',
                'epp_persona.orden_trabajo'
            )
            ->where('epp_persona.id', $id)
            ->first();

        return response()->json($entrega);
    }

    public function update(Request $request, $id)
    {
        // 🚨 AÑADIR VALIDACIÓN AQUÍ
        $request->validate([
            'cantidad' => 'required|integer|min:1',
            'fecha_entrega' => 'required|date',
            // Valida que la fecha de devolución sea una fecha (si se proporciona) y no sea posterior a hoy.
            'fecha_devolucion' => 'nullable|date|before_or_equal:today', 
            'observacion' => 'nullable|string',
            'numero_vale' => 'nullable|string|max:50',
            'orden_trabajo' => 'nullable|string|max:50',
        ]);
        // 🚨 FIN DE VALIDACIÓN

        DB::table('epp_persona')->where('id', $id)->update([
            // ... (resto de tus campos de actualización)
            'cantidad' => $request->cantidad,
            'fecha_entrega' => $request->fecha_entrega,
            'fecha_devolucion' => $request->fecha_devolucion,
            'observacion' => $request->observacion,
            'numero_vale' => $request->numero_vale,
            'orden_trabajo' => $request->orden_trabajo,
            'updated_at' => now(),
        ]);

        // ... (resto del código del método update)

        // Si es AJAX devolvemos 200 sin redirigir
        if ($request->ajax()) {
            return response()->json(['success' => true]);
        }

        return redirect()->back()->with('success', 'Entrega actualizada correctamente.');
    }


    public function store(Request $request)
    {
        $request->validate([
            'persona_id' => 'required|exists:personas,id',
            'fecha_entrega' => 'required|date',
            'numero_vale' => 'nullable|string|max:50',
            'orden_trabajo' => 'nullable|string|max:50',
            'epps' => 'required|array|min:1',
            'epps.*.epp_id' => 'required|exists:epps,id',
            'epps.*.cantidad' => 'required|integer|min:1',
            'epps.*.observacion' => 'nullable|string'
        ]);

        DB::beginTransaction();
        try {
            foreach ($request->epps as $item) {
                // Registrar cada entrega
                DB::table('epp_persona')->insert([
                    'persona_id' => $request->persona_id,
                    'epp_id' => $item['epp_id'],
                    'fecha_entrega' => $request->fecha_entrega,
                    'cantidad' => $item['cantidad'],
                    'observacion' => $item['observacion'] ?? null,
                    'numero_vale' => $request->numero_vale,
                    'orden_trabajo' => $request->orden_trabajo,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);

                // Actualizar stock
                $epp = Epp::findOrFail($item['epp_id']);
                $epp->decrement('stock', $item['cantidad']);
            }

            DB::commit();
            return redirect()->route('entregas.index')->with('success', 'Entrega registrada correctamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Ocurrió un error al registrar la entrega: ' . $e->getMessage());
        }
    }

    public function devolver($id)
    {
        $entrega = DB::table('epp_persona')->where('id', $id)->first();
        if (!$entrega) {
            return back()->with('error', 'Registro no encontrado.');
        }

        DB::table('epp_persona')
            ->where('id', $id)
            ->update(['fecha_devolucion' => now()]);

        // Devolver al stock
        $epp = Epp::find($entrega->epp_id);
        if ($epp) {
            $epp->increment('stock', $entrega->cantidad);
        }

        return redirect()->route('entregas.index')->with('success', 'EPP devuelto correctamente.');
    }

    public function entregasPorPersona($persona_id)
    {
        // Obtengo los EPPs que la persona ha recibido (incluyendo unidades_medidas)
        $epps = DB::table('epp_persona')
            ->join('epps', 'epp_persona.epp_id', '=', 'epps.id')
            ->select('epps.id as epp_id', 'epps.nombre as epp', 'epps.unidades_medidas')
            ->where('epp_persona.persona_id', $persona_id)
            ->groupBy('epps.id', 'epps.nombre', 'epps.unidades_medidas')
            ->get();

        $resultado = [];

        foreach ($epps as $epp) {
            $registros = DB::table('epp_persona')
                ->select(
                    'epp_persona.id',
                    'epp_persona.cantidad',
                    'epp_persona.numero_vale',
                    'epp_persona.orden_trabajo',
                    'epp_persona.fecha_entrega',
                    'epp_persona.fecha_devolucion',
                    'epp_persona.observacion'
                )
                ->where('epp_persona.persona_id', $persona_id)
                ->where('epp_persona.epp_id', $epp->epp_id)
                ->orderByDesc('epp_persona.fecha_entrega')
                ->limit(2)
                ->get();

            // Agrego la unidad de medida a cada registro (la tomamos del epp agrupado)
            $registrosConUnidad = $registros->map(function($r) use ($epp) {
                return array_merge((array)$r, ['unidades_medidas' => $epp->unidades_medidas]);
            });

            $resultado[] = [
                'epp' => $epp->epp,
                'registros' => $registrosConUnidad
            ];
        }

        return response()->json($resultado);
    }



}


