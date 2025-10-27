@extends('layouts.plantilla')

@section('title', 'Expedientes')

@section('content')
@include('expediente.create')
@include('expediente.edit')
@include('expediente.show')

<div class="page-title-box d-sm-flex align-items-center justify-content-between">
    <h4 class="mb-sm-0">Listado de expediente</h4>
    <div class="page-title-right">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="javascript: void(0);">Expediente</a></li>
            <li class="breadcrumb-item active">Listado de expediente</li>
        </ol>
    </div>
</div>

<div class="card mt-3">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Guía Remisión</th>
                        <th>Placa Tracto</th>
                        <th>Tipo Mineral</th>
                        <th>Frente</th>
                        <th>Razón Social Transporte</th>
                        <th>Banco</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($programaciones as $index => $programacion)
                        @php
                            // Obtener el primer expediente relacionado (si existe)
                            $expediente = $programacion->expedientes->first();
                        @endphp

                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $programacion->guia_remision ?? '-' }}</td>
                            <td>{{ $programacion->placa_tracto ?? '-' }}</td>
                            <td>{{ $programacion->tipo_mineral ?? '-' }}</td>
                            <td>{{ $programacion->detalleProgramacion->frente ?? '-' }}</td>
                            <td>{{ $programacion->razon_social_transporte ?? '-' }}</td>
                            <td>{{ $programacion->banco ?? '-' }}</td>
                            <td>
                                {{-- ✅ Ver Expediente --}}
                                    @if($expediente)
                                    <button 
                                        class="btn btn-info btn-sm"
                                        onclick="verExpediente({{ $expediente->id }})"
                                    >
                                        <i class="ri-eye-line"></i> Ver
                                    </button>

                                    {{-- ✅ Evaluamos si el expediente tiene número de ticket (tisur->numero_ticket) --}}
                                    @if(optional($expediente->tisur)->numero_ticket)
                                        {{-- ✅ Si tiene número_ticket → mostrar Editar --}}
                                        <button 
                                            class="btn btn-warning btn-sm"
                                            onclick="editarExpediente({{ $expediente->id }})"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editExpedienteModal"
                                        >
                                            <i class="ri-edit-2-line"></i> Editar
                                        </button>
                                    @else
                                        {{-- ✅ Si NO tiene número_ticket → permitir Crear --}}
                                        <button 
                                            class="btn btn-success btn-sm"
                                            onclick="cargarDatosExpediente({{ $programacion->id }})"
                                            data-bs-toggle="modal"
                                            data-bs-target="#createExpedienteModal"
                                        >
                                            <i class="ri-add-circle-line"></i> Crear
                                        </button>
                                    @endif
                                    @else
                                        {{-- ✅ Si no hay expediente registrado --}}
                                        <button class="btn btn-secondary btn-sm" disabled title="No hay expediente registrado">
                                            <i class="ri-eye-off-line"></i> Sin expediente
                                        </button>

                                        <button 
                                            class="btn btn-success btn-sm"
                                            onclick="cargarDatosExpediente({{ $programacion->id }})"
                                            data-bs-toggle="modal"
                                            data-bs-target="#createExpedienteModal"
                                        >
                                            <i class="ri-add-circle-line"></i> Crear
                                        </button>
                                    @endif
                            </td>


                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted">No se encontraron registros</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Script para visualizar expediente --}}
<script>
    function verExpediente(id) {
        fetch(`/expediente/${id}`)
            .then(response => {
                if (!response.ok) throw new Error("Error al obtener el expediente");
                return response.json();
            })
            .then(data => {
                console.log("📦 Expediente recibido:", data);

                const expediente = data;
                const prog = expediente.programacion ?? {};
                const detalle = prog.detalle_programacion ?? {};
                const tisur = expediente.tisur ?? {};

                // === PROGRAMACIÓN ===
                document.getElementById('show_guia_remision').textContent = prog.guia_remision ?? '-';
                document.getElementById('show_placa_tracto').textContent = prog.placa_tracto ?? '-';
                document.getElementById('show_tipo_mineral').textContent = prog.tipo_mineral ?? '-';
                document.getElementById('show_frente').textContent = detalle.frente ?? '-';
                document.getElementById('show_razon_social').textContent = prog.razon_social_transporte ?? '-';
                document.getElementById('show_ruc').textContent = prog.ruc_transporte ?? '-';
                document.getElementById('show_conductor').textContent = prog.apellidos_conductor ?? '-';
                document.getElementById('show_telefono').textContent = prog.telefono_conductor ?? '-';
                document.getElementById('show_cuenta_banco').textContent = prog.cuenta_banco ?? '-';
                document.getElementById('show_banco').textContent = prog.banco ?? '-';

                // === EXPEDIENTE ===
                document.getElementById('show_tisur').textContent = tisur.numero_ticket ?? '-';
                document.getElementById('show_fecha_carga').textContent = expediente.fecha_carga ?? '-';
                document.getElementById('show_fecha_pago').textContent = expediente.fecha_pago ?? '-';
                document.getElementById('show_total').textContent = expediente.total ?? '-';
                document.getElementById('show_detraccion').textContent = expediente.detraccion ?? '-';
                document.getElementById('show_deposito').textContent = expediente.deposito_a_proveer ?? '-';
                document.getElementById('show_factura').textContent = expediente.numero_factura_exped ?? '-';
                document.getElementById('show_comentarios').textContent = expediente.comentarios ?? '-';

                // === ARCHIVOS ===
                const archivosDiv = document.getElementById('show_archivos');
                archivosDiv.innerHTML = '';

                let archivos = [];
                let archivoData = expediente.archivo;

                if (archivoData) {
                    try {
                        // 1. Intenta parsear como array JSON (archivos subidos por 'store')
                        const parsed = JSON.parse(archivoData);
                        if (Array.isArray(parsed)) {
                            archivos = parsed;
                        } else {
                            // Si el JSON se parsea pero NO es un array (ej: '{"key": "value"}'),
                            // lo tratamos como archivo único. Esto maneja el caso de 'update'
                            // si por alguna razón guardó un string simple sin parsear o falló el try.
                            archivos = [archivoData];
                        }
                    } catch (e) {
                        // 2. Si JSON.parse falla (porque es un string simple, archivo subido por 'update'),
                        // lo trata como una ruta única.
                        archivos = [archivoData];
                    }
                }

                if (archivos.length > 0) {
                    // Filtrar posibles valores nulos o vacíos y construir los enlaces
                    archivos.filter(file => file).forEach(file => {
                        const link = document.createElement('a');
                        link.href = `/storage/${file}`; // ✅ Esto ahora funcionará con rutas simples o rutas de arrays
                        link.target = '_blank';
                        link.textContent = file.split('/').pop();
                        link.classList.add('d-block');
                        archivosDiv.appendChild(link);
                    });
                } else {
                    archivosDiv.textContent = 'Sin archivos adjuntos.';
                }

                // === MOSTRAR MODAL ===
                const modal = new bootstrap.Modal(document.getElementById('showExpedienteModal'));
                modal.show();
            })
            .catch(error => {
                console.error("❌ Error al cargar expediente:", error);
                alert('No se pudo cargar la información del expediente.');
            });
    }

</script>


@endsection
