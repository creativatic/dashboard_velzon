<!-- Modal Editar Rol -->
<div class="modal fade" id="editRoleModal" tabindex="-1" aria-labelledby="editRoleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-warning text-dark">
                <h5 class="modal-title" id="editRoleModalLabel">Editar Rol</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <form id="editRoleForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_role_name" class="form-label">Nombre del Rol</label>
                        <input type="text" name="name" id="edit_role_name" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Permisos</label>
                        <div class="row" id="edit-permissions-container">
                            @foreach($permissions as $permission)
                                <div class="col-6">
                                    <div class="form-check">
                                        <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" class="form-check-input edit-permission" id="edit_perm_{{ $permission->id }}">
                                        <label for="edit_perm_{{ $permission->id }}" class="form-check-label">{{ $permission->name }}</label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-warning">Actualizar Rol</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Cargar datos del rol en el modal de edición
    function openEditRoleModal(role) {
        document.getElementById('edit_role_name').value = role.name;
        document.getElementById('editRoleForm').action = `/roles/${role.id}`;
        
        // Limpiar permisos previos
        document.querySelectorAll('.edit-permission').forEach(cb => cb.checked = false);

        // Activar los permisos del rol
        role.permissions.forEach(perm => {
            const checkbox = document.getElementById(`edit_perm_${perm.id}`);
            if (checkbox) checkbox.checked = true;
        });

        const modal = new bootstrap.Modal(document.getElementById('editRoleModal'));
        modal.show();
    }
</script>