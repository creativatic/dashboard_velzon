<?php

namespace App\Http\Controllers;

use App\Models\Programacion;
use App\Models\DetalleProgramacion;
use App\Models\Unidad;
use App\Models\Conductor;
use App\Models\Proveedor;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ProgramacionController extends Controller
{
    public function index()
    {
        $programaciones = Programacion::with([
            'detalleProgramacion',
            'proveedor.unidades.conductores',
        ])->orderByDesc('fecha_programacion')->get();

        $proveedores = Proveedor::with('unidades.conductores')
            ->select('id', 'razon_social', 'ruc_transporte', 'cuenta_banco', 'cci_banco', 'banco')
            ->get();

        $detalles = DetalleProgramacion::where('activo', true)->get();
        $licencias = Unidad::with('conductores')->get();
        $unidades = Unidad::with('proveedor')->get();
        $conductores = Conductor::select('id', 'licencia', 'nombres')->orderBy('nombres')->get();

        return view('programacions.index', compact(
            'programaciones', 'proveedores', 'detalles', 'licencias', 'unidades', 'conductores'
        ));
    }

    public function showJson($id)
    {
        $programacion = Programacion::with([
            'detalleProgramacion',
            'proveedor.unidades.conductores'
        ])->findOrFail($id);

        // Tomar la "unidad principal" del proveedor
        $unidad = $programacion->proveedor->unidades->first();

        // Tomar un conductor asociado a esa unidad
        $conductor = $unidad?->conductores?->first();

        return response()->json([
            'programacion' => $programacion,
            'unidad' => $unidad,
            'conductor' => $conductor,
        ]);
    }



    public function create()
    {
        $detalles = DetalleProgramacion::where('activo', true)->get();
        $proveedores = Proveedor::with('unidades.conductores')->get();
        return view('programacions.create', compact('detalles', 'proveedores'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'fecha_programacion' => 'required|string',
            'detalle_programacion_id' => 'nullable|exists:detalle_programacions,id',
            'licencia' => 'nullable|string|max:20',
            'ruc_transporte' => 'nullable|string|max:11',
            'tipo_mineral' => 'nullable|string|max:50',
            'tipo_operacion' => 'nullable|in:nacional,internacional',
            'conformidad_adelanto' => 'nullable|in:Ok,Pendiente',
            'guia_remision' => 'nullable|string|max:100',
            'guia_transportista' => 'nullable|string|max:50',
            'grupo_cargio' => 'nullable|string|max:100',
        ]);

        // Normalizar fecha
        $validated['fecha_programacion'] = Carbon::parse($validated['fecha_programacion'])
            ->format('Y-m-d H:i:s');

        // Obtener conductor/unidad/proveedor si existe licencia
        if (!empty($validated['licencia'])) {
            $conductor = Conductor::with('unidades.proveedor')
                ->where('licencia', $validated['licencia'])->first();

            if ($conductor) {
                $validated['conductor_id'] = $conductor->id;
                $unidad = $conductor->unidades->first();
                if ($unidad) {
                    $validated['unidad_id'] = $unidad->id;
                    if ($unidad->proveedor) {
                        $validated['proveedor_id'] = $unidad->proveedor->id;
                        $validated['ruc_transporte'] = $unidad->proveedor->ruc_transporte;
                        $validated['razon_social_transporte'] = $unidad->proveedor->razon_social;
                    }
                }
            }
        }

        // Fallback: proveedor por RUC
        if (!empty($validated['ruc_transporte']) && empty($validated['proveedor_id'])) {
            $proveedor = Proveedor::where('ruc_transporte', $validated['ruc_transporte'])->first();
            if ($proveedor) $validated['proveedor_id'] = $proveedor->id;
        }

        // Limpiar campos no pertenecientes a programacions
        $remove = ['licencia', 'ruc_transporte'];
        foreach ($remove as $field) unset($validated[$field]);

        Programacion::create($validated);

        return redirect()->route('programacions.index')->with('success', 'Programación creada correctamente.');
    }

    public function edit(Programacion $programacion)
    {
        $detalles = DetalleProgramacion::where('activo', true)->get();
        $proveedores = Proveedor::with('unidades.conductores')->get();
        return view('programacions.edit', compact('programacion', 'detalles', 'proveedores'));
    }

    public function update(Request $request, Programacion $programacion)
    {
        $validated = $request->validate([
            'fecha_programacion' => 'required|string',
            'detalle_programacion_id' => 'nullable|exists:detalle_programacions,id',
            'licencia' => 'nullable|string|max:20',
            'ruc_transporte' => 'nullable|string|max:11',
            'tipo_mineral' => 'nullable|string|max:50',
            'tipo_operacion' => 'nullable|in:nacional,internacional',
            'conformidad_adelanto' => 'nullable|in:Ok,Pendiente',
            'guia_remision' => 'nullable|string|max:100',
            'guia_transportista' => 'nullable|string|max:50',
            'grupo_cargio' => 'nullable|string|max:100',
        ]);

        $validated['fecha_programacion'] = Carbon::parse($validated['fecha_programacion'])
            ->format('Y-m-d H:i:s');

        // Obtener proveedor y unidad si licencia o RUC
        if (!empty($validated['ruc_transporte'])) {
            $proveedor = Proveedor::with('unidades.conductores')
                ->where('ruc_transporte', $validated['ruc_transporte'])->first();

            if ($proveedor) {
                $validated['proveedor_id'] = $proveedor->id;

                if (!empty($validated['licencia'])) {
                    foreach ($proveedor->unidades as $unidad) {
                        $conductor = $unidad->conductores->firstWhere('licencia', $validated['licencia']);
                        if ($conductor) {
                            $validated['unidad_id'] = $unidad->id;
                            break;
                        }
                    }
                }
            }
        }

        unset($validated['licencia'], $validated['ruc_transporte']);
        $programacion->update($validated);

        return redirect()->route('programacions.index')->with('success', 'Programación actualizada correctamente.');
    }

    public function destroy(Programacion $programacion)
    {
        $programacion->delete();
        return redirect()->route('programacions.index')->with('success', 'Programación eliminada correctamente.');
    }

    // ----------------------
    // Métodos AJAX / JSON
    // ----------------------

    public function searchConductores(Request $request)
    {
        $term = $request->get('term', '');
        $query = Conductor::with('unidad.proveedor')
            ->whereHas('unidad', fn($q) => $q->whereNotNull('proveedor_id'))
            ->when($term, fn($q) => $q->where('licencia', 'like', "%{$term}%")
                ->orWhere('nombres', 'like', "%{$term}%")
                ->orWhere('apellidos', 'like', "%{$term}%")
                ->orWhereRaw("CONCAT(nombres,' ',apellidos) LIKE ?", ["%{$term}%"])
            )->limit(50);

        $data = $query->get()->map(fn($c) => [
            'id' => $c->licencia,
            'text' => trim(($c->licencia ? $c->licencia.' - ' : '').($c->nombres ?? '').' '.($c->apellidos ?? '')),
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
        ]);

        return response()->json(['results' => $data]);
    }

    public function getConductorByLicencia($licencia)
    {
        $conductor = Conductor::with('unidad.proveedor')
            ->where('licencia', $licencia)
            ->whereHas('unidad', fn($q) => $q->whereNotNull('proveedor_id'))
            ->firstOrFail();

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
                'id' => $unidad->id ?? null,
                'placa_tracto' => $unidad->placa_tracto ?? '',
                'placa_carreta' => $unidad->placa_carreta ?? '',
                'marca_vehiculo' => $unidad->marca_vehiculo ?? $unidad->marca ?? '',
                'tipo_plataforma' => $unidad->tipo_plataforma ?? '',
                'constancia_mtc_tracto' => $unidad->constancia_mtc_tracto ?? '',
                'constancia_mtc_carreta' => $unidad->constancia_mtc_carreta ?? '',
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

    public function unidadData($id)
    {
        $unidad = Unidad::with('proveedor')->findOrFail($id);

        return response()->json([
            'placa_tracto' => $unidad->placa_tracto,
            'placa_carreta' => $unidad->placa_carreta,
            'marca_vehiculo' => $unidad->marca_vehiculo,
            'tipo_plataforma' => $unidad->tipo_plataforma,
            'constancia_mtc_tracto' => $unidad->constancia_mtc_tracto,
            'constancia_mtc_carreta' => $unidad->constancia_mtc_carreta,
            'ruc_transporte' => $unidad->proveedor->ruc_transporte ?? '',
            'razon_social_transporte' => $unidad->proveedor->razon_social ?? '',
            'cuenta_banco' => $unidad->proveedor->cuenta_banco ?? '',
            'cci_banco' => $unidad->proveedor->cci_banco ?? '',
            'banco' => $unidad->proveedor->banco ?? '',
        ]);
    }

    
}
