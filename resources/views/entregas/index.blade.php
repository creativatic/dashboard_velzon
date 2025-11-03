@extends('layouts.plantilla')
@section('title', 'Entrega de EPPs')
@section('content')
@include('entregas.create')
@include('entregas.edit')
@include('entregas.show')

<div class="container">

    <h1>Entrega de EPPs</h1>
    <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#createEntregaModal">
        <i class="ri-add-circle-line"></i> Nueva entrega
    </button>
    
    <form method="GET" action="{{ route('entregas.index') }}" class="row g-3 align-items-end mb-4">
        
        {{-- ✅ NUEVO CAMPO DE FILTRO POR DNI --}}
        <div class="col-md-3">
            <label for="dni" class="form-label">Filtrar por DNI</label>
            <input type="text" id="dni" name="dni" class="form-control"
                value="{{ request('dni') }}" placeholder="DNI del colaborador">
        </div>

        <div class="col-md-2"> {{-- Ajustado a md-2 para dejar espacio --}}
            <label for="desde" class="form-label">Desde</label>
            <input type="date" id="desde" name="desde" class="form-control"
                value="{{ request('desde') }}">
        </div>

        <div class="col-md-2"> {{-- Ajustado a md-2 --}}
            <label for="hasta" class="form-label">Hasta</label>
            <input type="date" id="hasta" name="hasta" class="form-control"
                value="{{ request('hasta') }}">
        </div>

        <div class="col-md-3">
            <button type="submit" class="btn btn-primary">
                <i class="ri-filter-line"></i> Filtrar
            </button>
            <a href="{{ route('entregas.index') }}" class="btn btn-secondary">
                <i class="ri-refresh-line"></i> Limpiar
            </a>
        </div>
    </form>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

   <table class="table table-bordered table-striped align-middle">
        <thead class="table-dark">
            <tr>
                <th>DNI</th>
                <th>Persona</th>
                <th>Última entrega</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($entregas as $item)
                <tr>
                    <td>{{ $item->dni }}</td>
                    <td>{{ $item->persona }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->ultima_entrega)->format('d/m/Y') }}</td>
                    <td class="text-center">
                        <button class="btn btn-info btn-sm" data-bs-toggle="modal" 
                                data-bs-target="#showEntregaModal" 
                                onclick="verEntregasPersona({{ $item->persona_id }}, '{{ $item->persona }}')">
                            <i class="ri-eye-line"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

    @if ($entregas->hasPages())
        <nav aria-label="Navegación de páginas">
            <ul class="pagination justify-content-center">

                {{-- Botón "Anterior" --}}
                @if ($entregas->onFirstPage())
                    <li class="page-item disabled">
                        <span class="page-link">Anterior</span>
                    </li>
                @else
                    <li class="page-item">
                        {{-- 🔑 CLAVE: Añadir los query parameters a la paginación --}}
                        <a class="page-link" href="{{ $entregas->appends(request()->query())->previousPageUrl() }}" rel="prev">Anterior</a>
                    </li>
                @endif

                {{-- 🔹 Mostrar solo 7 páginas alrededor de la actual --}}
                @php
                    $current = $entregas->currentPage();
                    $last = $entregas->lastPage();
                    $start = max($current - 3, 1);
                    $end = min($current + 3, $last);
                    $query = request()->query(); // Obtener todos los filtros
                @endphp

                {{-- Mostrar "..." si hay páginas anteriores ocultas --}}
                @if ($start > 1)
                    <li class="page-item">
                        <a class="page-link" href="{{ $entregas->url(1) }}&{{ http_build_query($query) }}">1</a>
                    </li>
                    @if ($start > 2)
                        <li class="page-item disabled"><span class="page-link">...</span></li>
                    @endif
                @endif

                {{-- Números visibles --}}
                @for ($page = $start; $page <= $end; $page++)
                    @php
                        $url = $entregas->url($page) . '&' . http_build_query($query);
                    @endphp
                    @if ($page == $entregas->currentPage())
                        <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                    @else
                        <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endfor

                {{-- Mostrar "..." si hay páginas siguientes ocultas --}}
                @if ($end < $last)
                    @if ($end < $last - 1)
                        <li class="page-item disabled"><span class="page-link">...</span></li>
                    @endif
                    <li class="page-item">
                        <a class="page-link" href="{{ $entregas->url($last) }}&{{ http_build_query($query) }}">{{ $last }}</a>
                    </li>
                @endif

                {{-- Botón "Siguiente" --}}
                @if ($entregas->hasMorePages())
                    <li class="page-item">
                        {{-- 🔑 CLAVE: Añadir los query parameters a la paginación --}}
                        <a class="page-link" href="{{ $entregas->appends(request()->query())->nextPageUrl() }}" rel="next">Siguiente</a>
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
/**
 * Carga los datos de la entrega en el modal de edición
 */
    function editarEntrega(id) {
        fetch(`/entregas/${id}`)
            .then(res => res.json())
            .then(data => {
                document.getElementById('edit_id').value = data.id;
                document.getElementById('edit_persona_id').value = data.persona_id;
                document.getElementById('edit_persona').value = data.persona;
                document.getElementById('edit_epp').value = data.epp;
                document.getElementById('edit_unidad_medida').value = data.unidades_medidas ?? '';
                document.getElementById('edit_numero_vale').value = data.numero_vale ?? '';
                document.getElementById('edit_orden_trabajo').value = data.orden_trabajo ?? '';
                document.getElementById('edit_cantidad').value = data.cantidad;
                document.getElementById('edit_fecha_entrega').value = data.fecha_entrega;
                document.getElementById('edit_fecha_devolucion').value = data.fecha_devolucion ?? '';
                document.getElementById('edit_observacion').value = data.observacion ?? '';
            });
    }

    /**
     * Carga las entregas de una persona (para el modal "Ver Entregas")
     */
    function verEntregasPersona(persona_id, nombre) {
        document.getElementById('persona_nombre').textContent = nombre;
        const contenedor = document.getElementById('contenedorEntregasPersona');
        contenedor.innerHTML = `<div class="text-center text-muted">Cargando...</div>`;

        fetch(`/entregas/persona/${persona_id}`)
            .then(res => res.json())
            .then(data => {
                if (data.length === 0) {
                    contenedor.innerHTML = `<div class="text-center text-muted">No hay entregas registradas.</div>`;
                    return;
                }

                contenedor.innerHTML = data.map(item => `
                    <div class="card mb-4 shadow-sm">
                        <div class="card-header bg-light fw-bold">
                            ${item.epp} ${ item.registros && item.registros.length ? `<small class="text-muted"> — ${item.registros[0].unidades_medidas ?? ''}</small>` : '' }
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-sm mb-0">
                                <thead class="table-secondary">
                                    <tr>
                                        <th>Cantidad</th>
                                        <th>Unidad Medida</th>
                                        <th>N° Vale</th>
                                        <th>Orden Trabajo</th>
                                        <th>Fecha Entrega</th>
                                        <th>Fecha Devolución</th>
                                        <th>Observación</th>
                                        <th class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    ${item.registros.map(r => `
                                        <tr>
                                            <td>${r.cantidad}</td>
                                            <td>${r.unidades_medidas ?? '-'}</td>
                                            <td>${r.numero_vale ?? '-'}</td>
                                            <td>${r.orden_trabajo ?? '-'}</td>
                                            <td>${r.fecha_entrega}</td>
                                            <td>
                                                ${r.fecha_devolucion 
                                                    ? `<span class="badge bg-success">${r.fecha_devolucion}</span>`
                                                    : `<span class="badge bg-warning text-dark">Pendiente</span>`}
                                            </td>
                                            <td>${r.observacion ?? '-'}</td>
                                            <td class="text-center">
                                                ${
                                                    !r.fecha_devolucion
                                                        ? `<button class="btn btn-warning btn-sm" 
                                                                data-bs-toggle="modal" 
                                                                data-bs-target="#editEntregaModal" 
                                                                onclick="editarEntrega(${r.id})">
                                                            <i class='ri-edit-line'></i>
                                                        </button>`
                                                        : `<span class='text-muted'>—</span>`
                                                }
                                            </td>
                                        </tr>
                                    `).join('')}
                                </tbody>
                            </table>
                        </div>
                    </div>
                `).join('');

            })
            .catch(err => {
                console.error(err);
                contenedor.innerHTML = `<div class="text-center text-danger">Error al cargar las entregas.</div>`;
            });
    }

</script>
@endsection
