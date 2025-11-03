<?php

namespace App\Http\Controllers;

use App\Models\Epp;
use Illuminate\Http\Request;

class EppController extends Controller
{
    public function index()
    {
        $epps = Epp::orderBy('nombre')->paginate(10);
        return view('epps.index', compact('epps'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'codigo' => 'required|string|max:50|unique:epps,codigo',
            'talla' => 'nullable|string|max:50',
            'categoria' => 'nullable|string|max:100',
            'stock' => 'required|integer|min:0',
            'unidades_medidas' => 'nullable|string|max:20',
            'descripcion' => 'nullable|string',
            'estado' => 'required|boolean',
        ]);

        Epp::create($request->all());
        return redirect()->route('epps.index')->with('success', 'EPP agregado correctamente.');
    }


    public function update(Request $request, Epp $epp)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'codigo' => 'required|string|max:50|unique:epps,codigo,' . $epp->id,
            'talla' => 'nullable|string|max:50',
            'categoria' => 'nullable|string|max:100',
            'stock' => 'required|integer|min:0',
            'unidades_medidas' => 'nullable|string|max:20',
            'descripcion' => 'nullable|string',
            'estado' => 'required|boolean',
        ]);

        $epp->update($request->all());
        return redirect()->route('epps.index')->with('success', 'EPP actualizado correctamente.');
    }

    public function destroy(Epp $epp)
    {
        $epp->delete();
        return redirect()->route('epps.index')->with('success', 'EPP eliminado correctamente.');
    }

    public function buscar($term)
    {
        return response()->json(
            Epp::where('nombre', 'LIKE', "%{$term}%")
                ->select('id', 'nombre', 'stock', 'unidades_medidas')
                ->limit(10)
                ->get()
        );
    }



}
