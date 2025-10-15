<!-- Modal Editar TISUR -->
<div class="modal fade" id="modalEditTisur{{ $tisur->id }}" tabindex="-1" aria-labelledby="modalEditTisurLabel{{ $tisur->id }}" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <form action="{{ route('tisur.update', $tisur) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="modal-header bg-warning text-dark">
                    <h5 class="modal-title" id="modalEditTisurLabel{{ $tisur->id }}">Editar Registro TISUR</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label class="form-label">N° Ticket</label>
                            <input type="text" name="numero_ticket" class="form-control" value="{{ $tisur->numero_ticket }}" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Fecha / Hora Ingreso</label>
                            <input type="datetime-local" name="fecha_hora_ingreso" class="form-control" value="{{ $tisur->fecha_hora_ingreso }}">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Placa Tracto</label>
                            <input type="text" name="placa_tracto" class="form-control" value="{{ $tisur->placa_tracto }}">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Fecha / Hora Salida</label>
                            <input type="datetime-local" name="fecha_hora_salida" class="form-control" value="{{ $tisur->fecha_hora_salida }}">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Primer Peso</label>
                            <input type="number" name="primer_peso" class="form-control" value="{{ $tisur->primer_peso }}">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Segundo Peso</label>
                            <input type="number" name="segundo_peso" class="form-control" value="{{ $tisur->segundo_peso }}">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Razón Social</label>
                            <input type="text" name="razon_social" class="form-control" value="{{ $tisur->razon_social }}">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Transportista</label>
                            <input type="text" name="transportista" class="form-control" value="{{ $tisur->transportista }}">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Tipo Carga</label>
                            <input type="text" name="tipo_carga_tisur" class="form-control" value="{{ $tisur->tipo_carga_tisur }}">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">N° Bultos</label>
                            <input type="number" name="numero_bultos" class="form-control" value="{{ $tisur->numero_bultos }}">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Peso Neto</label>
                            <input type="number" step="0.01" name="peso_neto" class="form-control" value="{{ $tisur->peso_neto }}">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Tipo</label>
                            <input type="text" name="tipo_plataforma" class="form-control" value="{{ $tisur->tipo_plataforma }}">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Documento Origen</label>
                            <input type="text" name="documento_origen" class="form-control" value="{{ $tisur->documento_origen }}">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Precio</label>
                            <input type="number" step="0.01" name="precio_tisur" class="form-control" value="{{ $tisur->precio_tisur }}">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Total</label>
                            <input type="number" step="0.01" name="total_tisur" class="form-control" value="{{ $tisur->total_tisur }}">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Retención</label>
                            <input type="number" step="0.01" name="retencion_tisur" class="form-control" value="{{ $tisur->retencion_tisur }}">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Pago</label>
                            <input type="number" step="0.01" name="pago_tisur" class="form-control" value="{{ $tisur->pago_tisur }}">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Factura</label>
                            <input type="text" name="factura_tisur" class="form-control" value="{{ $tisur->factura_tisur }}">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Estado</label>
                            <input type="text" name="estado" class="form-control" value="{{ $tisur->estado }}">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Guía Remisión</label>
                            <input type="text" name="guia_remision" class="form-control" value="{{ $tisur->guia_remision }}">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Fecha Pago</label>
                            <input type="date" name="fecha_pago" class="form-control"
                                   value="{{ $tisur->fecha_pago ? \Carbon\Carbon::parse($tisur->fecha_pago)->format('Y-m-d') : '' }}">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Orden</label>
                            <input type="text" name="orden_tisur" class="form-control" value="{{ $tisur->orden_tisur }}">
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-warning text-white">Actualizar</button>
                </div>
            </form>

        </div>
    </div>
</div>
