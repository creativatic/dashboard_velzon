@extends('layouts.plantilla')

@section('title','Reporte QR')

@section('content')
<div class="card mt-3">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">Reporte de Programaciones con QR</h5>
        <a href="{{ route('programacions.index') }}" class="btn btn-primary btn-sm">
            <i class="ri-arrow-left-line"></i> Volver
        </a>
    </div>

    <div class="card-body">
        <table class="table table-striped align-middle">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Carguio</th>
                    <th>Conductor</th>
                    <th>Placa Vehiculo</th>
                    <th>Fecha</th>
                    <th>Código QR</th>
                </tr>
            </thead>
            <tbody>
                @forelse($programaciones as $programacion)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $programacion->grupo_cargio }}</td>
                        <td>{{ $programacion->nombres_conductor }}</td>
                        <td>{{ $programacion->placa_tracto }}</td>
                        <td>{{ $programacion->fecha_programacion ?? 'Sin fecha' }}</td>
                        <td>
                            @if(!empty($programacion->qr_codigo))
                                <img src="data:image/png;base64, {!! base64_encode(QrCode::size(80)->generate($programacion->qr_codigo)) !!}" alt="QR">
                            @else
                                <span class="text-muted">No generado</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">No hay programaciones registradas</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
