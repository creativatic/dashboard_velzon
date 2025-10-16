<?php

namespace App\Http\Controllers;

use App\Models\Expediente;
use Illuminate\Http\Request;

class ExpedienteController extends Controller
{
    public function index()
    {
        $expedientes = Expediente::latest()->paginate(10);
        return view('expediente.index', compact('expedientes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'numero_ticket_exped' => 'required',
            'razon_social_empresa' => 'required',
        ]);

        Expediente::create($request->all());
        return redirect()->route('expediente.index')->with('success', 'Registro creado correctamente.');
    }

    public function update(Request $request, Expediente $expediente)
    {
        $expediente->update($request->all());
        return redirect()->route('expediente.index')->with('success', 'Registro actualizado correctamente.');
    }

    public function destroy(Expediente $expediente)
    {
        $expediente->delete();
        return redirect()->route('expediente.index')->with('success', 'Registro eliminado correctamente.');
    }
}
