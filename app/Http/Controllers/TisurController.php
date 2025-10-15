<?php

namespace App\Http\Controllers;

use App\Models\Tisur;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TisurController extends Controller
{
    /**
     * Mostrar listado
     */
    public function index()
    {
        $tisurs = Tisur::with('expedientes')->latest()->paginate(10);
        return view('tisur.index', compact('tisurs'));
    }

    /**
     * Mostrar formulario de creación
     */
    public function create()
    {
        return view('tisur.create');
    }

    /**
     * Guardar nuevo registro
     */
    public function store(Request $request)
    {
        $request->validate([
            'numero_ticket' => 'required|string|max:255',
            'fecha_hora_ingreso' => 'nullable|date',
            'fecha_hora_salida' => 'nullable|date|after_or_equal:fecha_hora_ingreso',
            'placa_tracto' => 'nullable|string|max:255',
            'razon_social' => 'nullable|string|max:255',
            'transportista' => 'nullable|string|max:255',
            'tipo_carga_tisur' => 'nullable|string|max:255',
            'numero_bultos' => ['nullable', 'regex:/^\d+(\.\d{1,5})?$/'],
            'primer_peso' => ['nullable', 'regex:/^\d+(\.\d{1,5})?$/'],
            'segundo_peso' => ['nullable', 'regex:/^\d+(\.\d{1,5})?$/'],
            'peso_neto' => ['nullable', 'regex:/^\d+(\.\d{1,5})?$/'],
            'tipo_plataforma' => 'nullable|string|max:255',
            'documento_origen' => 'nullable|string|max:255',
            'precio_tisur' => ['nullable', 'regex:/^\d+(\.\d{1,5})?$/'],
            'total_tisur' => ['nullable', 'regex:/^\d+(\.\d{1,5})?$/'],
            'retencion_tisur' => ['nullable', 'regex:/^\d+(\.\d{1,5})?$/'],
            'pago_tisur' => ['nullable', 'regex:/^\d+(\.\d{1,5})?$/'],
            'factura_tisur' => 'nullable|string|max:255',
            'estado' => 'nullable|string|max:255',
            'fecha_pago' => 'nullable|date',
            'orden_tisur' => 'nullable|string|max:255',
        ]);

        $data = $request->only([
            'numero_ticket',
            'fecha_hora_ingreso',
            'placa_tracto',
            'fecha_hora_salida',
            'primer_peso',
            'segundo_peso',
            'razon_social',
            'transportista',
            'tipo_carga_tisur',
            'numero_bultos',
            'peso_neto',
            'tipo_plataforma',
            'documento_origen',
            'precio_tisur',
            'total_tisur',
            'retencion_tisur',
            'pago_tisur',
            'factura_tisur',
            'estado',
            'fecha_pago',
            'orden_tisur',
        ]);

        // 🕒 Convertir formatos de fecha/hora
        if ($request->filled('fecha_hora_ingreso')) {
            $data['fecha_hora_ingreso'] = Carbon::createFromFormat('Y-m-d\TH:i', $request->fecha_hora_ingreso)
                ->format('Y-m-d H:i:s');
        }

        if ($request->filled('fecha_hora_salida')) {
            $data['fecha_hora_salida'] = Carbon::createFromFormat('Y-m-d\TH:i', $request->fecha_hora_salida)
                ->format('Y-m-d H:i:s');
        }

        if ($request->filled('fecha_pago')) {
            $data['fecha_pago'] = Carbon::createFromFormat('Y-m-d', $request->fecha_pago)
                ->format('Y-m-d');
        }

        Tisur::create($data);

        return redirect()->route('tisur.index')->with('success', 'Registro TISUR creado correctamente.');
    }

    /**
     * Mostrar formulario de edición
     */
    public function edit(Tisur $tisur)
    {
        return view('tisur.edit', compact('tisur'));
    }

    /**
     * Actualizar registro existente
     */
    public function update(Request $request, Tisur $tisur)
    {
        $data = $request->only([
            'fecha_hora_ingreso',
            'placa_tracto',
            'fecha_hora_salida',
            'primer_peso',
            'segundo_peso',
            'razon_social',
            'transportista',
            'tipo_carga_tisur',
            'numero_bultos',
            'peso_neto',
            'tipo_plataforma',
            'documento_origen',
            'precio_tisur',
            'total_tisur',
            'retencion_tisur',
            'pago_tisur',
            'factura_tisur',
            'estado',
            'fecha_pago',
            'orden_tisur',
        ]);

        if ($request->filled('fecha_hora_ingreso')) {
            $data['fecha_hora_ingreso'] = Carbon::createFromFormat('Y-m-d\TH:i', $request->fecha_hora_ingreso)
                ->format('Y-m-d H:i:s');
        }

        if ($request->filled('fecha_hora_salida')) {
            $data['fecha_hora_salida'] = Carbon::createFromFormat('Y-m-d\TH:i', $request->fecha_hora_salida)
                ->format('Y-m-d H:i:s');
        }

        if ($request->filled('fecha_pago')) {
            $data['fecha_pago'] = Carbon::createFromFormat('Y-m-d', $request->fecha_pago)
                ->format('Y-m-d');
        }

        $tisur->update($data);

        return redirect()->route('tisur.index')->with('success', 'Registro actualizado correctamente.');
    }

    /**
     * Eliminar registro
     */
    public function destroy(Tisur $tisur)
    {
        $tisur->delete();
        return redirect()->route('tisur.index')->with('success', 'Registro eliminado correctamente.');
    }
}
