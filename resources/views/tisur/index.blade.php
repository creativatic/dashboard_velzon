@extends('layouts.plantilla')

@section('title','TISUR')

@section('content')

@include('tisur.create')

<div class="page-title-box d-sm-flex align-items-center justify-content-between">
    <h4 class="mb-sm-0">Gestión de Registros TISUR</h4>
    <div class="page-title-right">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="javascript: void(0);">TISUR</a></li>
            <li class="breadcrumb-item active">Gestión de Registros TISUR</li>
        </ol>
    </div>
</div>

<button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalCreateTisur">
    <i class="ri-add-circle-line"></i> Nuevo Registro
</button>

<div class="card mt-3">
    <div class="card-body table-responsive">
        <table class="table table-striped align-middle text-center">
            <thead class="table-dark">
                <tr>
                    <th>N° Ticket</th>
                    <th>Fecha Ingreso</th>
                    <th>Placa Tracto</th>
                    <th>Razón Social</th>
                    <th>Transportista</th>
                    <th>Tipo Carga</th>
                    <th>Peso Neto (kg)</th>
                    <th>Precio ($)</th>
                    <th>Total ($)</th>
                    <th>Retencion ($)</th>
                    <th>Pago ($)</th>
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
                    <td>{{ $t->transportista }}</td>
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
</div>

@endsection
