<?php

namespace App\Http\Controllers;

use App\Models\Epp;
use App\Models\Persona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EntregaEppController extends Controller
{
    public function index()
    {
        $entregas = DB::table('epp_persona')
            ->join('personas', 'epp_persona.persona_id', '=', 'personas.id')
            ->join('epps', 'epp_persona.epp_id', '=', 'epps.id')
            ->select(
                'epp_persona.id',
                'personas.nombres as persona',
                'epps.nombre as epp',
                'epp_persona.fecha_entrega',
                'epp_persona.fecha_devolucion',
                'epp_persona.cantidad',
                'epp_persona.observacion'
            )
            ->orderByDesc('epp_persona.created_at')
            ->get();

        $personas = Persona::orderBy('nombres')->get();
        $epps = Epp::where('estado', 1)->orderBy('nombre')->get();

        return view('entregas.index', compact('entregas', 'personas', 'epps'));
    }

    public function show($id)
    {
        $entrega = DB::table('epp_persona')
            ->join('personas', 'epp_persona.persona_id', '=', 'personas.id')
            ->join('epps', 'epp_persona.epp_id', '=', 'epps.id')
            ->select(
                'epp_persona.id',
                'epp_persona.persona_id',
                'epp_persona.epp_id',
                'personas.nombres as persona',
                'epps.nombre as epp',
                'epp_persona.cantidad',
                'epp_persona.fecha_entrega',
                'epp_persona.fecha_devolucion',
                'epp_persona.observacion'
            )
            ->where('epp_persona.id', $id)
            ->first();

        return response()->json($entrega);
    }

    public function update(Request $request, $id)
    {
        DB::table('epp_persona')->where('id', $id)->update([
            'cantidad' => $request->cantidad,
            'fecha_entrega' => $request->fecha_entrega,
            'fecha_devolucion' => $request->fecha_devolucion,
            'observacion' => $request->observacion,
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Entrega actualizada correctamente.');
    }


    public function store(Request $request)
    {
        $request->validate([
            'persona_id' => 'required|exists:personas,id',
            'epp_id' => 'required|exists:epps,id',
            'cantidad' => 'required|integer|min:1',
            'fecha_entrega' => 'required|date',
            'observacion' => 'nullable|string'
        ]);

        // Registrar entrega
        DB::table('epp_persona')->insert([
            'persona_id' => $request->persona_id,
            'epp_id' => $request->epp_id,
            'fecha_entrega' => $request->fecha_entrega,
            'cantidad' => $request->cantidad,
            'observacion' => $request->observacion,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Actualizar stock
        $epp = Epp::findOrFail($request->epp_id);
        $epp->decrement('stock', $request->cantidad);

        return redirect()->route('entregas.index')->with('success', 'EPP entregado correctamente.');
    }

    public function devolver($id)
    {
        $entrega = DB::table('epp_persona')->where('id', $id)->first();
        if (!$entrega) {
            return back()->with('error', 'Registro no encontrado.');
        }

        DB::table('epp_persona')
            ->where('id', $id)
            ->update(['fecha_devolucion' => now()]);

        // Devolver al stock
        $epp = Epp::find($entrega->epp_id);
        if ($epp) {
            $epp->increment('stock', $entrega->cantidad);
        }

        return redirect()->route('entregas.index')->with('success', 'EPP devuelto correctamente.');
    }
}
