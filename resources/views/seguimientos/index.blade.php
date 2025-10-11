@extends('layouts.plantilla')

@section('title','Seguimiento')

@section('content')
@include('seguimientos.create')

<div class="card mt-3">
    <div class="card-header">
        <h5 class="card-title">Listado de Seguimiento</h5>
    </div>
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Carguio</th>
                    <th>Conductor</th>
                    <th>Placa</th>
                    <th>Notas</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($programaciones as $programacion)
                    @php
                        $seguimiento = $programacion->seguimiento;
                    @endphp
                    <tr>
                        <td>{{ $programacion->carguio }}</td>
                        <td>{{ $programacion->conductor }}</td>
                        <td>{{ $programacion->placa }}</td>
                        <td>{{ $seguimiento->notas ?? 'Sin notas' }}</td>
                        <td>
                            @if($seguimiento)
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditSeguimiento{{ $seguimiento->id }}">
                                    Editar
                                </button>
                                @include('seguimiento.edit', ['seguimiento' => $seguimiento])
                            @else
                                <form action="{{ route('seguimientos.store') }}" method="POST" style="display:inline;">
                                    @csrf
                                    <input type="hidden" name="programacion_id" value="{{ $programacion->id }}">
                                    <button type="submit" class="btn btn-success btn-sm">Crear Seguimiento</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
