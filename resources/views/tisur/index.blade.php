@extends('layouts.plantilla')

@section('title','TISUR')

@section('content')

@include('tisur.create')

<div class="container-fluid mt-3">

    <div class="d-flex justify-content-between mb-3">
        <h4>Gestión de Registros TISUR</h4>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCreateTisur">
            <i class="ri-add-line"></i> Nuevo Registro
        </button>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-hover">
        <thead class="table-light">
            <tr>
                <th>N° Ticket</th>
                <th>Fecha Ingreso</th>
                <th>Placa Tracto</th>
                <th>Razón Social</th>
                <th>Carga</th>
                <th>Peso Neto</th>
                <th>Total</th>
                <th>Estado</th>
                <th width="120">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tisurs as $t)
            <tr>
                <td>{{ $t->numero_ticket }}</td>
                <td>{{ $t->fecha_hora_ingreso }}</td>
                <td>{{ $t->placa_tracto }}</td>
                <td>{{ $t->razon_social }}</td>
                <td>{{ $t->carga }}</td>
                <td>{{ $t->peso_neto }}</td>
                <td>{{ $t->total }}</td>
                <td>{{ $t->estado }}</td>
                <td>
                    <button class="btn btn-sm btn-warning" 
                            data-bs-toggle="modal" 
                            data-bs-target="#modalEditTisur{{ $t->id }}">
                        <i class="ri-edit-line"></i>
                    </button>
                    <form action="{{ route('tisur.destroy', $t) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar registro?')">
                            <i class="ri-delete-bin-line"></i>
                        </button>
                    </form>
                </td>
            </tr>

            {{-- Modal de edición por cada registro --}}
            @include('tisur.edit', ['tisur' => $t])
            @endforeach
        </tbody>
    </table>

    {{ $tisurs->links() }}
</div>
@endsection
