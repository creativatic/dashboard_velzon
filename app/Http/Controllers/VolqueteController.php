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

        // Validación correcta según los campos del formulario
        $request->validate([
            'fecha' => 'required|date',
            'proveedor_id' => 'required|exists:proveedores,id',
            'detalle_programacion_id' => 'nullable|exists:detalle_programacions,id',
            'factura' => 'nullable|string',
            'conformidad' => 'nullable|string',
            'observaciones' => 'nullable|string',
            'hora_vuelta_1' => 'nullable',
            'hora_vuelta_2' => 'nullable',
            'lampadas_vuelta_1' => 'nullable|numeric',
            'lampadas_vuelta_2' => 'nullable|numeric',
            'peso_vuelta_1' => 'nullable|numeric',
            'peso_vuelta_2' => 'nullable|numeric',
            'pasadas' => 'nullable|numeric',
            'total' => 'nullable|numeric',
            'detraccion' => 'nullable|numeric',
            'retencion' => 'nullable|numeric',
            'deposito_a_proveer' => 'nullable|numeric',
            'deposito_total' => 'nullable|numeric',
            'fecha_pago' => 'nullable|date',
        ]);

        // Guardar los cambios
        $volquete->update($request->all());

        return back()->with('success', 'Volquete actualizado correctamente');
    }

    public function destroy($id)
    {
        Volquete::destroy($id);

        return back()->with('success', 'Volquete eliminado');
    }
}
