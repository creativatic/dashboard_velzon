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

        const modal = document.getElementById('modalCreateVolquete');
        if (!modal) return;

        /* ===============================
        FILTRO UNIDADES POR PROVEEDOR
        =============================== */
        const proveedorSelect = modal.querySelector('#selectProveedor');
        const unidadSelect = modal.querySelector('#selectUnidad');
        const unidades = @json($unidades ?? []);

        proveedorSelect?.addEventListener('change', () => {
            const proveedorId = parseInt(proveedorSelect.value);
            unidadSelect.innerHTML = '<option value="">Seleccione...</option>';

            if (!proveedorId) {
                unidadSelect.innerHTML = '<option value="">Seleccione proveedor...</option>';
                return;
            }

            const filtradas = unidades.filter(u => u.proveedor_id == proveedorId);

            if (!filtradas.length) {
                unidadSelect.innerHTML = '<option value="">No hay unidades para este proveedor</option>';
                return;
            }

            filtradas.forEach(u => {
                unidadSelect.innerHTML += `<option value="${u.id}">${u.placa_tracto}</option>`;
            });
        });

        /* ===============================
        FECHA Y HORA AUTOMÁTICA
        =============================== */
        modal.addEventListener('shown.bs.modal', () => {

            const fecha = modal.querySelector('input[name="fecha"]');
            const horaV1 = modal.querySelector('input[name="hora_vuelta_1"]');

            if (fecha && !fecha.value) {
                fecha.value = new Date().toISOString().split('T')[0];
            }

            if (horaV1 && !horaV1.value) {
                horaV1.value = new Date().toTimeString().slice(0, 5);
            }
        });

        /* ===============================
        ELEMENTOS DE CÁLCULO
        =============================== */
        const lamp1 = modal.querySelector('[name="lampadas_vuelta_1"]');
        const lamp2 = modal.querySelector('[name="lampadas_vuelta_2"]');
        const peso1 = modal.querySelector('[name="peso_vuelta_1"]');
        const peso2 = modal.querySelector('[name="peso_vuelta_2"]');

        const totalLamp = modal.querySelector('[name="total_lampadas_dia"]');
        const totalPeso = modal.querySelector('[name="total_peso_dia"]');

        const precioTon = modal.querySelector('#precioTonelada');
        const totalS = modal.querySelector('[name="total"]');
        const detraccion = modal.querySelector('[name="detraccion"]');
        const retencion = modal.querySelector('[name="retencion"]');
        const deposito = modal.querySelector('[name="deposito_a_proveer"]');

        const selectFrente = modal.querySelector('#selectFrente');

        /* ===============================
        FUNCIONES
        =============================== */
        const num = v => parseFloat(v) || 0;

        function calcularFinanzas() {
            const total = num(totalPeso.value) * num(precioTon.value);

            totalS.value = total.toFixed(2);
            detraccion.value = (total * 0.04).toFixed(2);
            retencion.value = (total * 0.10).toFixed(2);
            deposito.value = (total * 0.86).toFixed(2);
        }

        function calcularTotales() {
            totalLamp.value = num(lamp1.value) + num(lamp2.value);
            totalPeso.value = (num(peso1.value) + num(peso2.value)).toFixed(2);
            calcularFinanzas();
        }

        /* ===============================
        EVENTOS
        =============================== */
        [lamp1, lamp2, peso1, peso2].forEach(el =>
            el?.addEventListener('input', calcularTotales)
        );

        selectFrente?.addEventListener('change', function () {
            const opt = this.options[this.selectedIndex];
            precioTon.value = opt?.dataset.precio || '';
            calcularFinanzas();
        });

    });

</script>
