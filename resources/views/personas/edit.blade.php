<!-- Modal Editar Persona -->
<div class="modal fade" id="editPersonaModal" tabindex="-1" aria-labelledby="editPersonaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <form id="editPersonaForm" method="POST" class="modal-content">
            @csrf
            @method('PUT')

            <!-- Encabezado -->
            <div class="modal-header bg-warning text-white">
                <h5 class="modal-title text-white mb-3" id="editPersonaModalLabel">Editar Personal</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>

            <!-- Cuerpo -->
            <div class="modal-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Nombres y Apellidos</label>
                        <input type="text" name="nombres" id="edit_nombres" class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">DNI</label>
                        <input type="text" name="dni" id="edit_dni" class="form-control" maxlength="8" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Cargo</label>
                        <input type="text" name="cargo" id="edit_cargo" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Área</label>
                        <input type="text" name="area" id="edit_area" class="form-control">
                    </div>

                    <!-- 🔹 Switch de estado (igual que en EPP) -->
                    <div class="col-md-6">
                        <label class="form-label">Estado</label>
                        <div class="form-check form-switch mt-2">
                            <input type="hidden" name="estado" value="0"> {{-- Enviará 0 si está desactivado --}}
                            <input class="form-check-input" type="checkbox" id="edit_estado" name="estado" value="1">
                            <label class="form-check-label" for="edit_estado">Activo</label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pie -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-warning text-white">Actualizar</button>
            </div>
        </form>
    </div>
</div>

<script>
/**
 * 🧩 Cargar los datos de la persona en el modal de edición
 */
function cargarDatosPersona(persona) {
    document.getElementById('edit_nombres').value = persona.nombres;
    document.getElementById('edit_dni').value = persona.dni;
    document.getElementById('edit_cargo').value = persona.cargo ?? '';
    document.getElementById('edit_area').value = persona.area ?? '';

    // ✅ Cambiar estado visual del switch
    document.getElementById('edit_estado').checked = persona.estado == 1;

    // ✅ Actualizar la acción del formulario
    const form = document.getElementById('editPersonaForm');
    form.action = `/personas/${persona.id}`;
}
</script>
