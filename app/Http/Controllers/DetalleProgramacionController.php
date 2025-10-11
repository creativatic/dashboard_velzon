<?php

namespace App\Http\Controllers;

use App\Models\DetalleProgramacion;
use App\Models\Programacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DetalleProgramacionController extends Controller
{
    public function index()
    {
        $detalles = DetalleProgramacion::with('programaciones')->latest()->paginate(10);
        $programaciones = Programacion::orderBy('id', 'desc')->get();
        
        return view('detalleprogramacion.index', compact('detalles', 'programaciones'));
    }

    public function create()
    {
        $programaciones = Programacion::orderBy('id', 'desc')->get();
        return view('detalleprogramacion.create', compact('programaciones'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'programacion_id' => 'required|exists:programacions,id',
            'frente' => 'required|string|max:255',
            'precio_frente' => 'required|numeric|min:0',
            'precio_tn' => 'required|numeric|min:0',
            'descripcion' => 'nullable|string'
        ]);

        DetalleProgramacion::create([
            'programacion_id' => $request->programacion_id,
            'frente' => $request->frente,
            'precio_frente' => $request->precio_frente,
            'precio_tn' => $request->precio_tn,
            'descripcion' => $request->descripcion,
            // Sin created_by ni updated_by
        ]);

        return redirect()->route('detalleprogramacion.index')
            ->with('success', 'Frente creado correctamente.');
    }

    public function edit(DetalleProgramacion $detalleprogramacion)
    {
        $programaciones = Programacion::orderBy('id', 'desc')->get();
        return view('detalleprogramacion.edit', compact('detalleprogramacion', 'programaciones'));
    }

    public function update(Request $request, DetalleProgramacion $detalleprogramacion)
    {
        $request->validate([
            'programacion_id' => 'required|exists:programacions,id',
            'frente' => 'required|string|max:255',
            'precio_frente' => 'required|numeric|min:0',
            'precio_tn' => 'required|numeric|min:0',
            'descripcion' => 'nullable|string',
            'activo' => 'sometimes|boolean'
        ]);

        $detalleprogramacion->update([
            'programacion_id' => $request->programacion_id,
            'frente' => $request->frente,
            'precio_frente' => $request->precio_frente,
            'precio_tn' => $request->precio_tn,
            'descripcion' => $request->descripcion,
            'activo' => $request->boolean('activo'),
            // Sin updated_by
        ]);

        return redirect()->route('detalleprogramacion.index')
            ->with('success', 'Frente actualizado correctamente.');
    }

    public function destroy(DetalleProgramacion $detalleprogramacion)
    {
        $detalleprogramacion->delete();
        return redirect()->route('detalleprogramacion.index')
            ->with('success', 'Frente eliminado correctamente.');
    }
}