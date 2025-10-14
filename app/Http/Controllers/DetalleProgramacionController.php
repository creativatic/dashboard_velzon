<?php

namespace App\Http\Controllers;

use App\Models\DetalleProgramacion;
use App\Models\Programacion;
use Illuminate\Http\Request;

class DetalleProgramacionController extends Controller
{
    /**
     * Mostrar lista de frentes (detalles)
     */
    public function index()
    {
        $detalles = DetalleProgramacion::with('programaciones')
            ->latest()
            ->paginate(10);

        return view('detalleprogramacion.index', compact('detalles'));
    }

    /**
     * Guardar un nuevo frente (detalle)
     */
    public function store(Request $request)
    {
        $request->validate([
            'frente' => 'required|string|max:255',
            'precio_frente' => 'required|numeric|min:0',
            'precio_tn' => 'required|numeric|min:0',
            'descripcion' => 'nullable|string'
        ]);

        DetalleProgramacion::create([
            'frente' => $request->frente,
            'precio_frente' => $request->precio_frente,
            'precio_tn' => $request->precio_tn,
            'descripcion' => $request->descripcion,
            'activo' => true,
        ]);

        return redirect()->route('detalleprogramacion.index')
            ->with('success', 'Frente creado correctamente.');
    }

    /**
     * Actualizar los datos del frente
     */
    public function update(Request $request, DetalleProgramacion $detalleprogramacion)
    {
        $request->validate([
            'frente' => 'required|string|max:255',
            'precio_frente' => 'required|numeric|min:0',
            'precio_tn' => 'required|numeric|min:0',
            'descripcion' => 'nullable|string',
        ]);

        // Si el checkbox está marcado, usa valor 1, sino 0
        $activo = $request->input('activo', 0);

        $detalleprogramacion->update([
            'frente' => $request->frente,
            'precio_frente' => $request->precio_frente,
            'precio_tn' => $request->precio_tn,
            'descripcion' => $request->descripcion,
            'activo' => $activo,
        ]);

        return redirect()->route('detalleprogramacion.index')
            ->with('success', 'Frente actualizado correctamente.');
    }

    /**
     * Eliminar un frente (detalle)
     */
    public function destroy(DetalleProgramacion $detalleprogramacion)
    {
        // Antes de eliminar, verificar si tiene programaciones asociadas
        if ($detalleprogramacion->programaciones()->count() > 0) {
            return redirect()->route('detalleprogramacion.index')
                ->with('error', 'No se puede eliminar el frente porque tiene programaciones asociadas.');
        }

        $detalleprogramacion->delete();

        return redirect()->route('detalleprogramacion.index')
            ->with('success', 'Frente eliminado correctamente.');
    }
}