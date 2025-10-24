@extends('layouts.plantilla')

@section('title','Reporte QR')

@section('content')
<h4 class="mb-3">Reporte de Programaciones con QR</h4>
<a href="{{ route('programacions.index') }}" class="btn btn-primary btn-sm">
    <i class="ri-arrow-left-line"></i> Volver
</a>
<div class="card mt-3">
    <div class="card-body table-responsive">
        <table class="table table-striped align-middle text-center">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Carguio</th>
                    <th>Conductor</th>
                    <th>Placa Vehiculo</th>
                    <th>Fecha</th>
                    <th>Conformidad Adelanto</th>
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
                            @if($programacion->conformidad_adelanto === 'Ok')
                                <span class="badge bg-success">{{ $programacion->conformidad_adelanto }}</span>
                            @else
                                <span class="badge bg-danger">{{ $programacion->conformidad_adelanto }}</span>
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
