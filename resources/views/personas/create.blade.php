<!-- Modal Crear Persona -->
<div class="modal fade" id="createPersonaModal" tabindex="-1" aria-labelledby="createPersonaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <form action="{{ route('personas.store') }}" method="POST" class="modal-content">
            @csrf

            <div class="modal-header bg-success text-white">
                <h5 class="modal-title text-white mb-3" id="createPersonaModalLabel">Agregar Personal</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>


            <div class="modal-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">DNI</label>
                        <input type="text" name="dni" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Apellidos y Nombres</label>
                        <input type="text" name="nombres" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Especialidad</label>
                        <input type="text" name="cargo" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Área</label>
                        <input type="text" name="area" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Estado</label>
                        <select name="estado" class="form-select">
                            <option value="1" selected>Activo</option>
                            <option value="0">Inactivo</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
    </div>
</div>
