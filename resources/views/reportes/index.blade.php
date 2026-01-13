@extends('layouts.plantilla')

@section('title', 'Reporte por Orden de Trabajo')

@section('content')
<div class="container">

    <h4 class="mb-4">Reporte por Orden de Trabajo</h4>

    {{-- 🔍 Buscador --}}
    <form method="GET" action="{{ route('reportes.index') }}" class="row g-3 mb-4">
        <div class="col-md-4">
            <label class="form-label">Orden de Trabajo</label>
            <input type="text"
                   name="orden_trabajo"
                   class="form-control"
                   placeholder="Ej: QU0003"
                   value="{{ $orden }}">
        </div>

        <div class="col-md-2 align-self-end">
            <button class="btn btn-primary w-100">
                <i class="ri-search-line"></i> Buscar
            </button>
        </div>
    </form>

    {{-- ⚠️ Sin resultados --}}
    @if($orden && $registros->isEmpty())
        <div class="alert alert-warning">
            No se encontraron registros para la orden
            <strong>{{ $orden }}</strong>.
        </div>
    @endif

    {{-- 📊 Tabla --}}
    @if($registros->isNotEmpty())
        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>DNI</th>
                        <th>Persona</th>
                        <th>EPP</th>
                        <th>Cantidad</th>
                        <th>Fecha Entrega</th>
                        <th>Fecha Devolución</th>
                        <th>N° Vale</th>
                        <th>Orden</th>
                        <th>Observación</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($registros as $r)
                        <tr>
                            <td>{{ $r->dni }}</td>
                            <td>{{ $r->persona }}</td>

                            {{-- TOTAL DE EPPS --}}
                            <td class="text-center">
                                {{ $r->total_epps }}
                            </td>

                            {{-- SUMA TOTAL --}}
                            <td class="text-center">
                                {{ $r->cantidad_total }}
                            </td>

                            {{-- ÚLTIMA ENTREGA --}}
                            <td>
                                {{ $r->ultima_entrega }}
                            </td>

                            {{-- FECHA DEVOLUCIÓN --}}
                            <td>
                                @if($r->fecha_devolucion)
                                    <span class="badge bg-success">
                                        {{ $r->fecha_devolucion }}
                                    </span>
                                @else
                                    <span class="badge bg-warning text-dark">
                                        Pendiente
                                    </span>
                                @endif
                            </td>

                            <td>{{ $r->numero_vale ?? '-' }}</td>
                            <td>{{ $r->orden_trabajo }}</td>
                            <td>{{ $r->observacion ?? '-' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- ℹ️ Contador --}}
        <div class="text-muted text-center mb-2">
            Mostrando {{ $registros->firstItem() }}
            a {{ $registros->lastItem() }}
            de {{ $registros->total() }} registros
        </div>

        {{-- 🔢 Paginación --}}
        @if ($registros->hasPages())
            <nav aria-label="Navegación de páginas">
                <ul class="pagination justify-content-center">

                    {{-- Anterior --}}
                    @if ($registros->onFirstPage())
                        <li class="page-item disabled">
                            <span class="page-link">Anterior</span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $registros->previousPageUrl() }}">
                                Anterior
                            </a>
                        </li>
                    @endif

                    @php
                        $current = $registros->currentPage();
                        $last = $registros->lastPage();
                        $start = max($current - 3, 1);
                        $end = min($current + 3, $last);
                    @endphp

                    {{-- Primera --}}
                    @if ($start > 1)
                        <li class="page-item">
                            <a class="page-link" href="{{ $registros->url(1) }}">1</a>
                        </li>
                        @if ($start > 2)
                            <li class="page-item disabled">
                                <span class="page-link">...</span>
                            </li>
                        @endif
                    @endif

                    {{-- Rango --}}
                    @for ($page = $start; $page <= $end; $page++)
                        @if ($page == $current)
                            <li class="page-item active">
                                <span class="page-link">{{ $page }}</span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $registros->url($page) }}">
                                    {{ $page }}
                                </a>
                            </li>
                        @endif
                    @endfor

                    {{-- Última --}}
                    @if ($end < $last)
                        @if ($end < $last - 1)
                            <li class="page-item disabled">
                                <span class="page-link">...</span>
                            </li>
                        @endif
                        <li class="page-item">
                            <a class="page-link" href="{{ $registros->url($last) }}">
                                {{ $last }}
                            </a>
                        </li>
                    @endif

                    {{-- Siguiente --}}
                    @if ($registros->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" href="{{ $registros->nextPageUrl() }}">
                                Siguiente
                            </a>
                        </li>
                    @else
                        <li class="page-item disabled">
                            <span class="page-link">Siguiente</span>
                        </li>
                    @endif

                </ul>
            </nav>
        @endif
    @endif

</div>
@endsection
