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

        // Agregamos las programaciones disponibles
        $programaciones = Programacion::select('id', 'guia_remision', 'fecha_progracion')->get();

        return view('detalleprogramacion.index', compact('detalles', 'programaciones'));
    }

    public function create()
    {
        // Agregamos las programaciones disponibles
        $programaciones = Programacion::select('id', 'guia_remision', 'fecha_progracion')->get();

        return view('detalleprogramacion.create', compact('programaciones'));
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
     * Editar un frente (detalle)
     */
    public function edit(DetalleProgramacion $detalleprogramacion)
    {
        return view('detalleprogramacion.edit', compact('detalleprogramacion'));
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
            'activo' => 'sometimes|boolean'
        ]);

        $detalleprogramacion->update([
            'frente' => $request->frente,
            'precio_frente' => $request->precio_frente,
            'precio_tn' => $request->precio_tn,
            'descripcion' => $request->descripcion,
            'activo' => $request->boolean('activo'),
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
