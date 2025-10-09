<!-- Modal Crear Rol -->
<div class="modal fade" id="createRoleModal" tabindex="-1" aria-labelledby="createRoleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('roles.store') }}" method="POST" class="modal-content">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="createRoleModalLabel">Nuevo Rol</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>

            <div class="modal-body">
                {{-- Nombre del Rol --}}
                <div class="mb-3">
                    <label for="role_name" class="form-label">Nombre del Rol</label>
                    <input 
                        type="text" 
                        name="name" 
                        id="role_name" 
                        class="form-control" 
                        placeholder="Ejemplo: Supervisor, Administrador, Logística" 
                        required>
                </div>

                {{-- Permisos --}}
                <div class="mb-3">
                    <label class="form-label">Permisos disponibles</label>
                    <div class="border rounded p-2" style="max-height: 220px; overflow-y: auto;">
                        <div class="row">
                            @foreach($permissions as $permission)
                                <div class="col-6 col-md-4 mb-1">
                                    <div class="form-check">
                                        <input 
                                            type="checkbox" 
                                            name="permissions[]" 
                                            value="{{ $permission->id }}" 
                                            class="form-check-input" 
                                            id="perm_{{ $permission->id }}">
                                        <label for="perm_{{ $permission->id }}" class="form-check-label">
                                            {{ $permission->name }}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <small class="text-muted">Selecciona uno o más permisos para este rol.</small>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="ri-close-circle-line"></i> Cancelar
                </button>
                <button type="submit" class="btn btn-primary">
                    <i class="ri-save-3-line"></i> Guardar Rol
                </button>
            </div>
        </form>
    </div>
</div>