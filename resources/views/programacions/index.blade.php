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
                        
                        <th>Monto Adelanto</th>

                        <th>Guía Transportista</th>

                        <th>Conformidad</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                        @forelse($programaciones as $programacion)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ \Carbon\Carbon::parse($programacion->fecha_programacion)->format('d/m/Y') }}</td>
                                <td>{{ $programacion->guia_remision ?? '-' }}</td>

                                @php
                                    $unidad = $programacion->proveedor?->unidades?->first();
                                    $conductor = $unidad?->conductores?->first();
                                @endphp

                                <td>{{ $conductor->nombres ?? '-' }}</td>
                                <td>{{ $conductor->apellidos ?? '-' }}</td>
                                <td>{{ $conductor->telefono ?? '-' }}</td>

                                <td>{{ $programacion->tipo_mineral ?? '-' }}</td>
                                <td>{{ $programacion->tipo_operacion ?? '-' }}</td>
                                <td>{{ $programacion->detalleProgramacion?->frente ?? '—' }}</td>

                                

                                <td>{{ $programacion->monto_adelanto ? 'S/ '.number_format($programacion->monto_adelanto,2) : '-' }}</td>
                                <td>{{ $programacion->guia_transportista ?? '-' }}</td>

                                <td class="text-center">
                                    @role('Administrador')
                                        <form action="{{ route('programacions.conformidad', $programacion->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')

                                            <div class="form-check form-switch d-flex justify-content-center">
                                                <input
                                                    class="form-check-input"
                                                    type="checkbox"
                                                    role="switch"
                                                    name="conformidad_adelanto"
                                                    value="Ok"
                                                    {{ $programacion->conformidad_adelanto === 'Ok' ? 'checked' : '' }}
                                                    onchange="this.form.submit()"
                                                >
                                            </div>
                                        </form>

                                        {{-- TEXTO DE ESTADO --}}
                                        <small class="fw-bold d-block mt-1
                                            {{ $programacion->conformidad_adelanto === 'Ok' ? 'text-success' : 'text-danger' }}">
                                            {{ $programacion->conformidad_adelanto === 'Ok' ? 'OK' : 'Pendiente' }}
                                        </small>

                                    @else
                                        {{-- Supervisor y otros roles: solo lectura --}}
                                        <span class="badge 
                                            {{ $programacion->conformidad_adelanto === 'Ok' ? 'bg-success' : 'bg-danger' }}">
                                            {{ $programacion->conformidad_adelanto === 'Ok' ? 'OK' : 'Pendiente' }}
                                        </span>
                                    @endrole
                                </td>

                                <td>
                                    {{-- Botones de acciones --}}

                                    <button type="button" class="btn btn-info btn-sm"
                                        onclick="verProgramacion({{ $programacion->id }})">
                                        <i class="fas fa-eye"></i> Ver
                                    </button>

                                    {{-- COMENTAR BOTON
                                    <button type="button" class="btn btn-warning btn-sm"
                                        onclick='openEditProgramacionModal(@json($programacion))'>
                                        <i class="ri-edit-2-line"></i>
                                    </button>
                                    --}}

                                    
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

@endsection

