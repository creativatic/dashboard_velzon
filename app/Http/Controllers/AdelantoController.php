<?php

namespace App\Http\Controllers;

use App\Models\Programacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdelantoController extends Controller
{
    /**
     * Mostrar listado general de adelantos (basado en Programacion)
     */
    public function index()
    {
        $programaciones = Programacion::with([
            'detalleProgramacion',
            'expedientes',     // ← correcto, así lo tienes en el modelo
            'proveedor.unidades.conductores'
        ])
        ->whereNotNull('monto_adelanto')
        ->latest()
        ->paginate(10);

        return view('adelantos.index', compact('programaciones'));
    }

    /**
     * Mostrar formulario de edición de adelanto
     */
    public function edit($id)
    {
        $programacion = Programacion::findOrFail($id);
        return view('adelantos.edit', compact('programacion'));
    }

    /**
     * Actualizar fecha de pago y notas del adelanto
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'fecha_pago_adelantos' => 'nullable|date',
            'notas' => 'nullable|string|max:2000',
        ]);

        $programacion = Programacion::findOrFail($id);

        $programacion->update([
            'fecha_pago_adelantos' => $request->fecha_pago_adelantos,
            'notas' => $request->notas,
            'updated_by' => Auth::id(),
        ]);

        return redirect()->route('adelantos.index')
            ->with('success', 'Datos de adelanto actualizados correctamente.');
    }
}
