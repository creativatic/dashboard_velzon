<?php

namespace App\Http\Controllers;

use App\Models\Programacion;
use Illuminate\Http\Request;

class ProgramacionController extends Controller
{
    /**
     * Muestra el listado de programaciones.
     */
    public function index()
    {
        $programaciones = Programacion::latest()->get();
        return view('programacions.index', compact('programaciones'));
    }

    /**
     * Guarda una nueva programación desde el modal.
     */
    public function store(Request $request)
    {
        $request->validate([
            'fecha' => 'required|date',
            'guia_remision' => 'nullable|string|max:255',
            'placa_tracto' => 'nullable|string|max:255',
            'placa_carreta' => 'nullable|string|max:255',
            'marca_vehiculo' => 'nullable|string|max:255',
            'tipo_plataforma' => 'nullable|string|max:255',
            'constancia_mtc' => 'nullable|string|max:255',
            'constancia_mtc_carreta' => 'nullable|string|max:255',
            'razon_social_transporte' => 'nullable|string|max:255',
            'ruc_transporte' => 'nullable|string|max:20',
            'conductor' => 'nullable|string|max:255',
            'licencia' => 'nullable|string|max:100',
            'telefono_conductor' => 'nullable|string|max:20',
            'cuenta' => 'nullable|string|max:100',
            'cci' => 'nullable|string|max:30',
            'banco' => 'nullable|string|max:100',
            'tipo_mineral' => 'nullable|string|max:100',
            'numero_guia' => 'nullable|string|max:100',
            'conformidad_adelanto' => 'nullable|string|max:255',
            'guia_transportista' => 'nullable|string|max:255',
            'logistica' => 'nullable|string|max:255',
        ]);

        Programacion::create($request->all());

        return redirect()->route('programacions.index')
            ->with('success', 'Programación registrada correctamente.');
    }

    /**
     * Muestra la información para edición (AJAX o modal).
     */
    public function edit(Programacion $programacion)
    {
        return response()->json($programacion);
    }

    /**
     * Actualiza una programación existente.
     */
    public function update(Request $request, Programacion $programacion)
    {
        $programacion->update($request->only([
            'guia_remision',
            'placa_tracto',
            'placa_carreta',
            'marca_vehiculo',
            'tipo_plataforma',
            'constancia_mtc',
            'constancia_mtc_carreta',
            'razon_social_transporte',
            'ruc_transporte',
            'conductor',
            'licencia',
            'telefono_conductor',
            'cuenta',
            'cci',
            'banco',
            'tipo_mineral',
            'numero_guia',
            'conformidad_adelanto',
            'guia_transportista',
            'logistica',
        ]));

        return redirect()->route('programacions.index')
            ->with('success', 'Programación actualizada correctamente.');
    }



    /**
     * Elimina una programación.
     */
    public function destroy(Programacion $programacion)
    {
        $programacion->delete();

        return redirect()->route('programacions.index')
            ->with('success', 'Programación eliminada correctamente.');
    }
}
