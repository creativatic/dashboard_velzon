@extends('layouts.plantilla')

@section('title','EPPs')

@section('content')
@include('epps.create')
@include('epps.edit')

<div class="container">

        <h1>Listado de EPPs</h1>
        <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#createEppModal">
            <i class="ri-add-circle-line"></i> Agregar EPP
        </button>


    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Código</th>
                <th>Nombre</th>
                <th>Categoría</th>
                <th>Talla</th>
                <th>Stock</th>
                <th>Unidad</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($epps as $epp)
                <tr>
                    <td>{{ $epp->codigo }}</td>
                    <td>{{ $epp->nombre }}</td>
                    <td>{{ $epp->categoria ?? '-' }}</td>
                    <td>{{ $epp->talla ?? '-' }}</td>
                    <td>{{ $epp->stock }}</td>
                    <td>{{ $epp->unidades_medidas ?? '-' }}</td>
                    <td>
                        @if($epp->estado)
                            <span class="badge bg-success">Activo</span>
                        @else
                            <span class="badge bg-danger">Inactivo</span>
                        @endif
                    </td>
                    <td>
                        <button class="btn btn-warning btn-sm"
                                data-bs-toggle="modal"
                                data-bs-target="#editEppModal"
                                data-id="{{ $epp->id }}"
                                data-nombre="{{ $epp->nombre }}"
                                data-codigo="{{ $epp->codigo }}"
                                data-categoria="{{ $epp->categoria }}"
                                data-talla="{{ $epp->talla }}"
                                data-stock="{{ $epp->stock }}"
                                data-unidades_medidas="{{ $epp->unidades_medidas }}"
                                data-descripcion="{{ $epp->descripcion }}"
                                data-estado="{{ $epp->estado }}">
                            Editar
                        </button>

                        <form action="{{ route('epps.destroy', $epp) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('¿Seguro que deseas eliminar este EPP?')">
                                Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    const editEppModal = document.getElementById('editEppModal');
    editEppModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;

        document.getElementById('edit_id').value = button.getAttribute('data-id');
        document.getElementById('edit_nombre').value = button.getAttribute('data-nombre');
        document.getElementById('edit_codigo').value = button.getAttribute('data-codigo');
        document.getElementById('edit_categoria').value = button.getAttribute('data-categoria');
        document.getElementById('edit_talla').value = button.getAttribute('data-talla');
        document.getElementById('edit_unidades_medidas').value = button.getAttribute('data-unidades_medidas');
        document.getElementById('edit_stock').value = button.getAttribute('data-stock');
        document.getElementById('edit_descripcion').value = button.getAttribute('data-descripcion');
        document.getElementById('edit_estado').checked = button.getAttribute('data-estado') == 1;

        const form = document.getElementById('editEppForm');
        form.action = `/epps/${button.getAttribute('data-id')}`;
    });
</script>
@endsection
