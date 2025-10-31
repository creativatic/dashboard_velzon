<!-- Modal Editar Adelanto -->
<div class="modal fade" id="editAdelantoModal" tabindex="-1" aria-labelledby="editAdelantoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="editAdelantoForm" method="POST" class="modal-content">
            @csrf
            @method('PUT')

            <div class="modal-header">
                <h5 class="modal-title" id="editAdelantoModalLabel">Editar Adelanto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>

            <div class="modal-body">
                {{-- ID oculto --}}
                <input type="hidden" id="edit_programacion_id" name="id">

                {{-- Número de factura (solo lectura) --}}
                <div class="mb-3">
                    <label for="edit_numero_factura" class="form-label">N° Factura / Expediente</label>
                    <input type="text" id="edit_numero_factura" class="form-control" readonly>
                </div>

                {{-- Monto de adelanto (solo lectura) --}}
                <div class="mb-3">
                    <label for="edit_monto_adelanto" class="form-label">Monto de Adelanto (S/)</label>
                    <input type="number" id="edit_monto_adelanto" class="form-control" readonly>
                </div>

                {{-- Fecha de pago Adelanto --}}
                <div class="mb-3">
                    <label for="edit_fecha_pago_adelantos" class="form-label">Fecha de Pago Adelant</label>
                    <input type="date" name="fecha_pago_adelantos" id="edit_fecha_pago_adelantos" class="form-control">
                </div>
                
                {{-- Fecha de pago Expediente --}}
                <div class="mb-3">
                    <label for="edit_fecha_pago_adelantos" class="form-label">Fecha de Pago Expediente</label>
                    <input type="date" name="fecha_pago_adelantos" id="edit_fecha_pago_adelantos" class="form-control">
                </div>

                {{-- Notas --}}
                <div class="mb-3">
                    <label for="edit_notas" class="form-label">Notas / Observaciones</label>
                    <textarea name="notas" id="edit_notas" class="form-control" rows="3"></textarea>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="ri-close-circle-line"></i> Cancelar
                </button>
                <button type="submit" class="btn btn-success">
                    <i class="ri-check-line"></i> Guardar Cambios
                </button>
            </div>
        </form>
    </div>
</div>
