<?php

namespace App\Http\Controllers;

use App\Models\Tisur;
use Illuminate\Http\Request;

class TisurController extends Controller
{
    public function index()
    {
        $tisurs = Tisur::latest()->paginate(10);
        return view('tisur.index', compact('tisurs'));
    }

    public function create()
    {
        return view('tisur.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'numero_ticket' => 'required|unique:tisurs,numero_ticket',
        ]);

        Tisur::create($request->all());

        return redirect()->route('tisur.index')->with('success', 'Registro creado correctamente.');
    }

    public function edit(Tisur $tisur)
    {
        return view('tisur.edit', compact('tisur'));
    }

    public function update(Request $request, Tisur $tisur)
    {
        $tisur->update($request->all());
        return redirect()->route('tisur.index')->with('success', 'Registro actualizado correctamente.');
    }

    public function destroy(Tisur $tisur)
    {
        $tisur->delete();
        return redirect()->route('tisur.index')->with('success', 'Registro eliminado correctamente.');
    }
}
