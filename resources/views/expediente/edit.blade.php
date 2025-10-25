<!-- resources/views/expediente/edit.blade.php -->
<!-- Modal Editar Expediente -->
<div class="modal fade" id="editExpedienteModal" tabindex="-1" aria-labelledby="editExpedienteLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <form id="formEditExpediente" method="POST" class="modal-content" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="editExpedienteLabel">Editar Expediente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>

            <div class="modal-body" id="modalEditBody">
                <div class="text-center w-100 py-5">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Cargando...</span>
                    </div>
                    <p class="mt-2 text-muted">Cargando datos del expediente...</p>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-success">Guardar cambios</button>
            </div>
        </form>
    </div>
</div>
