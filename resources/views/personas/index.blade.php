@extends('layouts.plantilla')

@section('title', 'Personal')

@section('content')
<div class="container">
    <h1>Listado de Personal</h1>
    <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#createPersonaModal">
        <i class="ri-add-circle-line"></i> Agregar Persona
    </button>

    <table class="table table-bordered align-middle">
        <thead class="table-dark">
            <tr>
                <th>DNI</th>
                <th>Nombre</th>
                <th>Especialidad</th>
                <th>Área</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($personas as $persona)
            <tr>
                <td>{{ $persona->dni }}</td>
                <td>{{ $persona->nombres }}</td>
                <td>{{ $persona->cargo }}</td>
                <td>{{ $persona->area }}</td>
                <td>
                    @if($persona->estado)
                        <span class="badge bg-success">Activo</span>
                    @else
                        <span class="badge bg-secondary">Inactivo</span>
                    @endif
                </td>
                <td>
                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal" 
                        data-bs-target="#editPersonaModal"
                        onclick='cargarDatosPersona(@json($persona))'>
                        Editar
                    </button>

                    <form action="{{ route('personas.destroy', $persona) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" 
                            onclick="return confirm('¿Seguro que deseas eliminar esta persona?')">
                            Eliminar
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- 🔹 Paginación personalizada -->
    @if ($personas->hasPages())
        <nav aria-label="Navegación de páginas">
            <ul class="pagination justify-content-center">

                {{-- Botón "Anterior" --}}
                @if ($personas->onFirstPage())
                    <li class="page-item disabled">
                        <span class="page-link">Anterior</span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $personas->previousPageUrl() }}" rel="prev">Anterior</a>
                    </li>
                @endif

                {{-- 🔹 Mostrar solo 7 páginas alrededor de la actual --}}
                @php
                    $current = $personas->currentPage();
                    $last = $personas->lastPage();
                    $start = max($current - 3, 1);
                    $end = min($current + 3, $last);
                @endphp

                {{-- Mostrar "..." si hay páginas anteriores ocultas --}}
                @if ($start > 1)
                    <li class="page-item"><a class="page-link" href="{{ $personas->url(1) }}">1</a></li>
                    @if ($start > 2)
                        <li class="page-item disabled"><span class="page-link">...</span></li>
                    @endif
                @endif

                {{-- Números visibles --}}
                @for ($page = $start; $page <= $end; $page++)
                    @if ($page == $personas->currentPage())
                        <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                    @else
                        <li class="page-item"><a class="page-link" href="{{ $personas->url($page) }}">{{ $page }}</a></li>
                    @endif
                @endfor

                {{-- Mostrar "..." si hay páginas siguientes ocultas --}}
                @if ($end < $last)
                    @if ($end < $last - 1)
                        <li class="page-item disabled"><span class="page-link">...</span></li>
                    @endif
                    <li class="page-item"><a class="page-link" href="{{ $personas->url($last) }}">{{ $last }}</a></li>
                @endif

                {{-- Botón "Siguiente" --}}
                @if ($personas->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $personas->nextPageUrl() }}" rel="next">Siguiente</a>
                    </li>
                @else
                    <li class="page-item disabled">
                        <span class="page-link">Siguiente</span>
                    </li>
                @endif

            </ul>
        </nav>
    @endif


</div>

@include('personas.create')
@include('personas.edit')
@endsection
