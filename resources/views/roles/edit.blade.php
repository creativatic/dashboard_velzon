<!-- Modal Editar Rol -->
<div class="modal fade" id="editRoleModal" tabindex="-1" aria-labelledby="editRoleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="editRoleForm" method="POST" class="modal-content">
            @csrf
            @method('PUT')

            <div class="modal-header">
                <h5 class="modal-title" id="editRoleModalLabel">Editar Rol</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>

            <div class="modal-body">
                {{-- Nombre del Rol --}}
                <div class="mb-3">
                    <label for="edit_role_name" class="form-label">Nombre del Rol</label>
                    <input 
                        type="text" 
                        name="name" 
                        id="edit_role_name" 
                        class="form-control" 
                        required>
                </div>

                {{-- Permisos --}}
                <div class="mb-3">
                    <label class="form-label">Permisos asignados</label>
                    <div class="border rounded p-2" style="max-height: 220px; overflow-y: auto;">
                        <div class="row">
                            @foreach($permissions as $permission)
                                <div class="col-6 col-md-4 mb-1">
                                    <div class="form-check">
                                        <input 
                                            type="checkbox" 
                                            name="permissions[]" 
                                            value="{{ $permission->id }}" 
                                            class="form-check-input edit-permission" 
                                            id="edit_perm_{{ $permission->id }}">
                                        <label for="edit_perm_{{ $permission->id }}" class="form-check-label">
                                            {{ $permission->name }}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <small class="text-muted">Selecciona los permisos que tendrá este rol.</small>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="ri-close-circle-line"></i> Cancelar
                </button>
                <button type="submit" class="btn btn-primary">
                    <i class="ri-save-3-line"></i> Actualizar Rol
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Script para llenar el modal dinámicamente -->
<script>
    function openEditRoleModal(role) {
        // Rellenar datos del formulario
        const form = document.getElementById('editRoleForm');
        form.action = `/roles/${role.id}`;

        document.getElementById('edit_role_name').value = role.name;

        // Desmarcar todos los permisos primero
        document.querySelectorAll('.edit-permission').forEach(cb => cb.checked = false);

        // Marcar los permisos del rol
        if (role.permissions) {
            role.permissions.forEach(perm => {
                const checkbox = document.querySelector(`#edit_perm_${perm.id}`);
                if (checkbox) checkbox.checked = true;
            });
        }

        // Mostrar el modal
        new bootstrap.Modal(document.getElementById('editRoleModal')).show();
    }
</script>