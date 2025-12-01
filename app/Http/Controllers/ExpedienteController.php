<?php

namespace App\Http\Controllers;

use App\Models\Expediente;
use App\Models\Programacion;
use App\Models\Tisur;
use App\Models\DetalleProgramacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ExpedienteController extends Controller
{
    /**
     * Mostrar la lista de expedientes y programaciones filtradas.
     */
    public function index()
    {
       $programaciones = Programacion::with([
            'seguimiento',
            'detalleProgramacion',
            'expedientes.tisur',
            'proveedor.unidades.conductores'
        ])
            ->where('conformidad_adelanto', 'Ok')
            ->latest()
            ->paginate(10);

        $tisurIdsAsociados = Expediente::pluck('tisur_id')->filter()->all();
        $tisurs = Tisur::whereNotIn('id', $tisurIdsAsociados)->get();
        $detalles = DetalleProgramacion::all();

        return view('expediente.index', compact('programaciones', 'tisurs', 'detalles'));
    }

    /**
     * Formulario para crear expediente.
     */
    public function create()
    {
        $programacions = Programacion::with('detalleProgramacion:id,frente,precio_frente,precio_tn')
            ->select('id', 'guia_remision', 'detalle_programacion_id')
            ->get();

        $tisurs = Tisur::select('id', 'numero_ticket', 'fecha_hora_ingreso', 'primer_peso', 'segundo_peso', 'peso_neto')->get();

        return view('expediente.create', compact('programacions', 'tisurs'));
    }

    /**
     * Formulario para editar expediente.
     */
    public function edit($id)
    {
        $expediente = Expediente::with(['programacion.detalleProgramacion', 'tisur'])->findOrFail($id);

        if (request()->ajax()) {
            return response()->json($expediente);
        }

        $tisurs = Tisur::all();
        $detalles = DetalleProgramacion::all();

        return view('expediente.edit', compact('expediente', 'tisurs', 'detalles'));
    }

    /**
     * Guardar un nuevo expediente.
     */
    public function store(Request $request)
    {
        
        $validated = $this->validateExpediente($request);

        $expediente = Expediente::create(
            collect($validated)->except('archivo')->toArray()
        );

        if ($request->hasFile('archivo')) {
            $this->saveArchivo($request->file('archivo'), $expediente);
        }

        return redirect()->route('expediente.index')->with('success', 'Expediente registrado correctamente.');
    }

    /**
     * Actualizar un expediente existente.
     */
    public function update(Request $request, Expediente $expediente)
    {
        $validated = $this->validateExpediente($request, $expediente);

        $expediente->update($validated);

        if ($request->hasFile('archivo')) {
            $this->saveArchivo($request->file('archivo'), $expediente);
        }

        return redirect()->route('expediente.index')->with('success', 'Expediente actualizado correctamente.');
    }

    /**
     * Eliminar un expediente.
     */
    public function destroy(Expediente $expediente)
    {
        if ($expediente->archivo && Storage::disk('public')->exists($expediente->archivo)) {
            Storage::disk('public')->delete($expediente->archivo);
        }

        $expediente->delete();

        return redirect()->route('expediente.index')->with('success', 'Registro eliminado correctamente.');
    }

    /**
     * Mostrar un expediente en JSON.
     */
    public function show($id)
    {
        $expediente = Expediente::with([
            'programacion.detalleProgramacion',
            'programacion.proveedor.unidades.conductores',
            'tisur'
        ])->findOrFail($id);

        $programacion = $expediente->programacion;
        $proveedor    = $programacion?->proveedor;
        $unidad       = $proveedor?->unidades->first();
        $conductor    = $unidad?->conductores->first();
        $tisur        = $expediente->tisur;

        return response()->json([
            // 🔵 Programación
            'guia_remision'     => $programacion?->guia_remision,
            'tipo_mineral'      => $programacion?->tipo_mineral,
            'frente'            => $programacion?->detalleProgramacion?->frente,
            'placa_tracto'      => $unidad?->placa_tracto,
            'placa_carreta'     => $unidad?->placa_carreta,

            // 🔵 Proveedor
            'razon_social'      => $proveedor?->razon_social,
            'ruc_transporte'    => $proveedor?->ruc_transporte,
            'banco'             => $proveedor?->banco,
            'cuenta_banco'      => $proveedor?->cuenta_banco,

            // 🔵 Conductor
            'conductor'         => trim(($conductor?->nombres ?? '') . ' ' . ($conductor?->apellidos ?? '')),
            'telefono'          => $conductor?->telefono,

            // 🔵 Expediente
            'tisur'             => $tisur?->numero_ticket,
            'fecha_carga'       => $tisur?->fecha_carga,
            'fecha_pago'        => $expediente->fecha_pago,
            'total'             => $expediente->total,
            'detraccion'        => $expediente->detraccion,
            'deposito_a_proveer'=> $expediente->deposito_a_proveer,
            'numero_factura_exped' => $expediente->numero_factura_exped,
            'comentarios'       => $expediente->comentarios,

            // 🔵 Archivos
            'archivos'          => $expediente->archivo ?? [],
        ]);
    }


    /**
     * Obtener datos de programación en JSON.
     */
    public function getProgramacion($id)
    {
        $programacion = Programacion::with([
            'detalleProgramacion',
            'proveedor.unidades.conductores'
        ])->findOrFail($id);

        $proveedor = $programacion->proveedor;
        $unidad     = $proveedor?->unidades->first() ?? null;
        $conductor  = $unidad?->conductores->first() ?? null;

        return response()->json([
            'id'                    => $programacion->id,
            'guia_remision'         => $programacion->guia_remision,
            'tipo_mineral'          => $programacion->tipo_mineral,
            'guia_transportista'    => $programacion->guia_transportista,

            // 🔥 DETALLE PROGRAMACIÓN
            'frente'                => $programacion->detalleProgramacion->frente ?? null,
            'precio_tn'             => $programacion->detalleProgramacion->precio_tn ?? null,
            'precio_frente'         => $programacion->detalleProgramacion->precio_frente ?? null,

            // 🔥 PROVEEDOR
            'razon_social_transporte' => $proveedor?->razon_social,
            'ruc_transporte'          => $proveedor?->ruc_transporte,
            'banco'                   => $proveedor?->banco,
            'cuenta_banco'            => $proveedor?->cuenta_banco,

            // 🔥 UNIDAD
            'placa_tracto'          => $unidad?->placa_tracto,
            'placa_carreta'         => $unidad?->placa_carreta,

            // 🔥 CONDUCTOR
            'nombres_conductor'     => $conductor?->nombres,
            'apellidos_conductor'   => $conductor?->apellidos,
            'telefono_conductor'    => $conductor?->telefono,
            'licencia_conductor'    => $conductor?->licencia,
            'dni_conductor'    => $conductor?->dni,
            
        ]);
    }


    /**
     * Obtener datos de Tisur.
     */
    public function getTisur($id)
    {
        $tisur = Tisur::findOrFail($id);

        return response()->json([
            'numero_ticket' => $tisur->numero_ticket,
            'fecha_hora_ingreso' => $tisur->fecha_hora_ingreso,
            'peso_neto' => $tisur->peso_neto,
        ]);
    }

    /**
     * Obtener detalle de programación.
     */
    public function getDetalle($id)
    {
        $detalle = DetalleProgramacion::findOrFail($id);
        return response()->json($detalle);
    }

    /**
     * Obtener precio TN de programación y frente.
     */
    public function getPrecioTn(Request $request)
    {
        $programacionId = $request->get('programacion_id');
        $frente = $request->get('frente');

        if (!$programacionId || !$frente) {
            return response()->json(['precio_tn' => null]);
        }

        $programacion = Programacion::with('detalleProgramacion')->find($programacionId);
        $precio_tn = ($programacion && $programacion->detalleProgramacion && $programacion->detalleProgramacion->frente == $frente)
            ? $programacion->detalleProgramacion->precio_tn
            : null;

        return response()->json(['precio_tn' => $precio_tn]);
    }

    /**
     * Buscar programaciones por guía de remisión.
     */
    public function buscarProgramacion(Request $request)
    {
        $query = $request->get('q');

        $programaciones = Programacion::where('guia_remision', 'like', "%{$query}%")
            ->select('id', 'guia_remision', 'placa_tracto', 'placa_carreta', 'razon_social_transporte', 'ruc_transporte', 'guia_transportista')
            ->limit(10)
            ->get();

        return response()->json($programaciones);
    }

    /**
     * Obtener datos completos de un expediente en JSON.
     */
    public function getExpedienteData($id)
    {
        $expediente = Expediente::with(['programacion.detalleProgramacion', 'tisur'])->findOrFail($id);
        return response()->json($expediente);
    }

    /**
     * Validar datos de expediente.
     */
    private function validateExpediente(Request $request, $expediente = null)
    {
        return $request->validate([
        'programacion_id' => 'required|exists:programacions,id',
        'tisur_id' => 'required|exists:tisurs,id',
        'fecha_carga' => 'nullable|date', // Nota: En el modal usas 'fecha_hora_ingreso' para tisur.
        'fecha_pago' => 'nullable|date',
        'total' => 'nullable|numeric|min:0',
        'detraccion' => 'nullable|numeric|min:0',
        'deposito_a_proveer' => 'nullable|numeric|min:0',
        'numero_factura_exped' => 'nullable|string|max:255',
        'comentarios' => 'nullable|string',
        'archivo.*' => 'nullable|file|mimes:pdf,jpg,jpeg,png,doc,docx|max:10240', // Archivos opcionales, máximo 10MB // ✅ LÍNEA AGREGADA/CORREGIDA para permitir múltiples archivos
        ]);
    }

    /**
     * Guardar archivo(s) asociado(s) a expediente.
     */
    private function saveArchivo($files, Expediente $expediente)
    {
        $archivos = [];

        // Recuperar archivos anteriores si existieran
        if ($expediente->archivo) {
            $archivos = is_array($expediente->archivo)
                ? $expediente->archivo
                : json_decode($expediente->archivo, true);
        }

        foreach ((array)$files as $file) {
            if ($file) {
                $path = $file->store('expedientes', 'public');
                $archivos[] = $path;
            }
        }

        // Guardar como JSON
        $expediente->archivo = $archivos;
        $expediente->save();
    }


    /**
     * Formatear expediente para respuesta JSON.
     */
    private function formatExpediente(Expediente $expediente)
    {
        return [
            'id' => $expediente->id,
            'numero_factura_exped' => $expediente->numero_factura_exped,
            'total' => $expediente->total,
            'detraccion' => $expediente->detraccion,
            'deposito_a_proveer' => $expediente->deposito_a_proveer,
            'fecha_pago' => $expediente->fecha_pago,
            'archivo' => $expediente->archivo,
            'comentarios' => $expediente->comentarios,
            'fecha_carga' => $expediente->fecha_carga,
            'programacion' => $expediente->programacion ? [
                'guia_remision' => $expediente->programacion->guia_remision,
                'placa_tracto' => $expediente->programacion->placa_tracto,
                'tipo_mineral' => $expediente->programacion->tipo_mineral,
                'razon_social_transporte' => $expediente->programacion->razon_social_transporte,
                'ruc_transporte' => $expediente->programacion->ruc_transporte,
                'apellidos_conductor' => $expediente->programacion->apellidos_conductor,
                'telefono_conductor' => $expediente->programacion->telefono_conductor,
                'cuenta_banco' => $expediente->programacion->cuenta_banco,
                'banco' => $expediente->programacion->banco,
                'detalle_programacion' => $expediente->programacion->detalleProgramacion ? [
                    'frente' => $expediente->programacion->detalleProgramacion->frente,
                ] : null
            ] : null,
            'tisur' => $expediente->tisur ? [
                'numero_ticket' => $expediente->tisur->numero_ticket,
                'fecha_hora_ingreso' => $expediente->tisur->fecha_hora_ingreso,
                'peso_neto' => $expediente->tisur->peso_neto,
            ] : null,
        ];
    }
}
