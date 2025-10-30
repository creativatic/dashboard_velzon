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
                <th>Medidas</th>
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
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

    <!-- 🔹 Paginación personalizada -->
    @if ($epps->hasPages())
        <nav aria-label="Navegación de páginas">
            <ul class="pagination justify-content-center">

                {{-- Botón "Anterior" --}}
                @if ($epps->onFirstPage())
                    <li class="page-item disabled">
                        <span class="page-link">Anterior</span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $epps->previousPageUrl() }}" rel="prev">Anterior</a>
                    </li>
                @endif

                {{-- 🔹 Mostrar solo 7 páginas alrededor de la actual --}}
                @php
                    $current = $epps->currentPage();
                    $last = $epps->lastPage();
                    $start = max($current - 3, 1);
                    $end = min($current + 3, $last);
                @endphp

                {{-- Mostrar "..." si hay páginas anteriores ocultas --}}
                @if ($start > 1)
                    <li class="page-item"><a class="page-link" href="{{ $epps->url(1) }}">1</a></li>
                    @if ($start > 2)
                        <li class="page-item disabled"><span class="page-link">...</span></li>
                    @endif
                @endif

                {{-- Números visibles --}}
                @for ($page = $start; $page <= $end; $page++)
                    @if ($page == $epps->currentPage())
                        <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                    @else
                        <li class="page-item"><a class="page-link" href="{{ $epps->url($page) }}">{{ $page }}</a></li>
                    @endif
                @endfor

                {{-- Mostrar "..." si hay páginas siguientes ocultas --}}
                @if ($end < $last)
                    @if ($end < $last - 1)
                        <li class="page-item disabled"><span class="page-link">...</span></li>
                    @endif
                    <li class="page-item"><a class="page-link" href="{{ $epps->url($last) }}">{{ $last }}</a></li>
                @endif

                {{-- Botón "Siguiente" --}}
                @if ($epps->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $epps->nextPageUrl() }}" rel="next">Siguiente</a>
                    </li>
                @else
                    <li class="page-item disabled">
                        <span class="page-link">Siguiente</span>
                    </li>
                @endif

            </ul>
        </nav>
    @endif


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
