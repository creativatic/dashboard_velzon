@extends('layouts.plantilla')
@section('title','Volquetes')
@section('content')
@include('volquetes.create') {{-- Modal Crear Volquete --}}



<div class="page-title-box d-sm-flex align-items-center justify-content-between">
    <h4 class="mb-sm-0">Gestión de Volquetes</h4>
    <div class="page-title-right">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="javascript:void(0);">Volquetes</a></li>
            <li class="breadcrumb-item active">Listado</li>
        </ol>
    </div>
</div>

<button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalCreateVolquete">
    <i class="ri-add-circle-line"></i> Nuevo Volquete
</button>

<div class="card mt-3">
    <div class="card-body table-responsive">

        <table class="table table-striped align-middle text-center">
            <thead class="table-dark">
                <tr>
                    <th>Fecha</th>
                    <th>Proveedor</th>
                    <th>Frente</th>
                    <th>Lámparas</th>
                    <th>Peso Total</th>
                    <th>Pasadas</th>
                    <th>Total S/</th>
                    <th width="120">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($volquetes as $v)
                <tr>
                    <td>{{ $v->fecha }}</td>
                    {{-- proveedor --}}
                    <td>{{ $v->proveedor->razon_social ?? '-' }}</td>

                    {{-- frente --}}
                    <td>{{ $v->detalleProgramacion->frente ?? '-' }}</td>

                    {{-- lampadas --}}
                    <td>{{ ($v->lampadas_vuelta_1 ?? 0) + ($v->lampadas_vuelta_2 ?? 0) }}</td>

                    {{-- peso total --}}
                    <td>{{ number_format($v->total_peso_dia ?? 0, 2) }}</td>
                    
                    <td>{{ $v->pasadas }}</td>
                    <td>{{ number_format($v->total, 2) }}</td>

                    <td>

                        <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#modalShowVolquete{{ $v->id }}">
                            <i class="ri-eye-line"></i>
                        </button>

                        <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#modalEditVolquete{{ $v->id }}">
                            <i class="ri-edit-line"></i>
                        </button>

                        <form action="{{ route('volquetes.destroy', $v->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar volquete?')">
                                <i class="ri-delete-bin-line"></i>
                            </button>
                        </form>
                    </td>
                </tr>

                {{-- Modal Editar --}}
                @include('volquetes.edit', [
                    'volquete' => $v,
                    'proveedores' => $proveedores,
                    'frentes' => $frentes
                ])

                @include('volquetes.show', [
                    'volquete' => $v
                ])

                @empty
                <tr>
                    <td colspan="8" class="text-center text-muted">No hay registros de volquetes</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-3">
            {{ $volquetes->links() }}
        </div>

    </div>
</div>

@endsection
