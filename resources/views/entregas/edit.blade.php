<!-- Modal Editar Entrega -->
<div class="modal fade" id="editEntregaModal" tabindex="-1" aria-labelledby="editEntregaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered"> {{-- ✅ Aumentamos a "modal-lg" para mejor espacio --}}
        <form action="{{ route('entregas.update', 0) }}" method="POST" class="modal-content" id="formEditEntrega">
            @csrf
            @method('PUT')

            <div class="modal-header bg-warning text-white">
                <h5 class="modal-title text-white mb-3">Editar Entrega / Registrar Devolución</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <input type="hidden" name="id" id="edit_id">
                <input type="hidden" id="edit_persona_id"> <!-- ✅ añadimos para saber a quién recargar -->

                <div class="mb-3">
                    <label class="form-label">Persona</label>
                    <input type="text" class="form-control" id="edit_persona" readonly>
                </div>

                <div class="row">
                    <div class="col-md-8 mb-3">
                        <label class="form-label">EPP</label>
                        <input type="text" class="form-control" id="edit_epp" readonly>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Unidad de Medida</label> {{-- ✅ Campo agregado --}}
                        <input type="text" class="form-control" id="edit_unidad_medida" readonly>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">N° de Vale</label>
                        <input type="text" id="edit_numero_vale" name="numero_vale" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Orden de Trabajo</label>
                        <input type="text" id="edit_orden_trabajo" name="orden_trabajo" class="form-control">
                    </div>
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
                    <input type="date" class="form-control" name="fecha_devolucion" id="edit_fecha_devolucion" 
                        min="{{ date('Y-m-d') }}" max="{{ date('Y-m-d') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Observación</label>
                    <textarea name="observacion" class="form-control" id="edit_observacion"></textarea>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="btnAtrasEdit">Atrás</button>
                <button type="submit" class="btn btn-warning">Guardar Cambios</button>
            </div>
        </form>
    </div>
</div>

<script>
/**
 * Refresca los datos del modal "Ver Entregas"
 */
function recargarEntregasPersona(personaId) {
    fetch(`/entregas/persona/${personaId}`)
        .then(res => res.text())
        .then(html => {
            document.getElementById('contenedorEntregasPersona').innerHTML = html;
        });
}

/**
 * 💾 Guardar cambios (editar entrega)
 */
document.getElementById('formEditEntrega').addEventListener('submit', function(e) {
    e.preventDefault();
    const id = document.getElementById('edit_id').value;
    const personaId = document.getElementById('edit_persona_id').value;
    const personaNombre = document.getElementById('edit_persona').value; 
    
    const formData = new FormData(this);
    formData.append('_method', 'PUT');

    fetch(`/entregas/${id}`, {
        method: 'POST',
        headers: { 'X-Requested-With': 'XMLHttpRequest' },
        body: formData
    }).then(res => {
        if (!res.ok) throw new Error('Error en la respuesta del servidor');
        return res.json();
    })
    .then(() => {
        const modalEdit = bootstrap.Modal.getInstance(document.getElementById('editEntregaModal'));
        if(modalEdit) modalEdit.hide();

        if (typeof verEntregasPersona === 'function') {
            verEntregasPersona(personaId, personaNombre);
        } else {
            console.error("verEntregasPersona no está definida.");
        }

        new bootstrap.Modal(document.getElementById('showEntregaModal')).show();
    })
    .catch(error => {
        console.error("Error al actualizar la entrega:", error);
        alert('❌ Ocurrió un error al guardar los cambios: ' + error.message);
        new bootstrap.Modal(document.getElementById('showEntregaModal')).show();
    });
});

/**
 * ⏪ Botón Atrás ➜ vuelve al modal de entregas (show)
 */
document.getElementById('btnAtrasEdit').addEventListener('click', () => {
    const personaId = document.getElementById('edit_persona_id').value;
    const personaNombre = document.getElementById('edit_persona').value;

    const modalEdit = bootstrap.Modal.getInstance(document.getElementById('editEntregaModal'));
    if(modalEdit) modalEdit.hide();

    if (typeof verEntregasPersona === 'function') {
        verEntregasPersona(personaId, personaNombre);
    }

    new bootstrap.Modal(document.getElementById('showEntregaModal')).show();
});
</script>
