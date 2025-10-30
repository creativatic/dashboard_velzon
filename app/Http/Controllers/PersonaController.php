<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use Illuminate\Http\Request;

class PersonaController extends Controller
{
    public function index()
    {
        $personas = Persona::orderBy('id', 'desc')->paginate(10);
        return view('personas.index', compact('personas'));
    }

    public function create()
    {
        return view('personas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombres' => 'required',
            'dni' => 'required|unique:personas',
        ]);

        Persona::create($request->all());
        return redirect()->route('personas.index')->with('success', 'Persona registrada correctamente.');
    }

    public function edit(Persona $persona)
    {
        return view('personas.edit', compact('persona'));
    }

    public function update(Request $request, Persona $persona)
    {
        $data = $request->all();
        $data['estado'] = $request->boolean('estado'); // 🔒 asegura que guarde 0 o 1 correctamente
        $persona->update($data);

        return redirect()->route('personas.index')->with('success', 'Persona actualizada.');
    }

    public function destroy(Persona $persona)
    {
        $persona->delete();
        return redirect()->route('personas.index')->with('success', 'Persona eliminada.');
    }

    public function buscar($dni)
    {
        $personas = Persona::where('dni', 'like', "%{$dni}%")
            ->orWhere('nombres', 'like', "%{$dni}%")
            ->select('id', 'dni', 'nombres')
            ->limit(5)
            ->get();

        return response()->json($personas);
    }

}
