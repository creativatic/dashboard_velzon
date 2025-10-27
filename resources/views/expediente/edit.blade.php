<!-- Modal Editar Expediente -->
<div class="modal fade" id="editExpedienteModal" tabindex="-1" aria-labelledby="editExpedienteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <form id="formEditExpediente" method="POST" enctype="multipart/form-data" class="modal-content">
            @csrf
            @method('PUT')

            <div class="modal-header bg-warning text-dark">
                <h5 class="modal-title" id="editExpedienteModalLabel">
                    <i class="ri-edit-2-line"></i> Editar Expediente
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>

            <div class="modal-body">
                <!-- === Datos base del Programacion === -->
                <h6 class="text-primary mb-3">📋 Datos de la Programación</h6>
                <div class="row g-3">
                    <input type="hidden" name="programacion_id" id="edit_programacion_id">
                    <div class="col-md-3">
                        <label class="form-label">N° Guía Remisión</label>
                        <input type="text" id="edit_guia_remision" class="form-control" readonly>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Placa Tracto</label>
                        <input type="text" id="edit_placa_tracto" class="form-control" readonly>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Tipo Mineral</label>
                        <input type="text" id="edit_tipo_mineral" class="form-control" readonly>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Frente</label>
                        <input type="text" id="edit_frente" class="form-control" readonly>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Razón Social</label>
                        <input type="text" id="edit_razon_social" class="form-control" readonly>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">RUC</label>
                        <input type="text" id="edit_ruc" class="form-control" readonly>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Conductor</label>
                        <input type="text" id="edit_apellidos_conductor" class="form-control" readonly>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Teléfono</label>
                        <input type="text" id="edit_telefono" class="form-control" readonly>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Cuenta Banco</label>
                        <input type="text" id="edit_cuenta_banco" class="form-control" readonly>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Banco</label>
                        <input type="text" id="edit_banco" class="form-control" readonly>
                    </div>
                </div>

                <hr class="my-4">

                <!-- === Datos de Expediente === -->
                <h6 class="text-primary mb-3">📑 Datos del Expediente</h6>
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Número de Ticket (Tisur)</label>
                        <input type="text" id="edit_numero_ticket" class="form-control" readonly>
                        <input type="hidden" name="tisur_id" id="edit_tisur_id">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Fecha de Carga</label>
                        <input type="date" name="fecha_carga" id="edit_fecha_carga" class="form-control">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Fecha de Pago</label>
                        <input type="date" name="fecha_pago" id="edit_fecha_pago" class="form-control">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Total</label>
                        <input type="number" step="0.01" name="total" id="edit_total" class="form-control">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Detracción</label>
                        <input type="number" step="0.01" name="detraccion" id="edit_detraccion" class="form-control">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Depósito a Proveer</label>
                        <input type="number" step="0.01" name="deposito_a_proveer" id="edit_deposito_a_proveer" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">N° Factura</label>
                        <input type="text" name="numero_factura_exped" id="edit_numero_factura_exped" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Archivo (PDF / Imagen / Word)</label>
                        <input type="file" name="archivo[]" id="edit_archivo" class="form-control" multiple>
                        <div id="archivo_actual" class="mt-2"></div>
                    </div>

                    <div class="col-12">
                        <label class="form-label">Comentarios</label>
                        <textarea name="comentarios" id="edit_comentarios" class="form-control" rows="2"></textarea>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-warning text-dark fw-bold">Actualizar</button>
            </div>
        </form>
    </div>
</div>

<!-- === Script para cargar datos en el modal === -->
<script>
function editarExpediente(id) {
    // 💡 SOLUCIÓN: Hacemos una petición a la ruta 'edit' añadiendo headers para que Laravel devuelva JSON.
    fetch(`/expediente/${id}/edit`, {
        method: 'GET',
        headers: {
            'X-Requested-With': 'XMLHttpRequest', // Esto hace que request()->ajax() en Laravel sea true
            'Accept': 'application/json'          // Solicitamos específicamente una respuesta JSON
        }
    })
    .then(response => {
        if (!response.ok) {
            console.error(`Error HTTP! status: ${response.status}`);
            throw new Error('Error al obtener el expediente para editar.');
        }
        return response.json(); // Parsea la respuesta JSON que retorna ExpedienteController@edit
    })
    .then(expediente => {
        console.log("📦 Expediente para editar cargado:", expediente);

        // --- Cargar Datos de Programación (ReadOnly) ---
        const prog = expediente.programacion ?? {};
        // Asegúrate de acceder a 'detalleProgramacion' (como en el with) o 'detalle_programacion' (como en el JSON)
        // Usaremos 'detalleProgramacion' que es el nombre de la relación en el controlador
        const detalle = prog.detalle_programacion ?? prog.detalle_programacion ?? {}; 

        // ⚠️ Asegúrate de que este campo exista en el modal de edición si lo necesitas
        document.getElementById('edit_programacion_id').value = expediente.programacion_id ?? ''; 
        
        document.getElementById('edit_guia_remision').value = prog.guia_remision ?? '-';
        document.getElementById('edit_placa_tracto').value = prog.placa_tracto ?? '-';
        document.getElementById('edit_tipo_mineral').value = prog.tipo_mineral ?? '-';
        document.getElementById('edit_frente').value = detalle.frente ?? '-';
        document.getElementById('edit_razon_social').value = prog.razon_social_transporte ?? '-';
        document.getElementById('edit_ruc').value = prog.ruc_transporte ?? '-';
        document.getElementById('edit_apellidos_conductor').value = prog.apellidos_conductor ?? '-';
        document.getElementById('edit_telefono').value = prog.telefono_conductor ?? '-';
        document.getElementById('edit_cuenta_banco').value = prog.cuenta_banco ?? '-';
        document.getElementById('edit_banco').value = prog.banco ?? '-';

        // --- Cargar Datos del Expediente ---
        document.getElementById('edit_tisur_id').value = expediente.tisur_id ?? '';
        document.getElementById('edit_numero_ticket').value = expediente.tisur?.numero_ticket ?? '';
        document.getElementById('edit_fecha_carga').value = expediente.fecha_carga ?? '';
        document.getElementById('edit_fecha_pago').value = expediente.fecha_pago ?? '';
        document.getElementById('edit_total').value = expediente.total ?? '';
        document.getElementById('edit_detraccion').value = expediente.detraccion ?? '';
        document.getElementById('edit_deposito_a_proveer').value = expediente.deposito_a_proveer ?? '';
        document.getElementById('edit_numero_factura_exped').value = expediente.numero_factura_exped ?? '';
        document.getElementById('edit_comentarios').value = expediente.comentarios ?? '';

        // --- Mostrar archivo actual ---
        let archivoDiv = document.getElementById('archivo_actual');
        archivoDiv.innerHTML = '<small class="text-muted">No hay archivos cargados.</small>'; // Default
        
        if (expediente.archivo) {
            let archivos = [];
            try { 
                // Intenta parsear como JSON array (comportamiento del store)
                archivos = JSON.parse(expediente.archivo); 
            } catch (e) {
                // Si falla, asume que es un string simple (comportamiento del update)
                archivos = [expediente.archivo];
            }
            
            if (Array.isArray(archivos) && archivos.length > 0) {
                archivoDiv.innerHTML = archivos.filter(f => f).map(f => `
                    <a href="/storage/${f}" target="_blank" class="d-block text-primary mt-1">
                        <i class="ri-file-line"></i> ${f.split('/').pop()}
                    </a>
                `).join('');
            }
        }

        // --- Actualizar ruta del formulario ---
        document.getElementById('formEditExpediente').action = `/expediente/${expediente.id}`;
        
        // El modal ya se abre con data-bs-toggle en el botón, no es necesario abrirlo aquí.
    })
    .catch(error => {
        console.error("❌ Error al cargar expediente:", error);
        alert('No se pudo cargar la información del expediente para editar. Verifique la consola para detalles.');
    });
}
</script>