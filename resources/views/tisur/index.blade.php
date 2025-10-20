@extends('layouts.plantilla')

@section('title','TISUR')

@section('content')

{{-- Modal de creación --}}
@include('tisur.create')

<div class="container-fluid mt-3">

    <div class="d-flex justify-content-between mb-3">
        <h4>Gestión de Registros TISUR</h4>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCreateTisur">
            <i class="ri-add-line"></i> Nuevo Registro
        </button>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <table class="table table-bordered table-hover align-middle">
        <thead class="table-light">
            <tr class="text-center">
                <th>N° Ticket</th>
                <th>Fecha Ingreso</th>
                <th>Placa Tracto</th>
                <th>Razón Social</th>
                <th>Tipo Carga</th>
                <th>Peso Neto (kg)</th>
                <th>Precio (S/)</th>
                <th>Total (S/)</th>
                <th>Retencion (S/)</th>
                <th>Pago (S/)</th>
                <th>Estado</th>
                <th width="120">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($tisurs as $t)
            <tr>
                <td class="text-center">{{ $t->numero_ticket }}</td>
                <td>{{ \Carbon\Carbon::parse($t->fecha_hora_ingreso)->format('d/m/Y H:i') }}</td>
                <td>{{ $t->placa_tracto }}</td>
                <td>{{ $t->razon_social }}</td>
                <td>{{ $t->tipo_carga_tisur }}</td>
                <td class="text-end">{{ number_format($t->peso_neto, 2) }}</td>
                <td class="text-end">{{ number_format($t->precio_tisur, 2) }}</td>
                <td class="text-end">{{ number_format($t->total_tisur, 2) }}</td>
                <td class="text-end">{{ number_format($t->retencion_tisur, 2) }}</td>
                <td class="text-end">{{ number_format($t->pago_tisur, 2) }}</td>
                <td>
                    @if($t->estado === 'Pendiente')
                        <span class="badge bg-warning text-dark">Pendiente</span>
                    @else
                        <span class="badge bg-success">Pagado</span>
                    @endif
                </td>
                <td class="text-center">
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

            {{-- Modal de edición --}}
            @include('tisur.edit', ['tisur' => $t])
            @empty
            <tr>
                <td colspan="9" class="text-center text-muted">No hay registros disponibles</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-3">
        {{ $tisurs->links() }}
    </div>
</div>
@endsection
