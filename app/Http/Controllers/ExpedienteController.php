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
        $expediente = Expediente::findOrFail($id);
        
        // Cargar datos relacionados manualmente
        $data = [
            'id' => $expediente->id,
            'numero_factura_exped' => $expediente->numero_factura_exped,
            'total' => $expediente->total,
            'detraccion' => $expediente->detraccion,
            'deposito_a_proveer' => $expediente->deposito_a_proveer,
            'fecha_pago' => $expediente->fecha_pago,
            'archivo' => $expediente->archivo,
            'comentarios' => $expediente->comentarios,
            'fecha_carga' => $expediente->fecha_carga,
            // Datos de programación
            'programacion' => $expediente->programacion ? [
                'guia_remision' => $expediente->programacion->guia_remision,
                'placa_tracto' => $expediente->programacion->placa_tracto,
                'placa_carreta' => $expediente->programacion->placa_carreta,
                'razon_social_transporte' => $expediente->programacion->razon_social_transporte,
                'ruc_transporte' => $expediente->programacion->ruc_transporte,
                'guia_transportista' => $expediente->programacion->guia_transportista,
                'detalle_programacion' => $expediente->programacion->detalleProgramacion ? [
                    'frente' => $expediente->programacion->detalleProgramacion->frente,
                    'precio_frente' => $expediente->programacion->detalleProgramacion->precio_frente,
                    'precio_tn' => $expediente->programacion->detalleProgramacion->precio_tn,
                ] : null
            ] : null,
            // Datos de tisur
            'tisur' => $expediente->tisur ? [
                'numero_ticket' => $expediente->tisur->numero_ticket,
                'fecha_hora_ingreso' => $expediente->tisur->fecha_hora_ingreso,
                'peso_neto' => $expediente->tisur->peso_neto,
            ] : null,
        ];

        return response()->json($data);
    }
    

    public function index()
    {
        $programaciones = Programacion::with([
            'seguimiento',
            'detalleProgramacion',
            'expedientes.tisur',
        ])->latest()->paginate(10);

        return view('expediente.index', compact('programaciones'));
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
            'archivo' => 'nullable|file|mimes:pdf,jpg,jpeg,png,doc,docx|max:2048', // hasta 2MB

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
        $expediente->deposito_a_proveer = $request->deposito_a_proveer ?? 0;        
        $expediente->fecha_pago = $request->fecha_pago ?? null;
        $expediente->comentarios = $request->comentarios ?? null;

        // === GUARDAR ARCHIVO ===
        if ($request->hasFile('archivo')) {
            $file = $request->file('archivo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('expedientes', $filename, 'public');
            $expediente->archivo = $path; // se guarda la ruta relativa
        }

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

    public function buscarProgramacion(Request $request)
    {
        $query = $request->get('q');

        $programaciones = Programacion::where('guia_remision', 'like', "%{$query}%")
            ->select('id', 'guia_remision', 'placa_tracto', 'placa_carreta', 'razon_social_transporte', 'ruc_transporte', 'guia_transportista')
            ->limit(10)
            ->get();

        return response()->json($programaciones);
    }

}
