<!-- Modal Editar Persona -->
<div class="modal fade" id="editPersonaModal" tabindex="-1" aria-labelledby="editPersonaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <form id="editPersonaForm" method="POST" class="modal-content">
            @csrf
            @method('PUT')

            <div class="modal-header bg-warning text-white">
                <h5 class="modal-title text-white mb-3" id="editPersonaModalLabel">Editar Personal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>

            <div class="modal-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Nombres y Apellidos</label>
                        <input type="text" name="nombres" id="edit_nombres" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">DNI</label>
                        <input type="text" name="dni" id="edit_dni" class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Cargo</label>
                        <input type="text" name="cargo" id="edit_cargo" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Área</label>
                        <input type="text" name="area" id="edit_area" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Estado</label>
                        <select name="estado" id="edit_estado" class="form-select">
                            <option value="1">Activo</option>
                            <option value="0">Inactivo</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-warning">Actualizar</button>
            </div>
        </form>
    </div>
</div>

<script>
    function cargarDatosPersona(persona) {
        // Rellenar campos del modal con datos
        document.getElementById('edit_nombres').value = persona.nombres;
        document.getElementById('edit_dni').value = persona.dni;
        document.getElementById('edit_cargo').value = persona.cargo ?? '';
        document.getElementById('edit_area').value = persona.area ?? '';
        document.getElementById('edit_estado').value = persona.estado;

        // Actualizar action del formulario
        const form = document.getElementById('editPersonaForm');
        form.action = `/personas/${persona.id}`;
    }
</script>
