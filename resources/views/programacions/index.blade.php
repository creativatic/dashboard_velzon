@extends('layouts.plantilla')

@section('title', 'Programación')

@section('content')
@include('programacions.create')
@include('programacions.show')
@include('programacions.edit')


<div class="container-fluid">
    <h4 class="mb-3">Gestión de Programaciones</h4>

    {{-- Botón para abrir modal crear programación --}}
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createProgramacionModal">
        <i class="ri-add-circle-line"></i> Nueva Programación
    </button>

    <div class="card">
        <div class="card-body table-responsive">
            <table class="table table-bordered table-hover align-middle text-center">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Fecha Programación</th>
                        <th>Guía Remisión</th>
                        <th>Placa Tracto</th>
                        <th>Marca Vehículo</th>
                        <th>Tipo Plataforma</th>
                        <th>Razón Social Transporte</th>
                        <th>RUC Transporte</th>
                        <th>Nombres Conductor</th>
                        <th>Apellidos Conductor</th>
                        <th>Teléfono</th>
                        <th>Banco</th>
                        <th>Tipo Mineral</th>
                        <th>Frente</th>
                        <th>Conformidad Adelanto</th>
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
                            <td>{{ $programacion->placa_tracto ?? '-' }}</td>
                            <td>{{ $programacion->marca_vehiculo ?? '-' }}</td>
                            <td>{{ $programacion->tipo_plataforma ?? '-' }}</td>
                            <td>{{ $programacion->razon_social_transporte ?? '-' }}</td>
                            <td>{{ $programacion->ruc_transporte ?? '-' }}</td>
                            <td>{{ $programacion->nombres_conductor ?? '-' }}</td>
                            <td>{{ $programacion->apellidos_conductor ?? '-' }}</td>
                            <td>{{ $programacion->telefono_conductor ?? '-' }}</td>
                            <td>{{ $programacion->banco ?? '-' }}</td>
                            <td>{{ $programacion->tipo_mineral ?? '-' }}</td>
                            <td>{{ $programacion->detalleProgramacion?->frente ?? '—' }}</td>
                            <td>
                                @if($programacion->conformidad_adelanto === 'Ok')
                                    <span class="btn btn-success btn-sm w-100">{{ $programacion->conformidad_adelanto }}</span>
                                @elseif($programacion->conformidad_adelanto === 'Pendiente')
                                    <span class="btn btn-danger btn-sm w-100">{{ $programacion->conformidad_adelanto }}</span>
                                @else
                                    <span class="badge bg-secondary">--</span>
                                @endif
                            </td>

                            <td>{{ $programacion->guia_transportista ?? '-' }}</td>
                            <td>
                                {{-- Botón Ver --}}
                                <button type="button"
                                    class="btn btn-sm btn-info"
                                    onclick='openShowProgramacionModal(@json($programacion))'>
                                    <i class="ri-eye-line"></i>
                                </button>
                                {{-- Botón Editar --}}
                                <button type="button" class="btn btn-sm btn-warning"
                                        onclick='openEditProgramacionModal(@json($programacion))'>
                                    <i class="ri-edit-line"></i> Editar
                                </button>

                                {{-- Botón Eliminar --}}
                                <form action="{{ route('programacions.destroy', $programacion) }}" 
                                      method="POST" 
                                      class="d-inline">
                                    @csrf @method('DELETE')
                                    <button onclick="return confirm('¿Eliminar esta programación?')" 
                                            class="btn btn-sm btn-danger">
                                        <i class="ri-delete-bin-line"></i>
                                    </button>
                                </form>

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="26" class="text-muted">No hay registros de programación.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
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
    document.getElementById('show_placa_tracto').textContent = programacion.placa_tracto || '--';
    document.getElementById('show_placa_carreta').textContent = programacion.placa_carreta || '--';
    document.getElementById('show_marca_vehiculo').textContent = programacion.marca_vehiculo || '--';
    document.getElementById('show_tipo_plataforma').textContent = programacion.tipo_plataforma || '--';
    document.getElementById('show_constancia_tracto').textContent = programacion.constancia_mtc_tracto || '--';
    document.getElementById('show_constancia_carreta').textContent = programacion.constancia_mtc_carreta || '--';
    document.getElementById('show_razon_social_transporte').textContent = programacion.razon_social_transporte || '--';
    document.getElementById('show_ruc_transporte').textContent = programacion.ruc_transporte || '--';
    document.getElementById('show_nombres_conductor').textContent = programacion.nombres_conductor || '--';
    document.getElementById('show_apellidos_conductor').textContent = programacion.apellidos_conductor || '--';
    document.getElementById('show_telefono_conductor').textContent = programacion.telefono_conductor || '--';
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

    const modal = new bootstrap.Modal(document.getElementById('showProgramacionModal'));
    modal.show();
}
</script>
@endsection
