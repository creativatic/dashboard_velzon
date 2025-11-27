@extends('layouts.plantilla')

@section('title', 'Programación')

@section('content')
@include('programacions.create')
@include('programacions.show')
@include('programacions.edit')

<div class="page-title-box d-sm-flex align-items-center justify-content-between">
    <h4 class="mb-sm-0">Gestión de Programaciones</h4>
    <div class="page-title-right">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="javascript: void(0);">Programación</a></li>
            <li class="breadcrumb-item active">Gestión de Programaciones</li>
        </ol>
    </div>
</div>

<button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createProgramacionModal">
    <i class="ri-add-circle-line"></i> Nueva Programación
</button>

<div class="card mt-3">
        <div class="card-body table-responsive">
            <table class="table table-striped align-middle text-center">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Fecha Programación</th>
                        <th>Guía Remisión</th>

                        <!-- Conductor -->
                        <th>Nombres Conductor</th>
                        <th>Apellidos Conductor</th>
                        <th>Teléfono</th>

                        <!-- Servicio -->
                        <th>Tipo Mineral</th>
                        <th>Operación</th>
                        <th>Frente</th>

                        <!-- Adelantos -->
                        <th>Conformidad</th>
                        <th>Monto Adelanto</th>

                        <th>Guía Transportista</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($programaciones as $programacion)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ \Carbon\Carbon::parse($programacion->fecha_programacion)->format('d/m/Y') }}</td>
                            <td>{{ $programacion->guia_remision ?? '-' }}</td>

                            <td>{{ $programacion->nombres_conductor ?? '' }}</td>
                            <td>{{ $programacion->apellidos_conductor ?? '' }}</td>
                            <td>{{ $programacion->telefono_conductor ?? '' }}</td>

                            <td>{{ $programacion->tipo_mineral ?? '-' }}</td>
                            <td>{{ $programacion->tipo_operacion ?? '-' }}</td>
                            <td>{{ $programacion->detalleProgramacion?->frente ?? '—' }}</td>

                            <td>
                                @if($programacion->conformidad_adelanto === 'Ok')
                                    <span class="btn btn-success btn-sm w-100">OK</span>
                                @elseif($programacion->conformidad_adelanto === 'Pendiente')
                                    <span class="btn btn-danger btn-sm w-100">Pendiente</span>
                                @else
                                    <span class="badge bg-secondary">--</span>
                                @endif
                            </td>

                            <td>{{ $programacion->monto_adelanto ? 'S/ '.number_format($programacion->monto_adelanto,2) : '-' }}</td>
                            <td>{{ $programacion->guia_transportista ?? '-' }}</td>

                            <td>
                                {{-- Botones de acciones --}}
                                <button type="button" class="btn btn-info btn-sm"
                                    onclick='openShowProgramacionModal(@json($programacion))'>
                                    <i class="fas fa-eye"></i> Ver
                                </button>

                                <button type="button" class="btn btn-warning btn-sm"
                                    onclick='openEditProgramacionModal(@json($programacion))'>
                                    <i class="ri-edit-2-line"></i>
                                </button>

                                <form action="{{ route('programacions.destroy', $programacion) }}" 
                                    method="POST" style="display:inline-block;">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger btn-sm">
                                        <i class="ri-delete-bin-line"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="20" class="text-muted">No hay registros.</td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>
</div>

{{-- Script para abrir el modal y llenar datos --}}
<script>
function openShowProgramacionModal(programacion) {
    if (!programacion) return;

    document.getElementById('show_fecha_programacion').textContent = programacion.fecha_programacion || '--';
    document.getElementById('show_frente').textContent = programacion.detalle_programacion?.frente || '--';
    document.getElementById('show_licencia').textContent = programacion.licencia || '--';
    document.getElementById('show_dni').textContent = programacion.dni || '--';
    document.getElementById('show_guia_remision').textContent = programacion.guia_remision || '--';
    document.getElementById('show_placa_tracto').textContent = programacion.unidad?.placa_tracto|| '--';
    document.getElementById('show_placa_carreta').textContent = programacion.unidad?.placa_carreta || '--';
    document.getElementById('show_marca_vehiculo').textContent = programacion.unidad?.marca_vehiculo || '--';
    document.getElementById('show_tipo_plataforma').textContent = programacion.unidad?.tipo_plataforma || '--';
    document.getElementById('show_constancia_tracto').textContent = programacion.unidad?.constancia_mtc_tracto || '--';
    document.getElementById('show_constancia_carreta').textContent = programacion.unidad?.constancia_mtc_carreta || '--';
    document.getElementById('show_razon_social_transporte').textContent = programacion.unidad?.proveedor?.razon_social || '--';
    document.getElementById('show_ruc_transporte').textContent = programacion.unidad?.proveedor?.ruc_transporte || '--';
    document.getElementById('show_nombres_conductor').textContent = programacion.unidad?.conductor?.nombres || '--';
    document.getElementById('show_apellidos_conductor').textContent = programacion.apellidos_conductor || '--';
    document.getElementById('show_telefono_conductor').textContent = programacion.unidad?.conductor?.telefono || '--';
    document.getElementById('show_tipo_mineral').textContent = programacion.tipo_mineral || '--';
    document.getElementById('show_tipo_operacion').textContent = programacion.tipo_operacion || '--';
    // Manejar conformidad_adelanto
    const conformidadElement = document.getElementById('show_conformidad_adelanto');

    if (programacion.conformidad_adelanto === 'Ok') {
        conformidadElement.innerHTML = `<span class="btn btn-success btn-sm w-100">${programacion.conformidad_adelanto}</span>`;
    } else if (programacion.conformidad_adelanto === 'Pendiente') {
        conformidadElement.innerHTML = `<span class="btn btn-danger btn-sm w-100">${programacion.conformidad_adelanto}</span>`;
    } else {
        conformidadElement.innerHTML = `<span class="badge bg-secondary">--</span>`;
    }

    document.getElementById('show_guia_transportista').textContent = programacion.guia_transportista || '--';
    document.getElementById('show_grupo_cargio').textContent = programacion.grupo_cargio || '--';
    // 🟩 Campos nuevos: información de adelantos
    document.getElementById('show_monto_adelanto').textContent = programacion.monto_adelanto 
        ? `S/ ${parseFloat(programacion.monto_adelanto).toFixed(2)}` 
        : '--';
    document.getElementById('show_fecha_pago_adelantos').textContent = programacion.fecha_pago_adelantos || '--';
    document.getElementById('show_banco').textContent = programacion.banco || '--';
    document.getElementById('show_glosa_banco').textContent = programacion.glosa_banco || '--';
    document.getElementById('show_notas').textContent = programacion.notas || '--';

    const modal = new bootstrap.Modal(document.getElementById('showProgramacionModal'));
    modal.show();
}
</script>
@endsection
