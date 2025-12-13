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
                            <td>{{ $programacion->proveedor?->unidades?->first()?->placa_tracto ?? '-' }}</td>
                            <td>{{ $programacion->tipo_mineral ?? '-' }}</td>
                            <td>{{ $programacion->detalleProgramacion->frente ?? '-' }}</td>
                            <td>{{ $programacion->proveedor->razon_social ?? '-' }}</td>
                            <td>{{ $programacion->proveedor->banco ?? '-' }}</td>
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

            // --- DATOS DE PROGRAMACIÓN ---
            document.getElementById('show_guia_remision').textContent = data.guia_remision ?? '-';
            document.getElementById('show_placa_tracto').textContent  = data.placa_tracto ?? '-';
            document.getElementById('show_tipo_mineral').textContent  = data.tipo_mineral ?? '-';
            document.getElementById('show_frente').textContent        = data.frente ?? '-';

            // --- PROVEEDOR ---
            document.getElementById('show_razon_social').textContent  = data.razon_social ?? '-';
            document.getElementById('show_ruc').textContent           = data.ruc_transporte ?? '-';
            document.getElementById('show_banco').textContent         = data.banco ?? '-';
            document.getElementById('show_cuenta_banco').textContent  = data.cuenta_banco ?? '-';

            // --- CONDUCTOR ---
            document.getElementById('show_conductor').textContent = data.conductor ?? '-';
            document.getElementById('show_telefono').textContent  = data.telefono ?? '-';

            // --- EXPEDIENTE ---
            document.getElementById('show_tisur').textContent    = data.tisur ?? '-';
            document.getElementById('show_fecha_carga').textContent = data.fecha_carga ?? '-';
            document.getElementById('show_fecha_pago').textContent  = data.fecha_pago ?? '-';
            document.getElementById('show_total').textContent       = data.total ?? '-';
            document.getElementById('show_detraccion').textContent  = data.detraccion ?? '-';
            document.getElementById('show_deposito').textContent    = data.deposito_a_proveer ?? '-';
            document.getElementById('show_factura').textContent     = data.numero_factura_exped ?? '-';
            document.getElementById('show_comentarios').textContent = data.comentarios ?? '-';

            // --- ARCHIVOS ---
            // --- ARCHIVOS ---
            const archivosDiv = document.getElementById('show_archivos');
            archivosDiv.innerHTML = '';

            let archivos = [];

            // Si viene JSON encodeado como texto ["expedientes/xxx.pdf"]
            if (typeof data.archivos === 'string') {
                try {
                    const parsed = JSON.parse(data.archivos);
                    if (Array.isArray(parsed)) archivos = parsed;
                } catch (e) {
                    if (data.archivos.trim() !== "") archivos = [data.archivos];
                }
            }

            // Si ya viene como array
            if (Array.isArray(data.archivos)) {
                archivos = data.archivos;
            }

            if (archivos.length > 0) {
                archivos.forEach(file => {
                    // limpiar comillas si Laravel envía ["archivo.pdf"]
                    file = file.replace(/[\[\]\"]/g, "");

                    const url = `/storage/${file}`;

                    archivosDiv.innerHTML += `
                        <a href="${url}" target="_blank"
                            class="btn btn-outline-primary btn-sm d-block mb-2">
                            📄 Ver Factura
                        </a>
                    `;
                });
            } else {
                archivosDiv.innerHTML = `<span class="text-muted">Sin archivos adjuntos.</span>`;
            }


            // MOSTRAR MODAL
            const modal = new bootstrap.Modal(document.getElementById('showExpedienteModal'));
            modal.show();
        })
        .catch(error => {
            console.error(error);
            alert("No se pudo cargar el expediente.");
        });
}
</script>



@endsection
