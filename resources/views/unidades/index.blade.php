@extends('layouts.plantilla')

@section('title','Unidades')

@section('content')

@include('unidades.create') {{-- Modal Crear Unidad --}}

<div class="page-title-box d-sm-flex align-items-center justify-content-between">
    <h4 class="mb-sm-0">Gestión de Unidades</h4>
    <div class="page-title-right">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="javascript:void(0);">Unidades</a></li>
            <li class="breadcrumb-item active">Listado</li>
        </ol>
    </div>
</div>

<button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalCreateUnidad">
    <i class="ri-add-circle-line"></i> Nueva Unidad
</button>

<div class="card mt-3">
    <div class="card-body table-responsive">

        <table class="table table-striped align-middle text-center">
            <thead class="table-dark">
                <tr>
                    <th>Placa Tracto</th>
                    <th>Placa Carreta</th>
                    <th>Marca</th>
                    <th>Tipo Plataforma</th>
                    <th>Constancia Tracto</th>
                    <th>Constancia Carreta</th>
                    <th>Proveedor</th>
                    <th width="120">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($unidades as $u)
                <tr>
                    <td>{{ $u->placa_tracto }}</td>
                    <td>{{ $u->placa_carreta }}</td>
                    <td>{{ $u->marca_vehiculo }}</td>
                    <td>{{ $u->tipo_plataforma }}</td>
                    <td>{{ $u->constancia_mtc_tracto }}</td>
                    <td>{{ $u->constancia_mtc_carreta }}</td>
                    <td>{{ $u->proveedor->razon_social ?? '-' }}</td>
                    <td>
                        <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#modalEditUnidad{{ $u->id }}">
                            <i class="ri-edit-line"></i>
                        </button>

                        <form action="{{ route('unidades.destroy', $u->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar unidad?')">
                                <i class="ri-delete-bin-line"></i>
                            </button>
                        </form>
                    </td>
                </tr>

                {{-- Modal Editar Unidad --}}
                @include('unidades.edit', ['unidad' => $u, 'proveedores' => $proveedores])

                @empty
                <tr>
                    <td colspan="8" class="text-center text-muted">No hay unidades registradas</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-3">
            {{ $unidades->links() }}
        </div>
    </div>
</div>

@endsection
