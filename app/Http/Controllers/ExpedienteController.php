<?php

namespace App\Http\Controllers;

use App\Models\Expediente;
use Illuminate\Http\Request;
use App\Models\Programacion;
use App\Models\Tisur;
use App\Models\DetalleProgramacion;

class ExpedienteController extends Controller
{
    public function index()
    {
        $expedientes = Expediente::with([
            'programacion:id,guia_remision,razon_social_transporte,ruc_transporte,placa_tracto,placa_carreta,guia_transportista',
            'tisur:id,numero_ticket'
        ])->paginate(10);
        $programacions = \App\Models\Programacion::select('id', 'guia_remision')->get();
        $tisurs = \App\Models\Tisur::select('id', 'numero_ticket')->get();
        $detalles = \App\Models\DetalleProgramacion::select('id', 'frente')->get();

        return view('expediente.index', compact('expedientes', 'programacions', 'tisurs', 'detalles'));
    }

    public function create()
    {
        // Cargar datos necesarios para los selects
        $programacions = Programacion::with('detalleProgramacion:id,frente,precio_frente,precio_tn')
            ->select('id', 'guia_remision', 'detalle_programacion_id')
            ->get();

        $tisurs = Tisur::select('id', 'numero_ticket', 'fecha_hora_ingreso', 'primer_peso', 'segundo_peso', 'peso_neto')->get();

        return view('expediente.create', compact('programacions', 'tisurs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'programacion_id' => 'required|exists:programacions,id',
            'tisur_id' => 'required|exists:tisurs,id',
            'detalle_programacion_id' => 'required|exists:detalle_programacions,id',
        ]);

        // Buscar los modelos asociados
        $programacion = Programacion::findOrFail($request->programacion_id);
        $tisur = Tisur::findOrFail($request->tisur_id);
        $detalle = DetalleProgramacion::findOrFail($request->detalle_programacion_id);

        // === Crear el expediente ===
        $expediente = new Expediente();
        $expediente->programacion_id = $programacion->id;
        $expediente->tisur_id = $tisur->id;

        $expediente->fecha_carga = $tisur->fecha_hora_ingreso ?? null;
        $expediente->numero_factura_exped = $request->numero_factura_exped;
        $expediente->total = $request->total ?? 0;
        $expediente->detraccion = $request->detraccion ?? 0;
        $expediente->fecha_pago = $request->fecha_pago ?? null;
        $expediente->comentarios = $request->comentarios ?? null;

        $expediente->save();

        // === Actualizar datos del Tisur relacionado ===
        $tisur->update([
            'primer_peso' => $tisur->primer_peso ?? $request->primer_peso,
            'segundo_peso' => $tisur->segundo_peso ?? $request->segundo_peso,
            'peso_neto' => $tisur->peso_neto ?? $request->peso_neto,
            'factura_tisur' => $request->numero_factura_exped ?? $tisur->factura_tisur,
            'fecha_pago' => $request->fecha_pago ?? $tisur->fecha_pago,
            'estado' => 'Procesado', // ejemplo de cambio de estado
        ]);

        return redirect()
            ->route('expediente.index')
            ->with('success', 'Expediente registrado y datos de Tisur actualizados correctamente.');
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

    public function getTisur($id)
    {
        $tisur = Tisur::findOrFail($id);
        return response()->json($tisur);
    }

    public function getDetalle($id)
    {
        $detalle = DetalleProgramacion::findOrFail($id);
        return response()->json($detalle);
    }


}
