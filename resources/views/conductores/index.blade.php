@extends('layouts.plantilla')

@section('title','Conductores')

@section('content')

@include('conductores.create')

<div class="page-title-box d-sm-flex align-items-center justify-content-between">
    <h4 class="mb-sm-0">Gestión de Conductores</h4>
    <div class="page-title-right">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="javascript: void(0);">Conductores</a></li>
            <li class="breadcrumb-item active">Gestión de Conductores</li>
        </ol>
    </div>
</div>

<button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalCreateConductor">
    <i class="ri-add-circle-line"></i> Nuevo Registro
</button>

<div class="card mt-3">
    <div class="card-body table-responsive">
        <table class="table table-striped align-middle text-center">
            <thead class="table-dark">
                <tr>
                    <th>DNI</th>
                    <th>Licencia</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Teléfono</th>
                    <th>Unidad</th>
                    <th width="120">Acciones</th>
                </tr>
            </thead>

            <tbody>
                @forelse($conductores as $c)
                <tr>
                    <td>{{ $c->dni }}</td>
                    <td>{{ $c->licencia }}</td>
                    <td>{{ $c->nombres }}</td>
                    <td>{{ $c->apellidos }}</td>
                    <td>{{ $c->telefono }}</td>
                    <td>
                        @forelse ($c->unidades as $u)
                            <span class="badge bg-primary">{{ $u->placa_tracto }}</span>
                        @empty
                            —
                        @endforelse
                    </td>

                    <td class="text-center">
                        <button class="btn btn-sm btn-warning"
                                data-bs-toggle="modal"
                                data-bs-target="#modalEditConductor{{ $c->id }}">
                            <i class="ri-edit-line"></i>
                        </button>

                        <form action="{{ route('conductores.destroy', $c->id) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar registro?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">
                                <i class="ri-delete-bin-line"></i>
                            </button>
                        </form>
                    </td>
                </tr>

                {{-- Modal de edición --}}
                @include('conductores.edit', ['conductor' => $c])

                @empty
                <tr>
                    <td colspan="7" class="text-center text-muted">No hay registros disponibles</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-3">
            {{ $conductores->links() }}
        </div>
    </div>
</div>

@endsection
