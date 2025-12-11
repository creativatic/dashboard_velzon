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
                            <select name="detalle_programacion_id" class="form-select">
                                <option value="">Seleccione...</option>
                                @foreach($frentes as $f)
                                    <option value="{{ $f->id }}">{{ $f->descripcion }}</option>
                                @endforeach
                            </select>
                        </div>

                        <hr class="mt-3">

                        <!-- VUELTA 1 -->
                        <h5 class="mt-2 text-primary">Datos de la Vuelta 1</h5>

                        <div class="col-md-3">
                            <label>Hora</label>
                            <input type="time" name="hora_vuelta_1" class="form-control">
                        </div>

                        <div class="col-md-3">
                            <label>Lámparas</label>
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
                            <label>Lámparas</label>
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
                            <label>Conformidad</label>
                            <input type="text" name="conformidad" class="form-control">
                        </div>

                        <div class="col-md-3">
                            <label>Total Lampadas (día)</label>
                            <input type="number" name="total_lampadas_dia" class="form-control">
                        </div>

                        <div class="col-md-3">
                            <label>Total Peso (tn)</label>
                            <input type="number" step="0.01" name="total_peso_dia" class="form-control">
                        </div>

                        <div class="col-md-3">
                            <label>Pasadas</label>
                            <input type="number" name="pasadas" class="form-control">
                        </div>

                        <div class="col-md-3">
                            <label>Total S/</label>
                            <input type="number" step="0.01" name="total" class="form-control">
                        </div>

                        <div class="col-md-3">
                            <label>Detracción</label>
                            <input type="number" step="0.01" name="detraccion" class="form-control">
                        </div>

                        <div class="col-md-3">
                            <label>Retención</label>
                            <input type="number" step="0.01" name="retencion" class="form-control">
                        </div>

                        <div class="col-md-3">
                            <label>Depósito a Proveer</label>
                            <input type="number" step="0.01" name="deposito_a_proveer" class="form-control">
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

    const proveedorSelect = document.getElementById('selectProveedor');
    const unidadSelect = document.getElementById('selectUnidad');

    // Todas las unidades enviadas desde PHP → convertidas a JSON
    const unidades = @json($unidades);

    proveedorSelect.addEventListener('change', function () {

        let proveedorId = parseInt(this.value);

        unidadSelect.innerHTML = '<option value="">Seleccione...</option>';

        if (!proveedorId) {
            unidadSelect.innerHTML = '<option value="">Seleccione proveedor...</option>';
            return;
        }

        // Filtrar unidades por proveedor
        let filtradas = unidades.filter(u => u.proveedor_id == proveedorId);

        filtradas.forEach(u => {
            unidadSelect.innerHTML += `<option value="${u.id}">${u.placa_tracto}</option>`;
        });

        if (filtradas.length === 0) {
            unidadSelect.innerHTML = '<option value="">No hay unidades para este proveedor</option>';
        }
    });

});
</script>
