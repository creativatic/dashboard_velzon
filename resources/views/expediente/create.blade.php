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
                        <input type="text" class="form-control" id="razon_social" readonly>
                        <input type="hidden" name="razon_social_transporte" id="razon_social_hidden">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">RUC</label>
                        <input type="text" class="form-control" id="ruc" readonly>
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
                        <label class="form-label">Fecha de Carga</label>
                        <input type="date" name="fecha_carga" class="form-control">
                    </div>
                    
                    <div class="col-md-4">
                        <label class="form-label">Fecha de Pago</label>
                        <input type="date" name="fecha_pago" class="form-control">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Fecha de Ingreso</label>
                        <input type="date" name="fecha_hora_ingreso" class="form-control">
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
/**
 * Realiza el cálculo del Total (precio_tn * peso_neto).
 */
function calcularTotalBase() {
    const precioTnElement = document.getElementById('precio_tn_hidden');
    const pesoNetoElement = document.getElementById('peso_neto');
    const totalElement = document.getElementById('total');

    if (!precioTnElement || !pesoNetoElement || !totalElement) {
        return 0;
    }

    const precioTn = parseFloat(precioTnElement.value) || 0;
    const pesoNeto = parseFloat(pesoNetoElement.value) || 0;
    const total = precioTn * pesoNeto;
    
    totalElement.value = total.toFixed(2);
    return total;
}

/**
 * Realiza el cálculo de Detracción, Total Neto a Pagar (total_con_detraccion) 
 * y Depósito a Proveer.
 */
function calcularTotalesExpediente() {
    // 1. Obtener el Total ya calculado
    const total = calcularTotalBase(); 
    
    // 2. Obtener elementos de Cálculo
    const detraccionElement = document.getElementById('detraccion');
    const estadoPagoDetraccionElement = document.getElementById('estado_pago_detraccion');
    const totalConDetraccionElement = document.getElementById('total_con_detraccion');
    const precioFrenteHiddenElement = document.getElementById('precio_frente_hidden'); // Nuevo elemento
    const depositoAProveerElement = document.querySelector('input[name="deposito_a_proveer"]'); // Campo final

    if (!detraccionElement || !estadoPagoDetraccionElement || !totalConDetraccionElement || !precioFrenteHiddenElement || !depositoAProveerElement) {
        console.error("Faltan elementos de Detracción o Depósito a Proveer en el DOM.");
        return;
    }
    
    const estadoPagoDetraccion = estadoPagoDetraccionElement.value;
    const precioFrente = parseFloat(precioFrenteHiddenElement.value) || 0;
    
    // A) CALCULAR DETRACCIÓN (4% del Total)
    const detraccion = total * 0.04;
    detraccionElement.value = detraccion.toFixed(2);

    let totalConDetraccion;

    // B) CALCULAR TOTAL NETO A PAGAR (total_con_detraccion)
    if (estadoPagoDetraccion === "No Pagado") {
        // total_con_detraccion = Total - Detracción
        totalConDetraccion = total - detraccion;
    } else if (estadoPagoDetraccion === "Pagado") {
        // total_con_detraccion = Total
        totalConDetraccion = total; 
    } else {
        totalConDetraccion = total;
    }

    // Asignar el resultado de Total Neto a Pagar
    totalConDetraccionElement.value = totalConDetraccion.toFixed(2);
    
    // C) CALCULAR DEPÓSITO A PROVEER
    // Depósito a Proveer = total_con_detraccion - precio_frente_hidden
    const depositoAProveer = totalConDetraccion - precioFrente;
    
    // Asignar el resultado al campo Depósito a Proveer
    depositoAProveerElement.value = depositoAProveer.toFixed(2);
    
    console.log(`Detracción: ${detraccion.toFixed(2)}, Total Neto: ${totalConDetraccion.toFixed(2)}, Precio Frente: ${precioFrente.toFixed(2)}, Depósito a Proveer: ${depositoAProveer.toFixed(2)}`);
}

/**
 * Carga los datos de la Programación al modal.
 */
function cargarDatosExpediente(id) {
    // Se utiliza la ruta original /programacion/{id}
    fetch(`/programacion/${id}`) 
        .then(response => {
            if (!response.ok) throw new Error(`Error ${response.status}: No se pudo obtener la programación.`);
            return response.json();
        })
        .then(programacion => {
            console.log("✅ Datos de Programación recibidos:", programacion);

            const detalle = programacion.detalle_programacion ?? {};
            const frenteValue = detalle.frente ?? '';
            const precioTnValue = detalle.precio_tn ?? ''; 
            const precioFrenteValue = detalle.precio_frente ?? ''; // Precio Frente (visible)

            // Asignación de valores a los campos visibles
            document.getElementById('programacion_id').value = programacion.id ?? '';
            document.getElementById('guia_remision').value = programacion.guia_remision ?? '';
            document.getElementById('placa_tracto').value = programacion.placa_tracto ?? '';
            document.getElementById('tipo_mineral').value = programacion.tipo_mineral ?? '';
            document.getElementById('frente').value = frenteValue;
            document.getElementById('precio_tn').value = precioTnValue;
            document.getElementById('precio_frente').value = precioFrenteValue; // Asignación Precio Frente visible

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
            document.getElementById('precio_tn_hidden').value = precioTnValue ?? ''; 
            document.getElementById('precio_frente_hidden').value = precioFrenteValue ?? ''; // Asignación Precio Frente hidden
            document.getElementById('telefono_hidden').value = programacion.telefono_conductor ?? '';
            document.getElementById('cuenta_banco_hidden').value = programacion.cuenta_banco ?? '';
            document.getElementById('banco_hidden').value = programacion.banco ?? '';

            // ✅ LLAMADA AL CÁLCULO DE TODOS LOS TOTALES
            calcularTotalesExpediente();
        })
        .catch(error => {
             console.error("❌ Error al cargar datos de Programación. Verifique la ruta del fetch o la estructura de la respuesta JSON:", error);
             document.getElementById('guia_remision').value = "ERROR";
        });
}


document.addEventListener('DOMContentLoaded', function () {
    const tisurSelect = document.getElementById('tisur_id');
    const pesoNetoInput = document.getElementById('peso_neto'); 
    const estadoPagoDetraccionSelect = document.getElementById('estado_pago_detraccion'); 
    const depositoAProveerInput = document.querySelector('input[name="deposito_a_proveer"]'); // Campo a poner como readonly

    // Opcional: Establecer deposito_a_proveer como readonly
    if (depositoAProveerInput) {
        depositoAProveerInput.setAttribute('readonly', true);
    }
    
    // 1. Escuchar cuando se selecciona un ticket Tisur
    tisurSelect.addEventListener('change', function () {
        const tisurId = this.value;
        if (!tisurId) {
            pesoNetoInput.value = ''; 
            calcularTotalesExpediente(); // Recalcular a cero
            return;
        }

        fetch(`/expediente/tisur/${tisurId}`)
        .then(response => response.json())
        .then(data => {
            console.log("📦 Datos TISUR:", data);

            // Fecha de ingreso
            if (data.fecha_hora_ingreso) {
                const fecha = new Date(data.fecha_hora_ingreso);
                const yyyy = fecha.getFullYear();
                const mm = String(fecha.getMonth() + 1).padStart(2, '0');
                const dd = String(fecha.getDate()).padStart(2, '0');
                document.querySelector('input[name="fecha_hora_ingreso"]').value = `${yyyy}-${mm}-${dd}`;
            }

            // Peso neto
            pesoNetoInput.value = data.peso_neto ?? '';

            // ✅ LLAMADA AL CÁLCULO DE TOTALES
            calcularTotalesExpediente();
        })
        .catch(error => console.error("❌ Error al cargar datos de Tisur:", error));
    });
    
    // 2. Escuchar si el usuario edita manualmente el Peso Neto (dispara todo el cálculo)
    if (pesoNetoInput) {
        pesoNetoInput.addEventListener('input', calcularTotalesExpediente);
    }
    
    // 3. Escuchar el cambio en el estado de pago de la detracción (dispara todo el cálculo)
    if (estadoPagoDetraccionSelect) {
        estadoPagoDetraccionSelect.addEventListener('change', calcularTotalesExpediente);
    }
});
</script>