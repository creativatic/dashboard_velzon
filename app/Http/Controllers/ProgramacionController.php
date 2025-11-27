<?php

namespace App\Http\Controllers;

use App\Models\Programacion;
use Illuminate\Http\Request;
use App\Models\DetalleProgramacion;
use App\Models\Unidad;
use Carbon\Carbon;
use App\Models\Conductor;
use App\Models\Proveedor;

class ProgramacionController extends Controller
{
    /**
     * Muestra el listado de programaciones.
     */
    public function index()
    {
        $programaciones = Programacion::with([
            'detalleProgramacion',
            'proveedor.unidades.conductor'
        ])->orderBy('fecha_programacion', 'desc')->get();

        $detalles = DetalleProgramacion::where('activo', true)->get();
        $licencias = Unidad::with('conductor')->get(); // <- Agregado
        $conductores = Conductor::select('id', 'licencia', 'nombres')
        ->orderBy('nombres')
        ->get();

        return view('programacions.index', compact('programaciones', 'detalles', 'licencias', 'conductores'));
    }

    public function showJson($id)
    {
        $programacion = Programacion::with('detalleProgramacion')->findOrFail($id);
        return response()->json($programacion);
    }
    /**
     * Guarda una nueva programación desde el modal.
     */

    public function create()
    {
        $detalles = DetalleProgramacion::where('activo', true)->get();
 

        return view('programacions.create', compact('detalles'));
    }

    /** GUARDAR **/
    public function store(Request $request)
    {
        $validated = $request->validate([
            'fecha_programacion' => 'required|string',
            'detalle_programacion_id' => 'nullable|exists:detalle_programacions,id',

            // Datos del conductor
            'licencia' => 'nullable|string|max:20',
            'dni' => 'nullable|string|max:8',
            'nombres_conductor' => 'nullable|string|max:100',
            'apellidos_conductor' => 'nullable|string|max:100',
            'telefono_conductor' => 'nullable|string|max:20',

            // Datos unidad
            'placa_tracto' => 'nullable|string|max:20',
            'placa_carreta' => 'nullable|string|max:20',
            'marca_vehiculo' => 'nullable|string|max:50',
            'tipo_plataforma' => 'nullable|string|max:50',
            'constancia_mtc_tracto' => 'nullable|string|max:100',
            'constancia_mtc_carreta' => 'nullable|string|max:100',

            // Datos proveedor
            'razon_social_transporte' => 'nullable|string|max:100',
            'ruc_transporte' => 'nullable|string|max:11',
            'cuenta_banco' => 'nullable|string|max:50',
            'cci_banco' => 'nullable|string|max:50',
            'banco' => 'nullable|string|max:50',

            // Otros
            'tipo_mineral' => 'nullable|string|max:50',
            'tipo_operacion' => 'nullable|in:nacional,internacional',
            'conformidad_adelanto' => 'nullable|in:Ok,Pendiente',
            'guia_remision' => 'nullable|string|max:100',
            'guia_transportista' => 'nullable|string|max:50',
            'grupo_cargio' => 'nullable|string|max:100',
        ]);

        /** Normalizar fecha **/
        $validated['fecha_programacion'] = Carbon::parse($validated['fecha_programacion'])
            ->format('Y-m-d H:i:s');

        /** Obtener proveedor desde conductor → unidad **/
        /** Obtener proveedor desde conductor → unidad **/
        if (!empty($validated['licencia'])) {

            $conductor = Conductor::with('unidad.proveedor')
                ->where('licencia', $validated['licencia'])
                ->first();

            if ($conductor) {
                $validated['conductor_id'] = $conductor->id;

                if ($conductor->unidad) {

                    $validated['unidad_id'] = $conductor->unidad->id;

                    if ($conductor->unidad->proveedor) {

                        // Esto llena ambos valores
                        $validated['proveedor_id'] = $conductor->unidad->proveedor->id;
                        $validated['ruc_transporte'] = $conductor->unidad->proveedor->ruc_transporte;

                        // También se puede cargar razón social automáticamente
                        $validated['razon_social_transporte'] = $conductor->unidad->proveedor->razon_social;
                    }
                }
            }
        }

        /** Buscar proveedor por ruc_transporte si no vino de la licencia **/
        if (!empty($validated['ruc_transporte']) && empty($validated['proveedor_id'])) {
            $proveedor = Proveedor::where('ruc_transporte', $validated['ruc_transporte'])->first();
            if ($proveedor) {
                $validated['proveedor_id'] = $proveedor->id;
            }
        }

        // -------------------------------------------------------------
        // LIMPIEZA FINAL: eliminar campos que NO pertenecen a programacions
        // -------------------------------------------------------------
        unset($validated['licencia']);
        unset($validated['dni']);
        unset($validated['nombres_conductor']);
        unset($validated['apellidos_conductor']);
        unset($validated['telefono_conductor']);

        unset($validated['placa_tracto']);
        unset($validated['placa_carreta']);
        unset($validated['marca_vehiculo']);
        unset($validated['tipo_plataforma']);
        unset($validated['constancia_mtc_tracto']);
        unset($validated['constancia_mtc_carreta']);

        unset($validated['razon_social_transporte']);
        unset($validated['ruc_transporte']);
        unset($validated['cuenta_banco']);
        unset($validated['cci_banco']);
        unset($validated['banco']);

        Programacion::create($validated);

        return redirect()->route('programacions.index')
            ->with('success', 'Programación creada correctamente.');
    }


    /**
     * Muestra la información para edición (AJAX o modal).
     */
    public function edit(Programacion $programacion)
    {
        $detalles = DetalleProgramacion::where('activo', true)->get();
        $licencias = Unidad::with('conductor')->get();
        return view('programacions.edit', compact('programacion', 'detalles', 'licencias'));
    }
    /**
     * Actualiza una programación existente.
     */
    public function update(Request $request, Programacion $programacion)
    {
        $validated = $request->validate([
            'fecha_programacion' => 'required|string',
            'detalle_programacion_id' => 'nullable|exists:detalle_programacions,id',

            // Datos del conductor
            'licencia' => 'nullable|string|max:20',
            'dni' => 'nullable|string|max:8',
            'nombres_conductor' => 'nullable|string|max:100',
            'apellidos_conductor' => 'nullable|string|max:100',
            'telefono_conductor' => 'nullable|string|max:20',

            // Datos unidad
            'placa_tracto' => 'nullable|string|max:20',
            'placa_carreta' => 'nullable|string|max:20',
            'marca_vehiculo' => 'nullable|string|max:50',
            'tipo_plataforma' => 'nullable|string|max:50',
            'constancia_mtc_tracto' => 'nullable|string|max:100',
            'constancia_mtc_carreta' => 'nullable|string|max:100',

            // Datos proveedor
            'razon_social_transporte' => 'nullable|string|max:100',
            'ruc_transporte' => 'nullable|string|max:11',
            'cuenta_banco' => 'nullable|string|max:50',
            'cci_banco' => 'nullable|string|max:50',
            'banco' => 'nullable|string|max:50',

            // Otros
            'tipo_mineral' => 'nullable|string|max:50',
            'tipo_operacion' => 'nullable|in:nacional,internacional',
            'conformidad_adelanto' => 'nullable|in:Ok,Pendiente',
            'guia_remision' => 'nullable|string|max:100',
            'guia_transportista' => 'nullable|string|max:50',
            'grupo_cargio' => 'nullable|string|max:100',
        ]);

        /** Normalizar fecha **/
        try {
            $validated['fecha_programacion'] = Carbon::parse($validated['fecha_programacion'])
                ->format('Y-m-d H:i:s');
        } catch (\Exception $e) {
            return back()->withErrors(['fecha_programacion' => 'Formato de fecha inválido'])->withInput();
        }

        /** ===================================================================
         *   OBTENER conductor → unidad → proveedor IGUAL QUE EN EL CREATE
         * =================================================================== */

        /** ================================================================
         *   1. Obtener conductor → unidad → proveedor (igual que CREATE)
         * ================================================================= */
        if (!empty($validated['licencia'])) {

            $conductor = Conductor::with('unidad.proveedor')
                ->where('licencia', $validated['licencia'])
                ->first();

            if ($conductor) {

                // Actualiza conductor_id
                $validated['conductor_id'] = $conductor->id;

                if ($conductor->unidad) {

                    // Actualiza unidad_id
                    $validated['unidad_id'] = $conductor->unidad->id;

                    if ($conductor->unidad->proveedor) {

                        // Actualiza proveedor_id y ruc_transporte ANTES de limpiar
                        $validated['proveedor_id'] = $conductor->unidad->proveedor->id;
                        $validated['ruc_transporte'] = $conductor->unidad->proveedor->ruc_transporte;

                        $validated['razon_social_transporte'] =
                            $conductor->unidad->proveedor->razon_social;
                    }
                }
            }
        }

        /** ================================================================
         *   2. Si el usuario cambió el RUC manualmente → actualizar proveedor
         * ================================================================= */
        if (!empty($validated['ruc_transporte'])) {

            $proveedor = Proveedor::where('ruc_transporte', $validated['ruc_transporte'])
                ->first();

            if ($proveedor) {
                $validated['proveedor_id'] = $proveedor->id;
            }
        }

        /** ================================================================
         *   3. LIMPIEZA FINAL (pero después de utilizar ruc_transporte)
         * ================================================================= */
        unset($validated['licencia'], $validated['dni'], $validated['nombres_conductor'],
            $validated['apellidos_conductor'], $validated['telefono_conductor']);

        unset($validated['placa_tracto'], $validated['placa_carreta'], $validated['marca_vehiculo'],
            $validated['tipo_plataforma'], $validated['constancia_mtc_tracto'],
            $validated['constancia_mtc_carreta']);

        unset($validated['razon_social_transporte'], $validated['ruc_transporte'], $validated['cuenta_banco'],
            $validated['cci_banco'], $validated['banco']);

        /** APLICAR UPDATE */
        $programacion->update($validated);


        return redirect()->route('programacions.index')
            ->with('success', 'Programación actualizada correctamente.');
    }

    /**
     * Elimina una programación.
     */
    public function destroy(Programacion $programacion)
    {
        $programacion->delete();

        return redirect()->route('programacions.index')->with('success', 'Programación eliminada correctamente.');
    }

    // ProgramacionController.php
    public function searchConductores(Request $request)
    {
        $term = $request->get('term', '');

        $query = Conductor::query()
            ->with('unidad.proveedor')
            // Filtrar solo conductores que tengan una unidad con proveedor asociado
            ->whereHas('unidad', function ($q) {
                $q->whereNotNull('proveedor_id');
            })
            ->when($term, function ($q) use ($term) {
                $q->where('licencia', 'like', "%{$term}%")
                ->orWhere('nombres', 'like', "%{$term}%")
                ->orWhere('apellidos', 'like', "%{$term}%")
                ->orWhereRaw("CONCAT(nombres, ' ', apellidos) LIKE ?", ["%{$term}%"]);
            })
            ->limit(50);

        $results = $query->get();

        $data = $results->map(function ($c) {
            $label = trim(($c->licencia ? $c->licencia . ' - ' : '') . ($c->nombres ?: '') . ' ' . ($c->apellidos ?: ''));
            return [
                'id' => $c->licencia,
                'text' => $label,
                'licencia' => $c->licencia,
                'nombres' => $c->nombres,
                'apellidos' => $c->apellidos,
                'dni' => $c->dni,
                'telefono' => $c->telefono,
                'unidad' => $c->unidad ? [
                    'id' => $c->unidad->id,
                    'placa_tracto' => $c->unidad->placa_tracto,
                    'placa_carreta' => $c->unidad->placa_carreta,
                    'marca_vehiculo' => $c->unidad->marca_vehiculo,
                    'tipo_plataforma' => $c->unidad->tipo_plataforma,
                    'constancia_mtc_tracto' => $c->unidad->constancia_mtc_tracto,
                    'constancia_mtc_carreta' => $c->unidad->constancia_mtc_carreta,
                ] : null,
                'proveedor' => $c->unidad && $c->unidad->proveedor ? [
                    'id' => $c->unidad->proveedor->id,
                    'ruc_transporte' => $c->unidad->proveedor->ruc_transporte ?? $c->unidad->proveedor->ruc ?? '',
                    'razon_social_transporte' => $c->unidad->proveedor->razon_social ?? '',
                    'cuenta_banco' => $c->unidad->proveedor->cuenta_banco ?? '',
                    'cci_banco' => $c->unidad->proveedor->cci_banco ?? '',
                    'banco' => $c->unidad->proveedor->banco ?? '',
                ] : null,
            ];
        });

        return response()->json(['results' => $data]);
    }

    // -------------------------
    // Detalle completo por licencia
    // GET /api/conductor/{licencia}
    public function getConductorByLicencia($licencia)
    {
        $conductor = Conductor::with('unidad.proveedor')
            ->where('licencia', $licencia)
            ->whereHas('unidad', function ($q) {
                $q->whereNotNull('proveedor_id');
            })
            ->first();

        if (!$conductor) {
            return response()->json(['error' => 'Licencia no encontrada'], 404);
        }

        $unidad = $conductor->unidad;
        $proveedor = $unidad?->proveedor;

        return response()->json([
            'conductor' => [
                'dni' => $conductor->dni ?? '',
                'nombres' => $conductor->nombres ?? '',
                'apellidos' => $conductor->apellidos ?? '',
                'telefono' => $conductor->telefono ?? '',
                'licencia' => $conductor->licencia ?? '',
            ],
            'unidad' => [
                'placa_tracto' => $unidad->placa_tracto ?? '',
                'placa_carreta' => $unidad->placa_carreta ?? '',
                'marca_vehiculo' => $unidad->marca_vehiculo ?? $unidad->marca ?? '',
                'tipo_plataforma' => $unidad->tipo_plataforma ?? '',
                'constancia_mtc_tracto' => $unidad->constancia_mtc_tracto ?? '',
                'constancia_mtc_carreta' => $unidad->constancia_mtc_carreta ?? '',
                'id' => $unidad->id ?? null,
            ],
            'proveedor' => [
                'id' => $proveedor->id ?? null,
                'ruc_transporte' => $proveedor->ruc_transporte ?? $proveedor->ruc ?? '',
                'razon_social_transporte' => $proveedor->razon_social ?? '',
                'cuenta_banco' => $proveedor->cuenta_banco ?? '',
                'cci_banco' => $proveedor->cci_banco ?? '',
                'banco' => $proveedor->banco ?? '',
            ],
        ]);
    }

}
