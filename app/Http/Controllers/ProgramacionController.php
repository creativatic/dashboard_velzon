<?php

namespace App\Http\Controllers;

use App\Models\Programacion;
use Illuminate\Http\Request;
use App\Models\DetalleProgramacion;
use Carbon\Carbon;

class ProgramacionController extends Controller
{
    /**
     * Muestra el listado de programaciones.
     */
    public function index()
    {
        $programaciones = Programacion::with('detalleProgramacion')->latest()->orderBy('fecha_programacion', 'desc')->get();
        $detalles = DetalleProgramacion::where('activo', true)->get();

        return view('programacions.index', compact('programaciones', 'detalles'));
    }
    /**
     * Guarda una nueva programación desde el modal.
     */

     public function create()
    {
        $detalles = DetalleProgramacion::where('activo', true)->get();
        return view('programacions.create', compact('detalles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'fecha_programacion' => 'required|string',
            'dni' => 'nullable|string|max:8',
            'guia_remision' => 'nullable|string|max:100',
            'placa_tracto' => 'nullable|string|max:20',
            'placa_carreta' => 'nullable|string|max:20',
            'marca_vehiculo' => 'nullable|string|max:50',
            'tipo_plataforma' => 'nullable|string|max:50',
            'constancia_mtc_tracto' => 'nullable|string|max:100',
            'constancia_mtc_carreta' => 'nullable|string|max:100',
            'razon_social_transporte' => 'nullable|string|max:100',
            'ruc_transporte' => 'nullable|string|max:11',
            'nombres_conductor' => 'nullable|string|max:100',
            'apellidos_conductor' => 'nullable|string|max:100',
            'licencia' => 'nullable|string|max:20',
            'telefono_conductor' => 'nullable|string|max:20',
            'cuenta_banco' => 'nullable|string|max:50',
            'cci_banco' => 'nullable|string|max:50',
            'banco' => 'nullable|string|max:50',
            'tipo_mineral' => 'nullable|string|max:50',
            'tipo_operacion' => 'nullable|in:nacional,internacional',
            'conformidad_adelanto' => 'nullable|in:Ok,Pendiente',
            'guia_transportista' => 'nullable|string|max:50',
            'grupo_cargio' => 'nullable|string|max:100',
            'detalle_programacion_id' => 'nullable|exists:detalle_programacions,id',
            // Campos agregados (adelantos)
            'monto_adelanto' => 'nullable|numeric|min:0',
            'fecha_pago_adelantos' => 'nullable|date',
            'glosa_banco' => 'nullable|string',
            'notas' => 'nullable|string',
    ]);

    try {
            // Convertir correctamente a formato MySQL
            $fecha = Carbon::parse($request->fecha_programacion)->format('Y-m-d H:i:s');
            $validated['fecha_programacion'] = $fecha;
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['fecha_programacion' => 'Formato de fecha inválido']);
        }

        Programacion::create($validated);
        return redirect()->route('programacions.index')->with('success', 'Programación creada correctamente.');
    }

    /**
     * Muestra la información para edición (AJAX o modal).
     */
    public function edit(Programacion $programacion)
    {
        $detalles = DetalleProgramacion::where('activo', true)->get();
        return view('programacions.edit', compact('programacion', 'detalles'));
    }
    /**
     * Actualiza una programación existente.
     */
    public function update(Request $request, Programacion $programacion)
    {
        $validated = $request->validate([
            'fecha_programacion' => 'required|string',
            'dni' => 'nullable|string|max:8',
            'guia_remision' => 'nullable|string|max:100',
            'placa_tracto' => 'nullable|string|max:20',
            'placa_carreta' => 'nullable|string|max:20',
            'marca_vehiculo' => 'nullable|string|max:50',
            'tipo_plataforma' => 'nullable|string|max:50',
            'constancia_mtc_tracto' => 'nullable|string|max:100',
            'constancia_mtc_carreta' => 'nullable|string|max:100',
            'razon_social_transporte' => 'nullable|string|max:100',
            'ruc_transporte' => 'nullable|string|max:11',
            'nombres_conductor' => 'nullable|string|max:100',
            'apellidos_conductor' => 'nullable|string|max:100',
            'licencia' => 'nullable|string|max:20',
            'telefono_conductor' => 'nullable|string|max:20',
            'cuenta_banco' => 'nullable|string|max:50',
            'cci_banco' => 'nullable|string|max:50',
            'banco' => 'nullable|string|max:50',
            'tipo_mineral' => 'nullable|string|max:50',
            'tipo_operacion' => 'nullable|in:nacional,internacional',
            'conformidad_adelanto' => 'nullable|in:Ok,Pendiente',
            'guia_transportista' => 'nullable|string|max:50',
            'grupo_cargio' => 'nullable|string|max:100',
            'detalle_programacion_id' => 'nullable|exists:detalle_programacions,id',
        ]);

        // Normalizar fecha como en store (acepta datetime-local o strings)
        try {
            $validated['fecha_programacion'] = Carbon::parse($request->fecha_programacion)->format('Y-m-d H:i:s');
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['fecha_programacion' => 'Formato de fecha inválido']);
        }

        // Actualizar con todos los campos validados
        $programacion->update($validated);

        return redirect()->route('programacions.index')->with('success', 'Programación actualizada correctamente.');
    }


    /**
     * Elimina una programación.
     */
    public function destroy(Programacion $programacion)
    {
        $programacion->delete();

        return redirect()->route('programacions.index')->with('success', 'Programación eliminada correctamente.');
    }

}
