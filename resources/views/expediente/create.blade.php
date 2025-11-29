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

                    <div class="col-md-3">
                        <label class="form-label">Razón Social</label>
                        <input type="text" id="razon_social" class="form-control" readonly>
                        <input type="hidden" name="razon_social_transporte" id="razon_social_hidden">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">RUC</label>
                        <input type="text" id="ruc" class="form-control" readonly>
                        <input type="hidden" name="ruc_transporte" id="ruc_hidden">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Conductor</label>
                        <input type="text" class="form-control" id="apellidos_conductor" readonly>
                        <input type="hidden" name="apellidos_conductor" id="apellidos_conductor_hidden">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Costo por TN</label>
                        <input type="text" class="form-control" id="precio_tn" readonly>
                        <input type="hidden" name="precio_tn" id="precio_tn_hidden">
                    </div>


                    <div class="col-md-3">
                        <label class="form-label">Teléfono</label>
                        <input type="text" class="form-control" id="telefono" readonly>
                        <input type="hidden" name="telefono_conductor" id="telefono_hidden">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Cuenta Banco</label>
                        <input type="text" class="form-control" id="cuenta_banco" readonly>
                        <input type="hidden" name="cuenta_banco" id="cuenta_banco_hidden">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Banco</label>
                        <input type="text" class="form-control" id="banco" readonly>
                        <input type="hidden" name="banco" id="banco_hidden">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Precio Frente</label>
                        <input type="text" class="form-control" id="precio_frente" readonly>
                        <input type="hidden" name="precio_frente" id="precio_frente_hidden">
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
                        <label class="form-label">Fecha de Ingreso Tisur</label>
                        <input type="date" name="fecha_hora_ingreso" class="form-control">
                    </div>
                    
                    <div class="col-md-4">
                        <label class="form-label">Fecha de Pago</label>
                        <input type="date" name="fecha_pago" class="form-control">
                    </div>

                     <div class="col-md-4">
                        <label class="form-label">Peso Neto</label>
                        <input type="text" name="peso_neto"id="peso_neto" class="form-control">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Total</label>
                        <input type="number" step="0.01" name="total" id="total" class="form-control">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Detracción (4%)</label>
                        <input type="number" step="0.01" name="detraccion" id="detraccion" class="form-control" readonly>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Estado Pago Detracción</label>
                        <select name="estado_pago_detraccion" id="estado_pago_detraccion" class="form-select">
                            <option value="No Pagado" >No Pagado</option>
                            <option value="Pagado" selected>Pagado</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Total + Detracción</label>
                        <input type="number" step="0.01" name="total_con_detraccion" id="total_con_detraccion" class="form-control" readonly>
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
/** ===================== UTILIDADES ===================== */
function setInputValues(dataMap) {
    Object.keys(dataMap).forEach(key => {
        const elVisible = document.getElementById(key);
        const elHidden = document.getElementById(key + '_hidden');
        if(elVisible) elVisible.value = dataMap[key] ?? '';
        if(elHidden) elHidden.value = dataMap[key] ?? '';
    });
}

function formatDateToInput(dateString) {
    if(!dateString) return '';
    const d = new Date(dateString);
    if(isNaN(d)) return '';
    return `${d.getFullYear()}-${String(d.getMonth()+1).padStart(2,'0')}-${String(d.getDate()).padStart(2,'0')}`;
}

/** ===================== CÁLCULOS ===================== */
function calcularTotalesExpediente() {
    const precioTn = parseFloat(document.getElementById('precio_tn_hidden')?.value) || 0;
    const pesoNeto = parseFloat(document.getElementById('peso_neto')?.value) || 0;
    const total = precioTn * pesoNeto;

    const totalElement = document.getElementById('total');
    if(totalElement) totalElement.value = total.toFixed(2);

    const detraccion = total * 0.04;
    const detraccionElement = document.getElementById('detraccion');
    if(detraccionElement) detraccionElement.value = detraccion.toFixed(2);

    const estadoPagoDetraccion = document.getElementById('estado_pago_detraccion')?.value || 'No Pagado';
    const totalConDetraccion = (estadoPagoDetraccion === 'No Pagado') ? total - detraccion : total;
    const totalConDetraccionElement = document.getElementById('total_con_detraccion');
    if(totalConDetraccionElement) totalConDetraccionElement.value = totalConDetraccion.toFixed(2);

    const precioFrente = parseFloat(document.getElementById('precio_frente_hidden')?.value) || 0;
    const depositoAProveer = totalConDetraccion - precioFrente;
    const depositoAProveerInput = document.querySelector('input[name="deposito_a_proveer"]');
    if(depositoAProveerInput) depositoAProveerInput.value = depositoAProveer.toFixed(2);
}

/** ===================== CARGA DE DATOS ===================== */
function cargarDatosExpediente(id) {
    if (!id) return;

    fetch(`/expediente/programacion/${id}`)
        .then(res => res.json())
        .then(programacion => {
            setInputValues({
                'programacion_id': programacion.id,
                'guia_remision': programacion.guia_remision,
                'tipo_mineral': programacion.tipo_mineral,
                'placa_tracto': programacion.placa_tracto,
                'frente': programacion.frente,
                'precio_tn': programacion.precio_tn,
                'precio_frente': programacion.precio_frente,

                // 🔥 AHORA SÍ LOS NOMBRES QUE LLEGA EN EL JSON
                'razon_social': programacion.razon_social_transporte,
                'ruc': programacion.ruc_transporte,
                'banco': programacion.banco,
                'cuenta_banco': programacion.cuenta_banco,

                // 🔥 NOMBRES Y APELLIDOS DEL JSON
                'apellidos_conductor':
                    `${programacion.nombres_conductor ?? ''} ${programacion.apellidos_conductor ?? ''}`,

                'telefono': programacion.telefono_conductor
            });

            calcularTotalesExpediente();
        })
        .catch(err => {
            console.error("❌ Error al cargar programación:", err);
            alert("No se pudieron cargar los datos de la programación.");
        });
}


/** ===================== EVENTOS DOM ===================== */
document.addEventListener('DOMContentLoaded', function() {
    const tisurSelect = document.getElementById('tisur_id');
    const pesoNetoInput = document.getElementById('peso_neto');
    const estadoPagoDetraccionSelect = document.getElementById('estado_pago_detraccion');
    const depositoAProveerInput = document.querySelector('input[name="deposito_a_proveer"]');

    if(depositoAProveerInput) depositoAProveerInput.setAttribute('readonly', true);

    if(tisurSelect){
        tisurSelect.addEventListener('change', function() {
            const tisurId = this.value;
            if(!tisurId){
                pesoNetoInput.value = '';
                calcularTotalesExpediente();
                return;
            }
            fetch(`/expediente/tisur/${tisurId}`)
                .then(res => res.json())
                .then(data => {
                    document.querySelector('input[name="fecha_hora_ingreso"]').value = formatDateToInput(data.fecha_hora_ingreso);
                    pesoNetoInput.value = data.peso_neto ?? '';
                    calcularTotalesExpediente();
                })
                .catch(err => {
                    console.error("❌ Error al cargar Tisur:", err);
                    pesoNetoInput.value = '';
                    calcularTotalesExpediente();
                });
        });
    }

    if(pesoNetoInput) pesoNetoInput.addEventListener('input', calcularTotalesExpediente);
    if(estadoPagoDetraccionSelect) estadoPagoDetraccionSelect.addEventListener('change', calcularTotalesExpediente);
});
</script>
