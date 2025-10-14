@extends('layouts.plantilla')

@section('title', 'Programación')

@section('content')
@include('programacions.create')
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
                        <th>Licencia</th>
                        <th>DNI</th>
                        <th>Frente</th>
                        <th>Guía Remisión</th>
                        <th>Placa Tracto</th>
                        <th>Placa Carreta</th>
                        <th>Marca Vehículo</th>
                        <th>Tipo Plataforma</th>
                        <th>Const. MTC Tracto</th>
                        <th>Const. MTC Carreta</th>
                        <th>Razón Social Transporte</th>
                        <th>RUC Transporte</th>
                        <th>Nombres Conductor</th>
                        <th>Apellidos Conductor</th>
                        <th>Teléfono</th>
                        <th>Cuenta Banco</th>
                        <th>CCI Banco</th>
                        <th>Banco</th>
                        <th>Tipo Mineral</th>
                        <th>Tipo Operación</th>
                        <th>Conformidad Adelanto</th>
                        <th>Guía Transportista</th>
                        <th>Grupo Carguío</th>
                        <th>Detalle Programación ID</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($programaciones as $programacion)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ \Carbon\Carbon::parse($programacion->fecha_programacion)->format('d/m/Y') }}</td>
                            <td>{{ $programacion->licencia ?? '-' }}</td>
                            <td>{{ $programacion->dni ?? '-' }}</td>
                            <td>{{ $programacion->detalleProgramacion?->frente ?? '—' }}</td>
                            <td>{{ $programacion->guia_remision ?? '-' }}</td>
                            <td>{{ $programacion->placa_tracto ?? '-' }}</td>
                            <td>{{ $programacion->placa_carreta ?? '-' }}</td>
                            <td>{{ $programacion->marca_vehiculo ?? '-' }}</td>
                            <td>{{ $programacion->tipo_plataforma ?? '-' }}</td>
                            <td>{{ $programacion->constancia_mtc_tracto ?? '-' }}</td>
                            <td>{{ $programacion->constancia_mtc_carreta ?? '-' }}</td>
                            <td>{{ $programacion->razon_social_transporte ?? '-' }}</td>
                            <td>{{ $programacion->ruc_transporte ?? '-' }}</td>
                            <td>{{ $programacion->nombres_conductor ?? '-' }}</td>
                            <td>{{ $programacion->apellidos_conductor ?? '-' }}</td>
                            <td>{{ $programacion->telefono_conductor ?? '-' }}</td>
                            <td>{{ $programacion->cuenta_banco ?? '-' }}</td>
                            <td>{{ $programacion->cci_banco ?? '-' }}</td>
                            <td>{{ $programacion->banco ?? '-' }}</td>
                            <td>{{ $programacion->tipo_mineral ?? '-' }}</td>
                            <td>{{ $programacion->tipo_operacion ?? '-' }}</td>
                            <td>{{ $programacion->conformidad_adelanto ?? '-' }}</td>
                            <td>{{ $programacion->guia_transportista ?? '-' }}</td>
                            <td>{{ $programacion->grupo_cargio ?? '-' }}</td>
                            <td>{{ $programacion->detalle_programacion_id ?? '-' }}</td>
                            <td>
                                {{-- Botón Editar --}}
                                <button type="button"
                                    class="btn btn-sm btn-warning"
                                    onclick='openEditProgramacionModal(@json($programacion->toArray()))'>
                                    <i class="ri-edit-line"></i>
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
@endsection
