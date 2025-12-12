<div class="modal fade" id="modalCreateVolquete" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <form method="POST" action="{{ route('volquetes.store') }}">
            @csrf

            <div class="modal-content">

                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Registrar Volquete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <div class="row g-3">

                        <!-- FECHA -->
                        <div class="col-md-4">
                            <label class="form-label">Fecha</label>
                            <input type="date" name="fecha" class="form-control" required>
                        </div>

                        <!-- PROVEEDOR -->
                        <div class="col-md-4">
                            <label class="form-label">Proveedor</label>
                            <select name="proveedor_id" id="selectProveedor" class="form-select" required>
                                <option value="">Seleccione...</option>
                                @foreach($proveedores as $p)
                                    <option value="{{ $p->id }}">{{ $p->razon_social }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- UNIDAD - PLACA TRACTO -->
                        <div class="col-md-4">
                            <label class="form-label">Unidad (Placa Tracto)</label>
                            <select name="unidad_id" id="selectUnidad" class="form-select" required>
                                <option value="">Seleccione proveedor...</option>
                            </select>
                        </div>

                      <!-- FRENTE / DETALLE PROGRAMACIÓN -->
                        <div class="col-md-4">
                            <label class="form-label">Frente / Detalle Programación</label>
                            <select name="detalle_programacion_id" id="selectFrente" class="form-select">
                                <option value="">Seleccione...</option>
                                @foreach($frentes as $f)
                                    <option value="{{ $f->id }}" data-precio="{{ $f->precio_tn }}">
                                        {{ $f->frente }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- MOSTRAR COSTO POR TONELADA DEL FRENTE (readonly) -->
                        <div class="col-md-4">
                            <label class="form-label">Precio por Tonelada</label>
                            <input type="text" id="precioTonelada" class="form-control" value="" readonly>
                        </div>


                        <hr class="mt-3">

                        <!-- VUELTA 1 -->
                        <h5 class="mt-2 text-primary">Datos de la Vuelta 1</h5>

                        <div class="col-md-3">
                            <label>Hora</label>
                            <input type="time" name="hora_vuelta_1" class="form-control">
                        </div>

                        <div class="col-md-3">
                            <label>Lampadas</label>
                            <input type="number" name="lampadas_vuelta_1" class="form-control">
                        </div>

                        <div class="col-md-3">
                            <label>Peso (tn)</label>
                            <input type="number" step="0.01" name="peso_vuelta_1" class="form-control">
                        </div>

                        <hr class="mt-3">

                        <!-- VUELTA 2 -->
                        <h5 class="mt-2 text-primary">Datos de la Vuelta 2</h5>

                        <div class="col-md-3">
                            <label>Hora</label>
                            <input type="time" name="hora_vuelta_2" class="form-control">
                        </div>

                        <div class="col-md-3">
                            <label>Lampadas</label>
                            <input type="number" name="lampadas_vuelta_2" class="form-control">
                        </div>

                        <div class="col-md-3">
                            <label>Peso (tn)</label>
                            <input type="number" step="0.01" name="peso_vuelta_2" class="form-control">
                        </div>

                        <hr class="mt-3">

                        <!-- TOTALES -->
                        <h5 class="text-primary">Cálculos y Totales</h5>

                        <div class="col-md-3">
                            <label class="form-label">Conformidad</label>
                            <select name="conformidad" class="form-select">
                                <option value="">Seleccione...</option>
                                <option value="Ok">Ok</option>
                                <option value="Pendiente">Pendiente</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label>Total Lampadas (día)</label>
                            <input type="number" name="total_lampadas_dia" class="form-control" readonly>
                        </div>

                        <div class="col-md-3">
                            <label>Total Peso (tn)</label>
                            <input type="number" step="0.01" name="total_peso_dia" class="form-control" readonly>
                        </div>

                        <div class="col-md-3">
                            <label>Pasadas</label>
                            <input type="number" name="pasadas" class="form-control">
                        </div>

                        <div class="col-md-3">
                            <label>Total S/</label>
                            <input type="number" step="0.01" name="total" class="form-control" readonly>
                        </div>

                        <div class="col-md-3">
                            <label>Detracción</label>
                            <input type="number" step="0.01" name="detraccion" class="form-control" readonly>
                        </div>

                        <div class="col-md-3">
                            <label>Retención</label>
                            <input type="number" step="0.01" name="retencion" class="form-control" readonly>
                        </div>

                        <div class="col-md-3">
                            <label>Depósito a Proveer</label>
                            <input type="number" step="0.01" name="deposito_a_proveer" class="form-control" readonly>
                        </div>

                        <div class="col-md-3">
                            <label>Depósito Total</label>
                            <input type="number" step="0.01" name="deposito_total" class="form-control">
                        </div>

                        <div class="col-md-3">
                            <label>Fecha Pago</label>
                            <input type="date" name="fecha_pago" class="form-control">
                        </div>

                        <div class="col-md-3">
                            <label>Factura</label>
                            <input type="text" name="factura" class="form-control">
                        </div>

                        <div class="col-md-12">
                            <label>Observaciones</label>
                            <textarea name="observaciones" rows="3" class="form-control"></textarea>
                        </div>

                    </div>

                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button class="btn btn-primary">Guardar Registro</button>
                </div>

            </div>
        </form>
    </div>
</div>

{{-- FILTRO AUTOMÁTICO DE UNIDADES SEGÚN PROVEEDOR --}}
<script>


document.addEventListener('DOMContentLoaded', () => {

    // --- filtro unidades por proveedor ---
    const proveedorSelect = document.getElementById('selectProveedor');
    const unidadSelect = document.getElementById('selectUnidad');
    const unidades = @json($unidades ?? []);

    if (proveedorSelect && unidadSelect) {
        proveedorSelect.addEventListener('change', function () {
            let proveedorId = parseInt(this.value);
            unidadSelect.innerHTML = '<option value="">Seleccione...</option>';

            if (!proveedorId) {
                unidadSelect.innerHTML = '<option value="">Seleccione proveedor...</option>';
                return;
            }

            let filtradas = unidades.filter(u => u.proveedor_id == proveedorId);

            if (filtradas.length === 0) {
                unidadSelect.innerHTML = '<option value="">No hay unidades para este proveedor</option>';
                return;
            }

            filtradas.forEach(u => {
                unidadSelect.innerHTML += `<option value="${u.id}">${u.placa_tracto}</option>`;
            });
        });
    }

    // --- actualizar precio por tonelada al cambiar el frente ---
    const selectFrente = document.getElementById('selectFrente');
    const precioTonelada = document.getElementById('precioTonelada');

    if (selectFrente && precioTonelada) {
        // Si quieres precargar el precio cuando hay un valor por defecto:
        if (selectFrente.value) {
            const opt = selectFrente.options[selectFrente.selectedIndex];
            precioTonelada.value = opt ? (opt.getAttribute('data-precio') || '') : '';
        }

        selectFrente.addEventListener('change', function () {
            const option = this.options[this.selectedIndex];
            const precio = option ? option.getAttribute('data-precio') : '';
            precioTonelada.value = precio ?? '';
        });
    }

});

document.addEventListener('DOMContentLoaded', () => {

    const modalCreate = document.getElementById('modalCreateVolquete');

    if (!modalCreate) return;

    modalCreate.addEventListener('shown.bs.modal', () => {

        // ===== FECHA ACTUAL =====
        const fechaInput = modalCreate.querySelector('input[name="fecha"]');
        if (fechaInput && !fechaInput.value) {
            const today = new Date().toISOString().split('T')[0];
            fechaInput.value = today;
        }

        // ===== HORA ACTUAL =====
        const now = new Date();
        const horaActual = now.toTimeString().slice(0, 5); // HH:mm

        const horaV1 = modalCreate.querySelector('input[name="hora_vuelta_1"]');
        if (horaV1 && !horaV1.value) {
            horaV1.value = horaActual;
        }

    });

});



document.addEventListener('DOMContentLoaded', () => {

    const modal = document.getElementById('modalCreateVolquete');
    if (!modal) return;

    /* ===============================
       ELEMENTOS
    =============================== */
    const lamp1 = modal.querySelector('input[name="lampadas_vuelta_1"]');
    const lamp2 = modal.querySelector('input[name="lampadas_vuelta_2"]');
    const peso1 = modal.querySelector('input[name="peso_vuelta_1"]');
    const peso2 = modal.querySelector('input[name="peso_vuelta_2"]');

    const totalLamp = modal.querySelector('input[name="total_lampadas_dia"]');
    const totalPeso = modal.querySelector('input[name="total_peso_dia"]');

    const precioTonelada = modal.querySelector('#precioTonelada');
    const totalSoles = modal.querySelector('input[name="total"]');
    const detraccion = modal.querySelector('input[name="detraccion"]');
    const retencion = modal.querySelector('input[name="retencion"]');
    const depositoProveer = modal.querySelector('input[name="deposito_a_proveer"]');

    const selectFrente = modal.querySelector('#selectFrente');

    /* ===============================
       FUNCIONES
    =============================== */
    function calcularFinanzas() {
        const peso = parseFloat(totalPeso.value) || 0;
        const precio = parseFloat(precioTonelada.value) || 0;

        const total = peso * precio;
        totalSoles.value = total.toFixed(2);

        const det = total * 0.04;
        detraccion.value = det.toFixed(2);

        const ret = total * 0.10;
        retencion.value = ret.toFixed(2);

        depositoProveer.value = (total - det - ret).toFixed(2);
    }

    function calcularTotales() {
        const l1 = parseFloat(lamp1.value) || 0;
        const l2 = parseFloat(lamp2.value) || 0;
        totalLamp.value = l1 + l2;

        const p1 = parseFloat(peso1.value) || 0;
        const p2 = parseFloat(peso2.value) || 0;
        totalPeso.value = (p1 + p2).toFixed(2);

        calcularFinanzas(); // ✅ ahora SÍ existe
    }

    /* ===============================
       EVENTOS
    =============================== */
    lamp1.addEventListener('input', calcularTotales);
    lamp2.addEventListener('input', calcularTotales);
    peso1.addEventListener('input', calcularTotales);
    peso2.addEventListener('input', calcularTotales);

    selectFrente.addEventListener('change', function () {
        const opt = this.options[this.selectedIndex];
        precioTonelada.value = opt ? opt.dataset.precio || '' : '';
        calcularFinanzas();
    });

});

</script>
