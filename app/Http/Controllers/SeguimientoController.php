<?php

namespace App\Http\Controllers;

use App\Models\Seguimiento;
use App\Models\Programacion;
use App\Models\Tisur;
use Illuminate\Http\Request;

class SeguimientoController extends Controller
{
    public function index()
    {
        $programaciones = Programacion::with([
            'seguimiento',
            'detalleProgramacion',
            'expedientes.tisur',
            'proveedor.unidades.conductores'   // ← AGREGA ESTO
        ])
        ->latest()
        ->paginate(10);

        return view('seguimientos.index', compact('programaciones'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'programacion_id' => 'required|exists:programacions,id',
        ]);

        $programacion = Programacion::findOrFail($request->programacion_id);

        Seguimiento::create([
            'programacion_id' => $programacion->id,
            'carguio' => $programacion->carguio,
            'material' => $programacion->material,
            'frente' => $programacion->frente,
            'estado' => $programacion->estado,
            'placa' => $programacion->placa,
            'conductor' => $programacion->conductor,
            'telefono' => $programacion->telefono,
            'notas' => $request->notas,
        ]);

        return redirect()->route('seguimientos.index')->with('success', 'Seguimiento creado correctamente.');
    }

    public function update(Request $request, Seguimiento $seguimiento)
    {
        $seguimiento->update([
            'notas' => $request->notas,
        ]);

        return redirect()->route('seguimientos.index')->with('success', 'Seguimiento actualizado correctamente.');
    }

    public function destroy(Seguimiento $seguimiento)
    {
        $seguimiento->delete();
        return redirect()->route('seguimientos.index')->with('success', 'Seguimiento eliminado correctamente.');
    }
}
