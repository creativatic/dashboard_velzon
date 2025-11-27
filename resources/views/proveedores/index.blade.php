@extends('layouts.plantilla')

@section('title','Proveedores')

@section('content')

{{-- Modal Crear --}}
@include('proveedores.create')

<div class="page-title-box d-sm-flex align-items-center justify-content-between">
    <h4 class="mb-sm-0">Gestión de Proveedores</h4>
    <div class="page-title-right">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="javascript:void(0);">Proveedores</a></li>
            <li class="breadcrumb-item active">Gestión de Proveedores</li>
        </ol>
    </div>
</div>

<button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalCreateProveedor">
    <i class="ri-add-circle-line"></i> Nuevo Proveedor
</button>

<div class="card mt-3">
    <div class="card-body table-responsive">
        <table class="table table-striped align-middle text-center">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Razón Social</th>
                    <th>RUC</th>
                    <th>Banco</th>
                    <th>Cuenta</th>
                    <th width="120">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($proveedores as $p)
                <tr>
                    <td>{{ $p->id }}</td>
                    <td>{{ $p->razon_social }}</td>
                    <td>{{ $p->ruc_transporte }}</td>
                    <td>{{ $p->banco }}</td>
                    <td>{{ $p->cuenta_banco }}</td>

                    <td class="text-center">
                        <button class="btn btn-sm btn-warning"
                                data-bs-toggle="modal"
                                data-bs-target="#modalEditProveedor{{ $p->id }}">
                            <i class="ri-edit-line"></i>
                        </button>

                        <form action="{{ route('proveedores.destroy', $p) }}"
                              method="POST"
                              class="d-inline">
                            @csrf @method('DELETE')
                            <button type="submit"
                                class="btn btn-sm btn-danger"
                                onclick="return confirm('¿Eliminar proveedor?')">
                                <i class="ri-delete-bin-line"></i>
                            </button>
                        </form>
                    </td>
                </tr>

                {{-- Modal Editar --}}
                @include('proveedores.edit', ['proveedor' => $p])

                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted">No hay proveedores registrados</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-3">
            {{ $proveedores->links() }}
        </div>
    </div>
</div>

@endsection

{{-- Script para evitar que los modales muestren datos viejos --}}
@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const modals = document.querySelectorAll('.modal');
        modals.forEach(modal => {
            modal.addEventListener('hidden.bs.modal', function () {
                const form = this.querySelector('form');
                if (form) form.reset();
            });
        });
    });
</script>
@endsection
