<!-- Modal Ver Adelanto -->
<div class="modal fade" id="showAdelantoModal" tabindex="-1" aria-labelledby="showAdelantoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">

            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="showAdelantoModalLabel">
                    <i class="ri-file-list-3-line"></i> Detalle del Adelanto
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>

            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold">N° Factura / Expediente</label>
                        <input type="text" id="show_numero_factura" class="form-control" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Monto de Adelanto (S/)</label>
                        <input type="text" id="show_monto_adelanto" class="form-control" readonly>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Fecha de Pago</label>
                        <input type="text" id="show_fecha_pago_adelantos" class="form-control" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Conformidad</label>
                        <input type="text" id="show_conformidad_adelanto" class="form-control" readonly>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Notas / Observaciones</label>
                    <textarea id="show_notas" class="form-control" rows="3" readonly></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Razón Social Transporte</label>
                    <input type="text" id="show_razon_social" class="form-control" readonly>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Conductor</label>
                    <input type="text" id="show_conductor" class="form-control" readonly>
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="ri-close-circle-line"></i> Cerrar
                </button>
                <button 
                    class="btn btn-warning"
                    data-bs-toggle="modal"
                    data-bs-target="#editAdelantoModal"
                    id="btnAbrirEditar"
                >
                    <i class="ri-edit-2-line"></i> Editar
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Script: Carga datos en el modal de visualización -->
<script>
const showModal = document.getElementById('showAdelantoModal');
showModal.addEventListener('show.bs.modal', event => {
    const button = event.relatedTarget;

    // Rellenar los campos con los datos del botón
    document.getElementById('show_numero_factura').value = button.getAttribute('data-numero') || '-';
    document.getElementById('show_monto_adelanto').value = button.getAttribute('data-monto') || '-';
    document.getElementById('show_fecha_pago_adelantos').value = button.getAttribute('data-fecha') || '-';
    document.getElementById('show_conformidad_adelanto').value = button.getAttribute('data-conformidad') || '-';
    document.getElementById('show_notas').value = button.getAttribute('data-notas') || '-';
    document.getElementById('show_razon_social').value = button.getAttribute('data-razon') || '-';
    document.getElementById('show_conductor').value = button.getAttribute('data-conductor') || '-';

    // Configurar el botón de editar con los mismos datos
    const id = button.getAttribute('data-id');
    const btnEditar = document.getElementById('btnAbrirEditar');
    btnEditar.setAttribute('data-id', id);
    btnEditar.setAttribute('data-numero', button.getAttribute('data-numero'));
    btnEditar.setAttribute('data-monto', button.getAttribute('data-monto'));
    btnEditar.setAttribute('data-fecha', button.getAttribute('data-fecha'));
    btnEditar.setAttribute('data-notas', button.getAttribute('data-notas'));
});
</script>

<!-- Script: Cierra el modal de visualización antes de abrir el de edición -->
<script>
document.getElementById('btnAbrirEditar').addEventListener('click', function() {
    const showModalEl = document.getElementById('showAdelantoModal');
    const modalInstance = bootstrap.Modal.getInstance(showModalEl);
    if (modalInstance) modalInstance.hide();
});
</script>
