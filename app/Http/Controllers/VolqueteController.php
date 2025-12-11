<?php

namespace App\Http\Controllers;

use App\Models\Volquete;
use App\Models\Proveedor;
use App\Models\DetalleProgramacion;
use App\Models\Unidad;
use Illuminate\Http\Request;

class VolqueteController extends Controller
{
    public function index()
    {
        $volquetes = Volquete::with(['proveedor'])->paginate(10);
        $proveedores = Proveedor::orderBy('razon_social')->get();
        $frentes = DetalleProgramacion::orderBy('descripcion')->get();
        $unidades = Unidad::orderBy('placa_tracto')->get(); // 🔥 Esto es necesario

        return view('volquetes.index', compact('volquetes', 'proveedores', 'frentes', 'unidades'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'proveedor_id' => 'required|exists:proveedores,id'
        ]);

        Volquete::create($request->all());

        return back()->with('success', 'Volquete registrado correctamente');
    }


    public function update(Request $request, $id)
    {
        $volquete = Volquete::findOrFail($id);

        $request->validate([
            'placa' => 'required|unique:volquetes,placa,' . $volquete->id,
            'proveedor_id' => 'required|exists:proveedores,id'
        ]);

        $volquete->update($request->all());

        return back()->with('success', 'Volquete actualizado correctamente');
    }

    public function destroy($id)
    {
        Volquete::destroy($id);

        return back()->with('success', 'Volquete eliminado');
    }
}
