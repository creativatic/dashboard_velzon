<!-- Modal Editar Permiso -->
<div class="modal fade" id="editPermissionModal" tabindex="-1" aria-labelledby="editPermissionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="editPermissionForm" method="POST" class="modal-content">
            @csrf
            @method('PUT')
            <div class="modal-header">
                <h5 class="modal-title" id="editPermissionModalLabel">Editar Permiso</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="edit_permission_name" class="form-label">Nombre del Permiso</label>
                    <input type="text" name="name" id="edit_permission_name" class="form-control" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Actualizar</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openEditPermissionModal(permission) {
        const form = document.getElementById('editPermissionForm');
        form.action = `/permissions/${permission.id}`;
        document.getElementById('edit_permission_name').value = permission.name;
        new bootstrap.Modal(document.getElementById('editPermissionModal')).show();
    }
</script>