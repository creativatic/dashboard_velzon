<!-- Modal Crear Expediente -->
<div class="modal fade" id="createExpedienteModal" tabindex="-1" aria-labelledby="createExpedienteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <form action="{{ route('expediente.store') }}" method="POST" class="modal-content" enctype="multipart/form-data">
            @csrf

            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="createExpedienteModalLabel">
                    <i class="ri-file-add-line"></i> Registrar Expediente
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>

            <div class="modal-body">
                <!-- === Datos base del Programacion === -->
                <h6 class="text-primary mb-3">📋 Datos de la Programación</h6>
                <div class="row g-3">
                    <input type="hidden" name="programacion_id" id="programacion_id">

                    <div class="col-md-3">
                        <label class="form-label">N° Guía Remisión</label>
                        <input type="text" id="guia_remision" class="form-control" readonly>
                        <input type="hidden" name="guia_remision" id="guia_remision_hidden">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Placa Tracto</label>
                        <input type="text" id="placa_tracto" class="form-control" readonly>
                        <input type="hidden" name="placa_tracto" id="placa_tracto_hidden">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Tipo Mineral</label>
                        <input type="text" id="tipo_mineral" class="form-control" readonly>
                        <input type="hidden" name="tipo_mineral" id="tipo_mineral_hidden">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Frente</label>
                        <input type="text" class="form-control" id="frente" readonly>
                        <input type="hidden" name="frente" id="frente_hidden">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Razón Social</label>
                        <input type="text" class="form-control" id="razon_social" readonly>
                        <input type="hidden" name="razon_social_transporte" id="razon_social_hidden">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">RUC</label>
                        <input type="text" class="form-control" id="ruc" readonly>
                        <input type="hidden" name="ruc_transporte" id="ruc_hidden">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Conductor</label>
                        <input type="text" class="form-control" id="apellidos_conductor" readonly>
                        <input type="hidden" name="apellidos_conductor" id="apellidos_conductor_hidden">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Teléfono</label>
                        <input type="text" class="form-control" id="telefono" readonly>
                        <input type="hidden" name="telefono_conductor" id="telefono_hidden">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Cuenta Banco</label>
                        <input type="text" class="form-control" id="cuenta_banco" readonly>
                        <input type="hidden" name="cuenta_banco" id="cuenta_banco_hidden">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Banco</label>
                        <input type="text" class="form-control" id="banco" readonly>
                        <input type="hidden" name="banco" id="banco_hidden">
                    </div>
                </div>

                <hr class="my-4">

                <!-- === Datos de Expediente === -->
                <h6 class="text-primary mb-3">📑 Datos del Expediente</h6>
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Número de Ticket (Tisur)</label>
                        <select name="tisur_id" id="tisur_id" class="form-select" required>
                            <option value="">-- Seleccione un ticket --</option>
                            @foreach($tisurs as $tisur)
                                <option value="{{ $tisur->id }}">{{ $tisur->numero_ticket }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Fecha de Carga</label>
                        <input type="date" name="fecha_carga" class="form-control">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Fecha de Pago</label>
                        <input type="date" name="fecha_pago" class="form-control">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Total</label>
                        <input type="number" step="0.01" name="total" class="form-control">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Detracción</label>
                        <input type="number" step="0.01" name="detraccion" class="form-control">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Depósito a Proveer</label>
                        <input type="number" step="0.01" name="deposito_a_proveer" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">N° Factura</label>
                        <input type="text" name="numero_factura_exped" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Archivo (PDF / Imagen / Word)</label>
                        <input type="file" name="archivo[]" class="form-control" multiple>
                    </div>

                    <div class="col-12">
                        <label class="form-label">Comentarios</label>
                        <textarea name="comentarios" class="form-control" rows="2"></textarea>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-success">Guardar Expediente</button>
            </div>
        </form>
    </div>
</div>

<!-- === Script para cargar datos desde Programación === -->
<script>
function cargarDatosExpediente(id) {
    fetch(`/programacion/${id}`)
        .then(response => {
            if (!response.ok) throw new Error("Error al obtener los datos de la programación");
            return response.json();
        })
        .then(programacion => {
            console.log("✅ Datos recibidos:", programacion);

            const detalle = programacion.detalle_programacion ?? {};
            const frenteValue = detalle.frente ?? '';

            // Asignación de valores a los campos visibles
            document.getElementById('programacion_id').value = programacion.id ?? '';
            document.getElementById('guia_remision').value = programacion.guia_remision ?? '';
            document.getElementById('placa_tracto').value = programacion.placa_tracto ?? '';
            document.getElementById('tipo_mineral').value = programacion.tipo_mineral ?? '';
            document.getElementById('frente').value = frenteValue;
            document.getElementById('razon_social').value = programacion.razon_social_transporte ?? '';
            document.getElementById('ruc').value = programacion.ruc_transporte ?? '';
            document.getElementById('apellidos_conductor').value = programacion.apellidos_conductor ?? '';
            document.getElementById('telefono').value = programacion.telefono_conductor ?? '';
            document.getElementById('cuenta_banco').value = programacion.cuenta_banco ?? '';
            document.getElementById('banco').value = programacion.banco ?? '';

            // Asignación de valores a los hidden
            document.getElementById('guia_remision_hidden').value = programacion.guia_remision ?? '';
            document.getElementById('placa_tracto_hidden').value = programacion.placa_tracto ?? '';
            document.getElementById('tipo_mineral_hidden').value = programacion.tipo_mineral ?? '';
            document.getElementById('frente_hidden').value = frenteValue;
            document.getElementById('razon_social_hidden').value = programacion.razon_social_transporte ?? '';
            document.getElementById('ruc_hidden').value = programacion.ruc_transporte ?? '';
            document.getElementById('apellidos_conductor_hidden').value = programacion.apellidos_conductor ?? '';
            document.getElementById('telefono_hidden').value = programacion.telefono_conductor ?? '';
            document.getElementById('cuenta_banco_hidden').value = programacion.cuenta_banco ?? '';
            document.getElementById('banco_hidden').value = programacion.banco ?? '';
        })
        .catch(error => console.error("❌ Error al cargar datos:", error));
}
</script>
