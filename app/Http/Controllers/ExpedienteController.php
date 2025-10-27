<?php

namespace App\Http\Controllers;

use App\Models\Expediente;
use Illuminate\Http\Request;
use App\Models\Programacion;
use App\Models\Tisur;
use App\Models\DetalleProgramacion;

class ExpedienteController extends Controller
{
    public function show($id)
    {
        try {
            // 🔹 Cargamos el expediente con sus relaciones
            $expediente = Expediente::with(['programacion.detalleProgramacion', 'tisur'])
                ->findOrFail($id);

            return response()->json([
                'id' => $expediente->id,
                'numero_factura_exped' => $expediente->numero_factura_exped,
                'total' => $expediente->total,
                'detraccion' => $expediente->detraccion,
                'deposito_a_proveer' => $expediente->deposito_a_proveer,
                'fecha_pago' => $expediente->fecha_pago,
                'archivo' => $expediente->archivo,
                'comentarios' => $expediente->comentarios,
                'fecha_carga' => $expediente->fecha_carga,

                // 🔹 Programación relacionada
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

                // 🔹 Tisur relacionado
                'tisur' => $expediente->tisur ? [
                    'numero_ticket' => $expediente->tisur->numero_ticket,
                    'fecha_hora_ingreso' => $expediente->tisur->fecha_hora_ingreso,
                    'peso_neto' => $expediente->tisur->peso_neto,
                ] : null,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => 'No se pudo cargar la información del expediente.',
                'detalle' => $e->getMessage(),
            ], 500);
        }
    }

    public function index()
    {
        // 💡 MODIFICACIÓN: Se agrega el filtro para solo mostrar programaciones con conformidad_adelanto = 'Ok'
        $programaciones = Programacion::with([
            'seguimiento',
            'detalleProgramacion',
            'expedientes.tisur',
        ])
        ->where('conformidad_adelanto', 'Ok') // Filtro aplicado
        ->latest()
        ->paginate(10);

        // Lógica para obtener Tisurs disponibles (sin expedientes asociados)
        $tisurIdsAsociados = Expediente::pluck('tisur_id')->filter()->all();
        $tisurs = Tisur::whereNotIn('id', $tisurIdsAsociados)->get();
        
        $detalles = DetalleProgramacion::all(); 

        return view('expediente.index', compact('programaciones', 'tisurs', 'detalles'));
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

    public function edit($id)
    {
        $expediente = Expediente::with([
            'programacion.detalleProgramacion',
            'tisur'
        ])->findOrFail($id);

        // 🔹 Si es una petición AJAX o fetch(), devolvemos JSON
        if (request()->ajax()) {
            return response()->json($expediente);
        }

        $tisurs = Tisur::all();
        $detalles = DetalleProgramacion::all();

        return view('expediente.edit', compact('expediente', 'tisurs', 'detalles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'programacion_id' => 'required|exists:programacions,id',
            'tisur_id' => 'required|exists:tisurs,id',
            'fecha_carga' => 'nullable|date',
            'fecha_pago' => 'nullable|date',
            'total' => 'nullable|numeric|min:0',
            'detraccion' => 'nullable|numeric|min:0',
            'deposito_a_proveer' => 'nullable|numeric|min:0',
            'numero_factura_exped' => 'nullable|string|max:255',
            'comentarios' => 'nullable|string',
            'archivo.*' => 'nullable|file|max:10240',
        ]);

        // 🔹 Crea solo los campos propios del expediente
        $expediente = Expediente::create([
            'programacion_id' => $request->programacion_id,
            'tisur_id' => $request->tisur_id,
            'fecha_carga' => $request->fecha_carga,
            'fecha_pago' => $request->fecha_pago,
            'total' => $request->total,
            'detraccion' => $request->detraccion,
            'deposito_a_proveer' => $request->deposito_a_proveer,
            'numero_factura_exped' => $request->numero_factura_exped,
            'comentarios' => $request->comentarios,
        ]);

        // 🔹 Manejo de archivos (opcional)
        if ($request->hasFile('archivo')) {
            $archivos = [];
            foreach ($request->file('archivo') as $file) {
                $path = $file->store('expedientes', 'public');
                $archivos[] = $path;
            }
            $expediente->archivo = json_encode($archivos);
            $expediente->save();
        }

        return redirect()->route('expediente.index')
            ->with('success', 'Expediente registrado correctamente.');
    }

    public function update(Request $request, Expediente $expediente)
    {
        $validated = $request->validate([
            'fecha_carga' => 'nullable|date',
            'total' => 'nullable|numeric',
            'detraccion' => 'nullable|numeric',
            'deposito_a_proveer' => 'nullable|numeric',
            'fecha_pago' => 'nullable|date',
            'numero_factura_exped' => 'nullable|string|max:255',
            'comentarios' => 'nullable|string',
            // 💡 Cambio: usar archivo.* para validar cada archivo en el array
            'archivo.*' => 'nullable|file|mimes:pdf,jpg,jpeg,png,doc,docx', 
        ]);

        // === Si se sube(n) nuevo(s) archivo(s), reemplazar el campo 'archivo' ===
        // 💡 Cambio: Usar $request->file('archivo') para obtener el array
        if ($request->hasFile('archivo')) {
            // Obtenemos el array de archivos
            $files = $request->file('archivo');

            // Nos centraremos en el PRIMER archivo subido (asumiendo campo 'archivo' singular)
            // Si necesitas manejar todos los archivos, requieres un modelo de Archivos aparte.
            $file = $files[0] ?? null; 

            if ($file) {
                // Eliminar archivo anterior si existe
                if ($expediente->archivo && \Storage::disk('public')->exists($expediente->archivo)) {
                    \Storage::disk('public')->delete($expediente->archivo);
                }

                // Guardar nuevo archivo
                $filename = time() . '_' . $file->getClientOriginalName();
                // 💡 Usamos solo $filename para guardar la ruta correctamente
                $path = $file->storeAs('expedientes', $filename, 'public'); 
                $validated['archivo'] = $path;
            } else {
                // Si el array de archivos estaba presente pero vacío (o no se seleccionó el primero),
                // mantenemos el archivo existente (o lo hacemos nulo si no se incluyó 'archivo' en $validated)
                // Esto ya se maneja de facto ya que el campo 'archivo' no está en $validated si no se sube.
            }
        } else {
            // Mantener archivo existente si no se subió un nuevo array de archivos
            $validated['archivo'] = $expediente->archivo;
        }
        
        // 💡 Limpiamos el 'archivo' de los validated antes de update si no se manejó antes.
        unset($validated['archivo']); 
        
        // Asignar manualmente los campos
        $expediente->fecha_carga = $validated['fecha_carga'] ?? $expediente->fecha_carga;
        $expediente->total = $validated['total'] ?? $expediente->total;
        $expediente->detraccion = $validated['detraccion'] ?? $expediente->detraccion;
        $expediente->deposito_a_proveer = $validated['deposito_a_proveer'] ?? $expediente->deposito_a_proveer;
        $expediente->fecha_pago = $validated['fecha_pago'] ?? $expediente->fecha_pago;
        $expediente->numero_factura_exped = $validated['numero_factura_exped'] ?? $expediente->numero_factura_exped;
        $expediente->comentarios = $validated['comentarios'] ?? $expediente->comentarios;
        
        // Guardar la ruta del archivo si se actualizó
        if (isset($path)) {
            $expediente->archivo = $path;
        }

        $expediente->save();
        
        return redirect()
            ->route('expediente.index')
            ->with('success', 'Expediente actualizado correctamente.');
    }

    public function destroy(Expediente $expediente)
    {
        $expediente->delete();
        return redirect()->route('expediente.index')->with('success', 'Registro eliminado correctamente.');
    }

    public function getProgramacion($id)
    {
        $programacion = Programacion::with('detalleProgramacion')->findOrFail($id);

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

            // 👇 Se recomienda usar el nombre exacto de la relación si quieres devolverla completa:
            'detalle_programacion' => $programacion->detalleProgramacion,
            
            // Opcional: Para simplificar la lectura en JS, puedes extraer los campos del detalle aquí:
            'frente' => $programacion->detalleProgramacion->frente ?? null,
            'precio_frente' => $programacion->detalleProgramacion->precio_frente ?? null,
            'precio_tn' => $programacion->detalleProgramacion->precio_tn ?? null,
        ]);
    }

    public function getTisur($id)
    {
        // Busca el ticket Tisur
        $tisur = Tisur::findOrFail($id);
        
        // Devolvemos solo los datos del Tisur
        return response()->json([
            'numero_ticket' => $tisur->numero_ticket ?? null,
            'fecha_hora_ingreso' => $tisur->fecha_hora_ingreso ?? null,
            'peso_neto' => $tisur->peso_neto ?? null,
        ]);
    }

    public function getDetalle($id)
    {
        $detalle = DetalleProgramacion::findOrFail($id);
        return response()->json($detalle);
    }

    public function getPrecioTn(Request $request)
    {
        $programacionId = $request->get('programacion_id');
        $frente = $request->get('frente');

        if (!$programacionId || !$frente) {
            return response()->json(['precio_tn' => null]);
        }

        // Buscamos el detalle de programación que coincida con el Frente
        // y que esté asociado a la Programación (Programacion.detalle_programacion_id)
        $programacion = Programacion::with('detalleProgramacion')->find($programacionId);

        $precio_tn = null;

        if ($programacion && $programacion->detalleProgramacion) {
            $detalle = $programacion->detalleProgramacion;
            
            // Asumiendo que Programacion.detalle_programacion_id apunta al DetalleProgramacion correcto,
            // Y que ese DetalleProgramacion ya contiene el precio para el Frente correcto (como en la lógica original)
            // Opcional: Podrías añadir una validación extra aquí si el modelo DetalleProgramacion también tiene el campo 'frente'
            if ($detalle->frente == $frente) {
                $precio_tn = $detalle->precio_tn;
            }
        }
        
        return response()->json([
            'precio_tn' => $precio_tn,
        ]);
    }

    public function buscarProgramacion(Request $request)
    {
        $query = $request->get('q');

        $programaciones = Programacion::where('guia_remision', 'like', "%{$query}%")
            ->select('id', 'guia_remision', 'placa_tracto', 'placa_carreta', 'razon_social_transporte', 'ruc_transporte', 'guia_transportista')
            ->limit(10)
            ->get();

        return response()->json($programaciones);
    }

    public function getExpedienteData($id)
    {
        $expediente = Expediente::with(['programacion.detalleProgramacion', 'tisur'])->findOrFail($id);
        return response()->json($expediente);
    }

    
}
