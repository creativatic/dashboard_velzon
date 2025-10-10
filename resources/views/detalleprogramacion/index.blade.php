@extends('layouts.plantilla')

@section('title', 'Gestión de Frentes y Precios')

@section('content')
@include('detalleprogramacion.create')
@include('detalleprogramacion.edit')

<div class="container-fluid">
        <h4 class="mb-3">Gestión de Frentes y Precios</h4>
        {{-- Botón para abrir modal crear frente --}}
        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createFrenteModal">
            <i class="ri-add-circle-line"></i> Nuevo Frente
        </button>


    <div class="card">
        <div class="card-body table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Programación</th>
                        <th>Frente</th>
                        <th>Precio Frente (S/)</th>
                        <th>Precio TN (S/)</th>
                        <th>Descripción</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($detalles as $detalle)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                @if($detalle->programacion)
                                    <strong>Guía: {{ $detalle->programacion->guia_remision ?? 'N/A' }}</strong>
                                    <br>
                                    <small class="text-muted">
                                        Fecha: {{ \Carbon\Carbon::parse($detalle->programacion->fecha)->format('d/m/Y') }}
                                    </small>
                                @else
                                    <span class="text-muted">Programación eliminada</span>
                                @endif
                            </td>
                            <td>{{ $detalle->frente }}</td>
                            <td>S/ {{ number_format($detalle->precio_frente, 2) }}</td>
                            <td>S/ {{ number_format($detalle->precio_tn, 2) }}</td>
                            <td>{{ $detalle->descripcion ?? 'Sin descripción' }}</td>
                            <td>
                                <span class="badge bg-{{ $detalle->activo ? 'success' : 'danger' }}">
                                    {{ $detalle->activo ? 'Activo' : 'Inactivo' }}
                                </span>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <button 
                                        type="button" 
                                        class="btn btn-sm btn-warning"
                                        onclick='openEditFrenteModal(@json($detalle))'>
                                        Editar
                                    </button>

                                    <form action="{{ route('detalleprogramacion.destroy', $detalle->id) }}" 
                                          method="POST" 
                                          class="d-inline">
                                        @csrf 
                                        @method('DELETE')
                                        <button onclick="return confirm('¿Eliminar este frente?')" 
                                                class="btn btn-sm btn-danger">
                                            Eliminar
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">No hay frentes registrados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            
            {{-- Paginación --}}
            <div class="d-flex justify-content-center mt-3">
                {{ $detalles->links() }}
            </div>
        </div>
    </div>
</div>

<script>
function openEditFrenteModal(detalle) {
    // Llenar el formulario de edición con los datos del frente
    document.getElementById('edit_frente_id').value = detalle.id;
    document.getElementById('edit_programacion_id').value = detalle.programacion_id;
    document.getElementById('edit_frente').value = detalle.frente;
    document.getElementById('edit_precio_frente').value = detalle.precio_frente;
    document.getElementById('edit_precio_tn').value = detalle.precio_tn;
    document.getElementById('edit_descripcion').value = detalle.descripcion || '';
    document.getElementById('edit_activo').checked = detalle.activo;
    
    // Abrir el modal
    var editModal = new bootstrap.Modal(document.getElementById('editFrenteModal'));
    editModal.show();
}
</script>
@endsection