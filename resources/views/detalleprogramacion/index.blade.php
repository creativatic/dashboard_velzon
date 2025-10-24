@extends('layouts.plantilla')

@section('title', 'Gestión de Frentes y Precios')

@section('content')
@include('detalleprogramacion.create')
@include('detalleprogramacion.edit')

<div class="page-title-box d-sm-flex align-items-center justify-content-between">
    <h4 class="mb-sm-0">Gestión de Frentes y Precios</h4>
    <div class="page-title-right">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="javascript: void(0);">Gestión de Frente</a></li>
            <li class="breadcrumb-item active">Gestión de Frentes y Precios</li>
        </ol>
    </div>
</div>
{{-- Botón para abrir modal crear frente --}}
<button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createFrenteModal">
    <i class="ri-add-circle-line"></i> Nuevo Frente
</button>

    <div class="card mt-3">
        <div class="card-body table-responsive">
            <table class="table table-striped align-middle text-center">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
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
                            <td>{{ $detalle->frente }}</td>
                            <td>S/ {{ number_format($detalle->precio_frente, 2) }}</td>
                            <td>S/ {{ number_format($detalle->precio_tn, 4) }}</td>
                            <td>{{ $detalle->descripcion ?? 'Sin descripción' }}</td>
                            <td>
                                <span class="badge bg-{{ $detalle->activo ? 'success' : 'danger' }}">
                                    {{ $detalle->activo ? 'Activo' : 'Inactivo' }}
                                </span>
                            </td>
                            <td>
                                    <button class="btn btn-warning btn-sm" 
                                        onclick='openEditFrenteModal(@json($detalle))'>
                                        <i class="ri-edit-2-line"></i>
                                    </button>

                                    <form action="{{ route('detalleprogramacion.destroy', $detalle->id) }}" 
                                          method="POST" 
                                          class="d-inline">
                                        @csrf 
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm"
                                                onclick="return confirm('¿Eliminar este frente?')" >
                                                <i class="ri-delete-bin-line"></i>
                                        </button>
                                    </form>
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

<script>
function openEditFrenteModal(detalle) {
    // CORREGIDO: Usar ruta con nombre
    const url = "{{ route('detalleprogramacion.update', ':id') }}".replace(':id', detalle.id);
    document.getElementById('editFrenteForm').action = url;
    
    // Llenar el formulario de edición con los datos del frente
    document.getElementById('edit_frente_id').value = detalle.id;
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