<!-- Modal Mostrar Expediente -->
<div class="modal fade" id="showExpedienteModal" tabindex="-1" aria-labelledby="showExpedienteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="showExpedienteModalLabel">
                    <i class="ri-eye-line"></i> Detalle del Expediente
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>

            <div class="modal-body">
                <h6 class="text-primary mb-3">📋 Datos de la Programación</h6>
                <div class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label fw-bold">N° Guía Remisión:</label>
                        <p id="show_guia_remision" class="form-control-plaintext"></p>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-bold">Placa Tracto:</label>
                        <p id="show_placa_tracto" class="form-control-plaintext"></p>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-bold">Tipo Mineral:</label>
                        <p id="show_tipo_mineral" class="form-control-plaintext"></p>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-bold">Frente:</label>
                        <p id="show_frente" class="form-control-plaintext"></p>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-bold">Razón Social:</label>
                        <p id="show_razon_social" class="form-control-plaintext"></p>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">RUC:</label>
                        <p id="show_ruc" class="form-control-plaintext"></p>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Conductor:</label>
                        <p id="show_conductor" class="form-control-plaintext"></p>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Teléfono:</label>
                        <p id="show_telefono" class="form-control-plaintext"></p>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Cuenta Banco:</label>
                        <p id="show_cuenta_banco" class="form-control-plaintext"></p>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Banco:</label>
                        <p id="show_banco" class="form-control-plaintext"></p>
                    </div>
                </div>

                <hr class="my-4">

                <h6 class="text-primary mb-3">📑 Datos del Expediente</h6>
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label fw-bold">N° Ticket (Tisur):</label>
                        <p id="show_tisur" class="form-control-plaintext"></p>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Fecha Carga:</label>
                        <p id="show_fecha_carga" class="form-control-plaintext"></p>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Fecha Pago:</label>
                        <p id="show_fecha_pago" class="form-control-plaintext"></p>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Total:</label>
                        <p id="show_total" class="form-control-plaintext"></p>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Detracción:</label>
                        <p id="show_detraccion" class="form-control-plaintext"></p>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Depósito a Proveer:</label>
                        <p id="show_deposito" class="form-control-plaintext"></p>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">N° Factura:</label>
                        <p id="show_factura" class="form-control-plaintext"></p>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Comentarios:</label>
                        <p id="show_comentarios" class="form-control-plaintext"></p>
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-bold">Archivos Adjuntos:</label>
                        <div id="show_archivos" class="border rounded p-2 bg-light small"></div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- === Script para mostrar datos === -->
<script>
function verExpediente(id) {
    fetch(`/expediente/${id}`)
        .then(response => {
            if (!response.ok) throw new Error("Error al obtener el expediente");
            return response.json();
        })
        .then(expediente => {
            console.log("👀 Expediente cargado:", expediente);

            const prog = expediente.programacion ?? {};
            const detalle = prog.detalle_programacion ?? {};

            // Programación
            document.getElementById('show_guia_remision').textContent = prog.guia_remision ?? '-';
            document.getElementById('show_placa_tracto').textContent = prog.placa_tracto ?? '-';
            document.getElementById('show_tipo_mineral').textContent = prog.tipo_mineral ?? '-';
            document.getElementById('show_frente').textContent = detalle.frente ?? '-';
            document.getElementById('show_razon_social').textContent = prog.razon_social_transporte ?? '-';
            document.getElementById('show_ruc').textContent = prog.ruc_transporte ?? '-';
            document.getElementById('show_conductor').textContent = prog.apellidos_conductor ?? '-';
            document.getElementById('show_telefono').textContent = prog.telefono_conductor ?? '-';
            document.getElementById('show_cuenta_banco').textContent = prog.cuenta_banco ?? '-';
            document.getElementById('show_banco').textContent = prog.banco ?? '-';

            // Expediente
            document.getElementById('show_tisur').textContent = expediente.tisur?.numero_ticket ?? '-';
            document.getElementById('show_fecha_carga').textContent = expediente.fecha_carga ?? '-';
            document.getElementById('show_fecha_pago').textContent = expediente.fecha_pago ?? '-';
            document.getElementById('show_total').textContent = expediente.total ?? '-';
            document.getElementById('show_detraccion').textContent = expediente.detraccion ?? '-';
            document.getElementById('show_deposito').textContent = expediente.deposito_a_proveer ?? '-';
            document.getElementById('show_factura').textContent = expediente.numero_factura_exped ?? '-';
            document.getElementById('show_comentarios').textContent = expediente.comentarios ?? '-';

            // Archivos
            const archivosDiv = document.getElementById('show_archivos');
            archivosDiv.innerHTML = '';
            if (expediente.archivo && Array.isArray(JSON.parse(expediente.archivo))) {
                JSON.parse(expediente.archivo).forEach(file => {
                    const link = document.createElement('a');
                    link.href = `/storage/${file}`;
                    link.target = '_blank';
                    link.textContent = file.split('/').pop();
                    link.classList.add('d-block');
                    archivosDiv.appendChild(link);
                });
            } else {
                archivosDiv.textContent = 'Sin archivos adjuntos.';
            }

            // Mostrar modal
            new bootstrap.Modal(document.getElementById('showExpedienteModal')).show();
        })
        .catch(error => console.error("❌ Error al cargar expediente:", error));
}
</script>
