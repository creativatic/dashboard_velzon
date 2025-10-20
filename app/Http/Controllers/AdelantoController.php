<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Adelanto;
use App\Models\Programacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdelantoController extends Controller
{
    /**
     * Mostrar listado general de adelantos
     */
    public function index()
    {
        $adelantos = Adelanto::with('programacion')->latest()->paginate(10);
        return view('adelantos.index', compact('adelantos'));
    }

    /**
     * Mostrar formulario de creación
     */
    public function create()
    {
        $programaciones = Programacion::orderBy('id', 'desc')->get();
        return view('adelantos.create', compact('programaciones'));
    }

    /**
     * Guardar nuevo registro
     */
    public function store(Request $request)
    {
        $request->validate([
            'programacion_id' => 'required|exists:programacions,id',
            'monto_adelanto' => 'required|numeric|min:0',
        ]);

        Adelanto::create([
            ...$request->all(),
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('adelantos.index')->with('success', 'Adelanto registrado correctamente.');
    }

    /**
     * Editar registro
     */
    public function edit(Adelanto $adelanto)
    {
        $programaciones = Programacion::orderBy('id', 'desc')->get();
        return view('adelantos.edit', compact('adelanto', 'programaciones'));
    }

    /**
     * Actualizar registro
     */
    public function update(Request $request, Adelanto $adelanto)
    {
        $request->validate([
            'programacion_id' => 'required|exists:programacions,id',
            'monto_adelanto' => 'required|numeric|min:0',
        ]);

        $adelanto->update([
            ...$request->all(),
            'updated_by' => Auth::id(),
        ]);

        return redirect()->route('adelantos.index')->with('success', 'Adelanto actualizado correctamente.');
    }

    /**
     * Eliminar registro
     */
    public function destroy(Adelanto $adelanto)
    {
        $adelanto->delete();
        return redirect()->route('adelantos.index')->with('success', 'Adelanto eliminado correctamente.');
    }
}
