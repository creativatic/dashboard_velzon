<div class="modal fade" id="modalCreateExpediente" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <form action="{{ route('expediente.store') }}" method="POST" class="modal-content">
            @csrf
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Nuevo Expediente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body row g-3">

                {{-- === SELECT DE GUIA REMISION === --}}
                <div class="col-md-6">
                    <label class="form-label">Guía de Remisión</label>
                    <select name="programacion_id" id="programacion_id" class="form-select" required>
                        <option value="">-- Seleccione una guía --</option>
                        @foreach ($programacions as $programacion)
                            <option value="{{ $programacion->id }}">
                                {{ $programacion->guia_remision }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- === CAMPOS AUTOMÁTICOS DESDE PROGRAMACIÓN === --}}
                <div class="col-md-3">
                    <label class="form-label">Placa Tracto</label>
                    <input type="text" id="placa_tracto" class="form-control" readonly>
                </div>

                <div class="col-md-3">
                    <label class="form-label">Placa Carreta</label>
                    <input type="text" id="placa_carreta" class="form-control" readonly>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Razón Social Empresa</label>
                    <input type="text" id="razon_social_empresa" class="form-control" readonly>
                </div>

                <div class="col-md-4">
                    <label class="form-label">RUC</label>
                    <input type="text" id="ruc" class="form-control" readonly>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Nombres Conductor</label>
                    <input type="text" id="nombres_conductor" class="form-control" readonly>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Apellidos Conductor</label>
                    <input type="text" id="apellidos_conductor" class="form-control" readonly>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Licencia</label>
                    <input type="text" id="licencia" class="form-control" readonly>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Teléfono Conductor</label>
                    <input type="text" id="telefono_conductor" class="form-control" readonly>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Cuenta Banco</label>
                    <input type="text" id="cuenta_banco" class="form-control" readonly>
                </div>

                <div class="col-md-4">
                    <label class="form-label">CCI Banco</label>
                    <input type="text" id="cci_banco" class="form-control" readonly>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Banco</label>
                    <input type="text" id="banco" class="form-control" readonly>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Tipo de Mineral</label>
                    <input type="text" id="tipo_mineral" class="form-control" readonly>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Guía Transportista</label>
                    <input type="text" id="guia_transportista" class="form-control" readonly>
                </div>

                {{-- === CAMPOS PROPIOS DEL EXPEDIENTE === --}}
                <div class="col-md-4">
                    <label class="form-label">N° Ticket Expediente</label>
                    <input type="text" name="numero_ticket_exped" class="form-control">
                </div>

                <div class="col-md-4">
                    <label class="form-label">N° Factura Expediente</label>
                    <input type="text" name="numero_factura_exped" class="form-control">
                </div>

                <div class="col-md-4">
                    <label class="form-label">Total (S/)</label>
                    <input type="number" step="0.01" name="total" class="form-control">
                </div>

                <div class="col-md-4">
                    <label class="form-label">Detracción (S/)</label>
                    <input type="number" step="0.01" name="detraccion" class="form-control">
                </div>

                <div class="col-md-4">
                    <label class="form-label">Fecha de Pago</label>
                    <input type="date" name="fecha_pago" class="form-control">
                </div>

                <div class="col-md-12">
                    <label class="form-label">Comentarios</label>
                    <textarea name="comentarios" class="form-control" rows="2"></textarea>
                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-success">Guardar</button>
            </div>
        </form>
    </div>
</div>

{{-- === SCRIPT PARA CARGAR DATOS DE PROGRAMACIÓN === --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    const selectProgramacion = document.getElementById('programacion_id');

    selectProgramacion.addEventListener('change', function() {
        const id = this.value;
        if (id) {
            fetch(`/expediente/programacion/${id}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('placa_tracto').value = data.placa_tracto ?? '';
                    document.getElementById('placa_carreta').value = data.placa_carreta ?? '';
                    document.getElementById('razon_social_empresa').value = data.razon_social_transporte ?? '';
                    document.getElementById('ruc').value = data.ruc_transporte ?? '';
                    document.getElementById('nombres_conductor').value = data.nombres_conductor ?? '';
                    document.getElementById('apellidos_conductor').value = data.apellidos_conductor ?? '';
                    document.getElementById('licencia').value = data.licencia ?? '';
                    document.getElementById('telefono_conductor').value = data.telefono_conductor ?? '';
                    document.getElementById('cuenta_banco').value = data.cuenta_banco ?? '';
                    document.getElementById('cci_banco').value = data.cci_banco ?? '';
                    document.getElementById('banco').value = data.banco ?? '';
                    document.getElementById('tipo_mineral').value = data.tipo_mineral ?? '';
                    document.getElementById('guia_transportista').value = data.guia_transportista ?? '';
                })
                .catch(error => console.error('Error al obtener los datos:', error));
        } else {
            document.querySelectorAll('#modalCreateExpediente input[readonly]').forEach(input => input.value = '');
        }
    });
});
</script>
