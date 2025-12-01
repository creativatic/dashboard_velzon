<!-- Modal Crear Tisur -->
<div class="modal fade" id="modalCreateTisur" tabindex="-1" aria-labelledby="modalCreateTisurLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <form action="{{ route('tisur.store') }}" method="POST">
                @csrf
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title text-white" id="modalCreateTisurLabel">Nuevo Registro TISUR</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="row g-3">
                        {{-- Datos principales --}}
                        <div class="col-md-3">
                            <label class="form-label">N° Ticket *</label>
                            <input type="text" name="numero_ticket" class="form-control" required>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Fecha y Hora Ingreso</label>
                            <input type="datetime-local" name="fecha_hora_ingreso" class="form-control">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Placa Tracto</label>
                            <input type="text" name="placa_tracto" class="form-control">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Fecha y Hora Salida</label>
                            <input type="datetime-local" name="fecha_hora_salida" class="form-control">
                        </div>

                        {{-- Pesos --}}
                        <div class="col-md-3">
                            <label class="form-label">Primer Peso (kg)</label>
                            <input type="number" step="0.00001" name="primer_peso" id="primer_peso" class="form-control">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Segundo Peso (kg)</label>
                            <input type="number" step="0.00001" name="segundo_peso" id="segundo_peso" class="form-control">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">N° Bultos</label>
                            <input type="number" step="0.00001" name="numero_bultos" id="numero_bultos" class="form-control">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Peso Neto (kg)</label>
                            <input type="number" step="0.00001" name="peso_neto" id="peso_neto" class="form-control">
                        </div>

                        {{-- Empresa --}}
                        <div class="col-md-6">
                            <label class="form-label">Razón Social</label>
                            <input type="text" name="razon_social" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Transportista</label>
                            <input type="text" name="transportista" class="form-control">
                        </div>

                        {{-- Tipo de carga --}}
                        <div class="col-md-4">
                            <label class="form-label">Tipo Carga</label>
                            <input type="text" name="tipo_carga_tisur" class="form-control">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Tipo Plataforma</label>
                            <input type="text" name="tipo_plataforma" class="form-control">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Documento Origen</label>
                            <input type="text" name="documento_origen" class="form-control">
                        </div>

                        {{-- Datos económicos --}}
                        <div class="col-md-3">
                            <label class="form-label">Precio ($)</label>
                            <input type="number" step="0.00001" name="precio_tisur" id="precio_tisur" class="form-control">
                        </div>

                        <div class="col-md-2 d-flex align-items-end">
                            <!-- Botón pequeño para disparar el cálculo -->
                            <button type="button" id="btnCalcularTisur" class="btn btn-sm btn-dark w-100">
                                Calcular
                            </button>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Total ($)</label>
                            <input type="number" step="0.00001" name="total_tisur" id="total_tisur" class="form-control" readonly>
                        </div>

                        <div class="col-md-2">
                            <label class="form-label">Retención ($)</label>
                            <input type="number" step="0.00001" name="retencion_tisur" id="retencion_tisur" class="form-control" readonly>
                        </div>

                        <div class="col-md-2">
                            <label class="form-label">Pago ($)</label>
                            <input type="number" step="0.00001" name="pago_tisur" id="pago_tisur" class="form-control" readonly>
                        </div>

                        {{-- Facturación --}}
                        <div class="col-md-4">
                            <label class="form-label">Factura</label>
                            <input type="text" name="factura_tisur" class="form-control">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Fecha Pago</label>
                            <input type="date" name="fecha_pago" class="form-control">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Orden</label>
                            <input type="text" name="orden_tisur" class="form-control">
                        </div>

                        {{-- Estado --}}
                        <div class="col-md-4">
                            <label class="form-label">Estado</label>
                            <select name="estado" class="form-select">
                                <option value="Pendiente" selected>Pendiente</option>
                                <option value="Pagado">Pagado</option>
                            </select>
                        </div>

                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar Registro</button>
                </div>
            </form>
        </div>
    </div>
</div>



<script>
document.addEventListener('DOMContentLoaded', function () {
    const precioInput = document.getElementById('precio_tisur');
    const pesoInput = document.getElementById('peso_neto');
    const totalInput = document.getElementById('total_tisur');
    const retencionInput = document.getElementById('retencion_tisur');
    const pagoInput = document.getElementById('pago_tisur');
    const btnCalcular = document.getElementById('btnCalcularTisur');

    function calcularValores() {
        // Tomamos peso en TONELADAS si tu sistema requiere, aquí usas kg -> si quieres tn divide por 1000
        // Si tu peso_neto está en kg y precio es por TON, ajusta: const pesoTn = (peso / 1000);
        const precio = parseFloat(precioInput.value) || 0;
        const peso = parseFloat(pesoInput.value) || 0;

        // Si precio está en $ por tonelada y peso está en kg, convertir:
        // const pesoTn = peso / 1000;
        // const total = precio * pesoTn;
        // Pero si ambos están en las mismas unidades que usas en Excel (precio por unidad * peso), usa:
        const total = precio * peso;

        const retencion = total * 0.05; // 5%
        const pago = total - retencion;

        // Formato: 2 decimales o 5 según prefieras. Mantengo 5 como tu diseño previo.
        totalInput.value = isFinite(total) ? total.toFixed(5) : '';
        retencionInput.value = isFinite(retencion) ? retencion.toFixed(5) : '';
        pagoInput.value = isFinite(pago) ? pago.toFixed(5) : '';
    }

    // Ejecutar cálculo solo al pulsar el botón
    btnCalcular.addEventListener('click', function (e) {
        e.preventDefault();
        calcularValores();
    });

    // (Opcional) Si deseas que también calcule cuando presionen Enter en campo precio/peso:
    [precioInput, pesoInput].forEach(el => {
        el.addEventListener('keydown', function (ev) {
            if (ev.key === 'Enter') {
                ev.preventDefault();
                calcularValores();
            }
        });
    });
});
</script>
