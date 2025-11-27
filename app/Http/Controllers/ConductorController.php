<?php

namespace App\Http\Controllers;

use App\Models\Conductor;
use App\Models\Unidad;
use App\Models\DetalleProgramacion;
use Illuminate\Http\Request;

class ConductorController extends Controller
{
    public function index()
    {
        // Trae conductores (con paginación) y todas las unidades para el select
        $conductores = Conductor::with('unidad')->paginate(10);
        $unidades = Unidad::orderBy('placa_tracto')->get();

        return view('conductores.index', compact('conductores', 'unidades'));
    }

    public function create()
    {
        $detalles = DetalleProgramacion::all();

        // 🔹 Traemos TODOS los conductores (o los que necesites)
        $conductores = Conductor::select('id', 'nro_licencia', 'nombre')
            ->orderBy('nombre', 'ASC')
            ->get();

        return view('programacions.create', compact('detalles', 'conductores'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'dni' => 'required|string|max:8',
            'licencia' => 'required|string',
            'nombres' => 'required|string',
            'apellidos' => 'required|string',
            'telefono' => 'nullable|string',
            'unidad_id' => 'required|exists:unidades,id',
        ]);

        Conductor::create($request->all());

        return redirect()->route('conductores.index')->with('success', 'Conductor creado correctamente.');
    }

    public function update(Request $request, Conductor $conductor)
    {
        $request->validate([
            'dni' => 'required|string|max:8',
            'licencia' => 'required|string',
            'nombres' => 'required|string',
            'apellidos' => 'required|string',
            'telefono' => 'nullable|string',
            'unidad_id' => 'required|exists:unidades,id',
        ]);

        $conductor->update($request->all());

        return redirect()->route('conductores.index')->with('success', 'Conductor actualizado correctamente.');
    }

    public function destroy(Conductor $conductor)
    {
        $conductor->delete();
        return redirect()->route('conductores.index')->with('success', 'Conductor eliminado correctamente.');
    }

    public function search(Request $request)
    {
        $term = $request->term;

        $conductores = Conductor::with('unidad', 'proveedor')
            ->where('licencia', 'LIKE', '%' . $term . '%')
            ->orWhere('nombres', 'LIKE', '%' . $term . '%')
            ->orWhere('apellidos', 'LIKE', '%' . $term . '%')
            ->limit(20)
            ->get();

        $results = [];

        foreach ($conductores as $c) {
            $results[] = [
                'id' => $c->licencia,
                'text' => $c->licencia . ' — ' . $c->nombres . ' ' . $c->apellidos,
                'dni' => $c->dni,
                'telefono' => $c->telefono,
                'nombres' => $c->nombres,
                'apellidos' => $c->apellidos,
                'unidad' => $c->unidad,
                'proveedor' => $c->proveedor
            ];
        }

        return response()->json(['results' => $results]);
    }

    public function data($id)
    {
        $conductor = Conductor::find($id);

        return response()->json($conductor);
    }

    public function getDataCUP($id)
    {
        $conductor = Conductor::with(['unidad.proveedor'])->findOrFail($id);

        $unidad = $conductor->unidad;
        $proveedor = $unidad ? $unidad->proveedor : null;

        return response()->json([
            // Datos del conductor
            'dni' => $conductor->dni,
            'licencia' => $conductor->licencia,
            'nombres' => $conductor->nombres,
            'apellidos' => $conductor->apellidos,
            'telefono' => $conductor->telefono,

            // Datos del vehículo (unidad)
            'placa_tracto' => $unidad->placa_tracto ?? '',
            'placa_carreta' => $unidad->placa_carreta ?? '',
            'marca_vehiculo' => $unidad->marca_vehiculo ?? '',
            'tipo_plataforma' => $unidad->tipo_plataforma ?? '',
            'constancia_mtc_tracto' => $unidad->constancia_mtc_tracto ?? '',
            'constancia_mtc_carreta' => $unidad->constancia_mtc_carreta ?? '',

            // Datos del proveedor (empresa transporte)
            'ruc_transporte' => $proveedor->ruc_transporte ?? '',
            'razon_social_transporte' => $proveedor->razon_social ?? '',
            'cuenta_banco' => $proveedor->cuenta_banco ?? '',
            'cci_banco' => $proveedor->cci_banco ?? '',
            'banco' => $proveedor->banco ?? '',
        ]);
    }


}
