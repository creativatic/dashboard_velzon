<!-- Modal Crear Tisur -->
<div class="modal fade" id="modalCreateTisur" tabindex="-1" aria-labelledby="modalCreateTisurLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <form action="{{ route('tisur.store') }}" method="POST">
                @csrf
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="modalCreateTisurLabel">Nuevo Registro TISUR</h5>
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
                            <input type="number" step="0.01" name="primer_peso" class="form-control">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Segundo Peso (kg)</label>
                            <input type="number" step="0.01" name="segundo_peso" class="form-control">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Peso Neto (kg)</label>
                            <input type="number" step="0.01" name="peso_neto" class="form-control">
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
                            <label class="form-label">Precio (S/)</label>
                            <input type="number" step="0.00001" name="precio_tisur" class="form-control">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Total (S/)</label>
                            <input type="number" step="0.00001" name="total_tisur" class="form-control">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Retención (S/)</label>
                            <input type="number" step="0.00001" name="retencion_tisur" class="form-control">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Pago (S/)</label>
                            <input type="number" step="0.00001" name="pago_tisur" class="form-control">
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
