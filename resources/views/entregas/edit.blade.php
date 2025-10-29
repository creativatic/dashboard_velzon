<!-- Modal Editar Entrega -->
<div class="modal fade" id="editEntregaModal" tabindex="-1" aria-labelledby="editEntregaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form action="{{ route('entregas.update', 0) }}" method="POST" class="modal-content" id="formEditEntrega">
            @csrf
            @method('PUT')

            <div class="modal-header bg-warning text-dark">
                <h5 class="modal-title">Editar Entrega / Registrar Devolución</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <input type="hidden" name="id" id="edit_id">

                <div class="mb-3">
                    <label class="form-label">Persona</label>
                    <input type="text" class="form-control" id="edit_persona" readonly>
                </div>

                <div class="mb-3">
                    <label class="form-label">EPP</label>
                    <input type="text" class="form-control" id="edit_epp" readonly>
                </div>

                <div class="mb-3">
                    <label class="form-label">Cantidad</label>
                    <input type="number" class="form-control" name="cantidad" id="edit_cantidad" min="1" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Fecha de Entrega</label>
                    <input type="date" class="form-control" name="fecha_entrega" id="edit_fecha_entrega" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Fecha de Devolución</label>
                    <input type="date" class="form-control" name="fecha_devolucion" id="edit_fecha_devolucion">
                </div>

                <div class="mb-3">
                    <label class="form-label">Observación</label>
                    <textarea name="observacion" class="form-control" id="edit_observacion"></textarea>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-warning">Guardar Cambios</button>
            </div>
        </form>
    </div>
</div>

<script>
document.getElementById('formEditEntrega').addEventListener('submit', function(e) {
    e.preventDefault();
    const id = document.getElementById('edit_id').value;
    const formData = new FormData(this);

    fetch(`/entregas/${id}`, {
        method: 'POST',
        body: formData
    }).then(() => location.reload());
});
</script>
