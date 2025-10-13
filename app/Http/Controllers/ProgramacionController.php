<?php

namespace App\Http\Controllers;

use App\Models\Programacion;
use Illuminate\Http\Request;
use App\Models\DetalleProgramacion;


class ProgramacionController extends Controller
{
    /**
     * Muestra el listado de programaciones.
     */
    public function index()
    {
        $programaciones = Programacion::with('detalleProgramacion')->latest()->get();
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
            'fecha_progracion' => 'required|date',
            'dni' => 'nullable|string|max:8',
            'placa_tracto' => 'nullable|string|max:20',
            'placa_carreta' => 'nullable|string|max:20',
            'ruc_transporte' => 'nullable|string|max:11',
            'razon_social_transporte' => 'nullable|string|max:100',
            'nombres_conductor' => 'nullable|string|max:100',
            'apellidos_conductor' => 'nullable|string|max:100',
            'licencia' => 'nullable|string|max:20',
            'tipo_operacion' => 'nullable|in:nacional,internacional',
            'detalle_programacion_id' => 'nullable|exists:detalle_programacions,id',
            
        ]);

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
            'fecha_progracion' => 'required|date',
            'dni' => 'nullable|string|max:8',
            'placa_tracto' => 'nullable|string|max:20',
            'placa_carreta' => 'nullable|string|max:20',
            'ruc_transporte' => 'nullable|string|max:11',
            'razon_social_transporte' => 'nullable|string|max:100',
            'nombres_conductor' => 'nullable|string|max:100',
            'apellidos_conductor' => 'nullable|string|max:100',
            'licencia' => 'nullable|string|max:20',
            'tipo_operacion' => 'nullable|in:nacional,internacional',
            'detalle_programacion_id' => 'nullable|exists:detalle_programacions,id',
        ]);

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
