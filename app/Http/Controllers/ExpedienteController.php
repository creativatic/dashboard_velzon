<?php

namespace App\Http\Controllers;

use App\Models\Expediente;
use Illuminate\Http\Request;
use App\Models\Programacion;

class ExpedienteController extends Controller
{
    public function index()
    {
        $expedientes = Expediente::with('programacion')->paginate(10);
        $programacions = \App\Models\Programacion::select('id', 'guia_remision')->get();

        return view('expediente.index', compact('expedientes', 'programacions'));
    }

    public function create()
    {
        $programacions = Programacion::select('id', 'guia_remision')->get();
        return view('expediente.create', compact('programacions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'programacion_id' => 'required|exists:programacions,id',
        ]);

        // Buscar la programación seleccionada
        $programacion = \App\Models\Programacion::findOrFail($request->programacion_id);

        // Crear nuevo expediente
        $expediente = new \App\Models\Expediente();
        $expediente->programacion_id = $programacion->id;
        $expediente->numero_ticke_exped = $request->numero_ticket_exped;
        $expediente->numero_factura_exped = $request->numero_factura_exped;

        // Si quieres que se copien los datos de la programación (para visualización rápida)
        $expediente->total = $request->total ?? 0;
        $expediente->detraccion = $request->detraccion ?? 0;
        $expediente->fecha_pago = $request->fecha_pago;
        $expediente->comentarios = $request->comentarios;

        $expediente->save();

        return redirect()
            ->route('expediente.index')
            ->with('success', 'Expediente registrado correctamente.');
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

    public function getProgramacion($id)
    {
        $programacion = Programacion::findOrFail($id);

        return response()->json([
            'placa_tracto' => $programacion->placa_tracto,
            'placa_carreta' => $programacion->placa_carreta,
            'razon_social_transporte' => $programacion->razon_social_transporte,
            'ruc_transporte' => $programacion->ruc_transporte,
            'nombres_conductor' => $programacion->nombres_conductor,
            'apellidos_conductor' => $programacion->apellidos_conductor,
            'licencia' => $programacion->licencia,
            'telefono_conductor' => $programacion->telefono_conductor,
            'cuenta_banco' => $programacion->cuenta_banco,
            'cci_banco' => $programacion->cci_banco,
            'banco' => $programacion->banco,
            'tipo_mineral' => $programacion->tipo_mineral,
            'guia_transportista' => $programacion->guia_transportista,
        ]);
    }


}
