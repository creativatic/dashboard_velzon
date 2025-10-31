<!-- Modal Editar Frente -->
<div class="modal fade" id="editFrenteModal" tabindex="-1" aria-labelledby="editFrenteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="editFrenteForm" method="POST" class="modal-content">
            @csrf
            @method('PUT')

            <div class="modal-header">
                <h5 class="modal-title" id="editFrenteModalLabel">Editar Frente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>

            <div class="modal-body">
                <input type="hidden" id="edit_frente_id" name="id">

                {{-- Frente --}}
                <div class="mb-3">
                    <label for="edit_frente" class="form-label">Frente</label>
                    <input type="text" name="frente" id="edit_frente" class="form-control" required>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="edit_precio_frente" class="form-label">Precio Frente (S/)</label>
                        <input type="number" step="0.01" name="precio_frente" id="edit_precio_frente" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="edit_precio_tn" class="form-label">Precio TN (S/)</label>
                        <input type="number" step="0.0001" name="precio_tn" id="edit_precio_tn" class="form-control" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="edit_descripcion" class="form-label">Descripción</label>
                    <textarea name="descripcion" id="edit_descripcion" class="form-control" rows="3"></textarea>
                </div>

               <div class="form-check form-switch mb-3">
                    <input class="form-check-input" type="checkbox" id="edit_activo" name="activo" value="1" {{ old('activo', isset($detalle) ? $detalle->activo : true) ? 'checked' : '' }}>
                    <label class="form-check-label" for="edit_activo">Activo</label>
                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="ri-close-circle-line"></i> Cancelar
                </button>
                <button type="submit" class="btn btn-success">
                    <i class="ri-check-line"></i> Actualizar
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function openEditFrenteModal(detalle) {
    const form = document.getElementById('editFrenteForm');

    // 🔧 Forzar el action exacto con el ID
    form.action = "{{ url('detalleprogramacion') }}/" + detalle.id;

    // Llenar datos
    document.getElementById('edit_frente_id').value = detalle.id;
    document.getElementById('edit_frente').value = detalle.frente;
    document.getElementById('edit_precio_frente').value = detalle.precio_frente;
    document.getElementById('edit_precio_tn').value = detalle.precio_tn;
    document.getElementById('edit_descripcion').value = detalle.descripcion || '';
    document.getElementById('edit_activo').checked = !!detalle.activo;

    // Mostrar modal
    new bootstrap.Modal(document.getElementById('editFrenteModal')).show();
}
</script>
