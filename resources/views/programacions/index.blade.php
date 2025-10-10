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
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light text-center">
                    <tr>
                        <th>#</th>
                        <th>Fecha</th>
                        <th>Guía Remisión</th>
                        <th>Placa Tracto</th>
                        <th>Placa Carreta</th>
                        <th>Marca</th>
                        <th>Tipo Plataforma</th>
                        <th>Const. MTC</th>
                        <th>Const. MTC Carreta</th>
                        <th>Razón Social Transporte</th>
                        <th>RUC Transporte</th>
                        <th>Conductor</th>
                        <th>Licencia</th>
                        <th>Teléfono</th>
                        <th>Cuenta</th>
                        <th>CCI</th>
                        <th>Banco</th>
                        <th>Tipo Mineral</th>
                        <th>N° Guía</th>
                        <th>Conformidad Adelanto</th>
                        <th>Guía Transportista</th>
                        <th>Logística</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($programaciones as $programacion)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $programacion->fecha }}</td>
                            <td>{{ $programacion->guia_remision }}</td>
                            <td>{{ $programacion->placa_tracto }}</td>
                            <td>{{ $programacion->placa_carreta }}</td>
                            <td>{{ $programacion->marca_vehiculo }}</td>
                            <td>{{ $programacion->tipo_plataforma }}</td>
                            <td>{{ $programacion->constancia_mtc }}</td>
                            <td>{{ $programacion->constancia_mtc_carreta }}</td>
                            <td>{{ $programacion->razon_social_transporte }}</td>
                            <td>{{ $programacion->ruc_transporte }}</td>
                            <td>{{ $programacion->conductor }}</td>
                            <td>{{ $programacion->licencia }}</td>
                            <td>{{ $programacion->telefono_conductor }}</td>
                            <td>{{ $programacion->cuenta }}</td>
                            <td>{{ $programacion->cci }}</td>
                            <td>{{ $programacion->banco }}</td>
                            <td>{{ $programacion->tipo_mineral }}</td>
                            <td>{{ $programacion->numero_guia }}</td>
                            <td>{{ $programacion->conformidad_adelanto }}</td>
                            <td>{{ $programacion->guia_transportista }}</td>
                            <td>{{ $programacion->logistica }}</td>
                            <td class="text-center">
                                {{-- Botón Editar --}}
                                <button 
                                    type="button" 
                                    class="btn btn-sm btn-warning"
                                    onclick='openEditProgramacionModal(@json($programacion))'>
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
                            <td colspan="23" class="text-center text-muted">
                                No hay registros de programación.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
