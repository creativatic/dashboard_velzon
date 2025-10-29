@extends('layouts.plantilla')

@section('title', 'Entrega de EPPs')

@section('content')
@include('entregas.create')
@include('entregas.edit')
@include('entregas.show')

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Entrega de EPPs</h1>
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createEntregaModal">
            <i class="ri-add-circle-line"></i> Nueva entrega
        </button>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <table class="table table-bordered table-striped align-middle">
        <thead class="table-success">
            <tr>
                <th>Persona</th>
                <th>EPP</th>
                <th>Cantidad</th>
                <th>Fecha Entrega</th>
                <th>Fecha Devolución</th>
                <th>Observación</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($entregas as $item)
                <tr>
                    <td>{{ $item->persona }}</td>
                    <td>{{ $item->epp }}</td>
                    <td>{{ $item->cantidad }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->fecha_entrega)->format('d/m/Y') }}</td>
                    <td>
                        @if($item->fecha_devolucion)
                            {{ \Carbon\Carbon::parse($item->fecha_devolucion)->format('d/m/Y') }}
                        @else
                            <span class="badge bg-warning text-dark">Pendiente</span>
                        @endif
                    </td>
                    <td>{{ $item->observacion ?? '-' }}</td>
                    <td class="text-center">
                        <button class="btn btn-info btn-sm" data-bs-toggle="modal" 
                                data-bs-target="#showEntregaModal" 
                                onclick="verEntrega({{ $item->id }})">
                            <i class="ri-eye-line"></i>
                        </button>

                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal" 
                                data-bs-target="#editEntregaModal" 
                                onclick="editarEntrega({{ $item->id }})">
                            <i class="ri-edit-line"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
/**
 * Carga los datos de la entrega en el modal de edición
 */
function editarEntrega(id) {
    fetch(`/entregas/${id}`)
        .then(res => res.json())
        .then(data => {
            document.getElementById('edit_id').value = data.id;
            document.getElementById('edit_persona').value = data.persona;
            document.getElementById('edit_epp').value = data.epp;
            document.getElementById('edit_cantidad').value = data.cantidad;
            document.getElementById('edit_fecha_entrega').value = data.fecha_entrega;
            document.getElementById('edit_fecha_devolucion').value = data.fecha_devolucion ?? '';
            document.getElementById('edit_observacion').value = data.observacion ?? '';
        });
}

/**
 * Carga los datos de la entrega en el modal de vista
 */
function verEntrega(id) {
    fetch(`/entregas/${id}`)
        .then(res => res.json())
        .then(data => {
            document.getElementById('show_persona').textContent = data.persona;
            document.getElementById('show_epp').textContent = data.epp;
            document.getElementById('show_cantidad').textContent = data.cantidad;
            document.getElementById('show_fecha_entrega').textContent = data.fecha_entrega;
            document.getElementById('show_fecha_devolucion').textContent = data.fecha_devolucion ?? 'Pendiente';
            document.getElementById('show_observacion').textContent = data.observacion ?? '-';
        });
}
</script>
@endsection
