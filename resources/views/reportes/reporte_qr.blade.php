@extends('layouts.plantilla')

@section('title','Reporte QR')

@section('content')

<div class="page-title-box d-sm-flex align-items-center justify-content-between">
    <h4 class="mb-sm-0">Reporte de Programaciones con QR</h4>
    <div class="page-title-right">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="javascript: void(0);">Programación</a></li>
            <li class="breadcrumb-item active">Reporte de Programaciones con QR</li>
        </ol>
    </div>
</div>

{{-- Formulario de Exportación por Fecha --}}
<form action="{{ route('reportes.export_qr') }}" method="GET" class="d-flex align-items-center mb-3">
    
    {{-- Campo de Fecha Inicio --}}
    <div class="me-3">
        <label for="fecha_inicio" class="form-label visually-hidden">Desde:</label>
        <input type="date" 
               class="form-control form-control-sm" 
               id="fecha_inicio" 
               name="fecha_inicio" 
               value="{{ request('fecha_inicio') }}" 
               required>
    </div>

    {{-- Campo de Fecha Fin --}}
    <div class="me-3">
        <label for="fecha_fin" class="form-label visually-hidden">Hasta:</label>
        <input type="date" 
               class="form-control form-control-sm" 
               id="fecha_fin" 
               name="fecha_fin" 
               value="{{ request('fecha_fin') }}" 
               required>
    </div>
    
    {{-- Botón de Exportar --}}
    <button type="submit" class="btn btn-success btn-sm me-3">
        <i class="ri-file-excel-2-line"></i> Exportar por Fecha
    </button>
    
    {{-- Botón Volver --}}
    <a href="{{ route('programacions.index') }}" class="btn btn-primary btn-sm">
        <i class="ri-arrow-left-line"></i> Volver
    </a>
</form>

<div class="card mt-3">
    <div class="card-body table-responsive">
        <table class="table table-striped align-middle text-center">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    {{-- ORDEN SOLICITADO --}}
                    <th>Placa Tracto</th>
                    <th>Licencia</th>
                    <th>DNI</th>
                    <th>Nombres Conductor</th>
                    <th>Apellidos Conductor</th>
                    <th>RUC Transp.</th>
                    <th>Razón Social Transporte</th>
                    <th>Tipo Operación</th>
                    <th>Placa Carreta</th>
                    <th>Guía Remisión</th>
                    <th>Grupo Carguío</th>
                </tr>
            </thead>
            <tbody>
                @forelse($programaciones as $programacion)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        
                        {{-- 1. placa_tracto --}}
                        <td>{{ $programacion->placa_tracto ?? '-' }}</td>
                        
                        {{-- 2. licencia --}}
                        <td>{{ $programacion->licencia ?? '-' }}</td>
                        
                        {{-- 3. dni --}}
                        <td>{{ $programacion->dni ?? '-' }}</td>
                        
                        {{-- 4. nombres_conductor --}}
                        <td>{{ $programacion->nombres_conductor ?? '-' }}</td>
                        
                        {{-- 5. apellidos_conductor --}}
                        <td>{{ $programacion->apellidos_conductor ?? '-' }}</td>
                        
                        {{-- 6. ruc_transporte --}}
                        <td>{{ $programacion->ruc_transporte ?? '-' }}</td>
                        
                        {{-- 7. razon_social_transporte --}}
                        <td class="text-start">{{ $programacion->razon_social_transporte ?? '-' }}</td>
                        
                        {{-- 8. tipo_operacion --}}
                        <td>{{ ucfirst($programacion->tipo_operacion ?? 'N/A') }}</td>
                        
                        {{-- 9. placa_carreta --}}
                        <td>{{ $programacion->placa_carreta ?? '-' }}</td>
                        
                        {{-- 10. guia_remision --}}
                        <td>{{ $programacion->guia_remision ?? '-' }}</td>
                        
                        {{-- 11. grupo_cargio --}}
                        <td>{{ $programacion->grupo_cargio ?? '-' }}</td>
                    </tr>
                @empty
                    <tr>
                        {{-- El colspan debe ser 1 (para #) + 11 (columnas de datos) = 12 --}}
                        <td colspan="12" class="text-center text-muted">No hay programaciones registradas</td>
                    </tr>
                @endforelse
            </tbody>
        </table>    
    </div>
</div>
@endsection