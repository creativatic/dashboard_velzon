<div class="modal fade" id="modalEditVolquete{{ $volquete->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <form method="POST"
              action="{{ route('volquetes.update', $volquete->id) }}"
              enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="modal-content">

                <div class="modal-header bg-warning text-white">
                    <h5 class="modal-title">Editar Volquete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    {{-- DATOS GENERALES --}}
                    <h5 class="fw-bold">Datos Generales</h5>
                    <hr>

                    <div class="row g-3">

                        <div class="col-md-4">
                            <label class="form-label">Fecha</label>
                            <input type="date" name="fecha" class="form-control" value="{{ $volquete->fecha }}">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Proveedor</label>
                            <select name="proveedor_id" class="form-select" required>
                                @foreach($proveedores as $p)
                                    <option value="{{ $p->id }}" {{ $volquete->proveedor_id == $p->id ? 'selected' : '' }}>
                                        {{ $p->razon_social }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Frente</label>
                            <select name="detalle_programacion_id"
                                    id="selectFrenteEdit{{ $volquete->id }}"
                                    class="form-select">
                                <option value="">Seleccione...</option>
                                @foreach($frentes as $f)
                                    <option value="{{ $f->id }}"
                                            data-precio="{{ $f->precio_tn }}"
                                            {{ $volquete->detalle_programacion_id == $f->id ? 'selected' : '' }}>
                                        {{ $f->frente }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Precio por Tonelada</label>
                            <input type="text"
                                   id="precioToneladaEdit{{ $volquete->id }}"
                                   class="form-control"
                                   value="{{ $volquete->detalleProgramacion->precio_tn ?? '' }}"
                                   readonly>
                        </div>

                        {{-- FACTURA --}}
                        <div class="col-md-4">
                            <label class="form-label">Factura (PDF)</label>

                            @if($volquete->factura)
                                <div class="mb-1">
                                    <a href="{{ asset('storage/'.$volquete->factura) }}"
                                       target="_blank"
                                       class="btn btn-sm btn-outline-primary">
                                        Ver PDF
                                    </a>
                                </div>
                            @endif

                            <input type="file"
                                   name="factura"
                                   class="form-control"
                                   accept="application/pdf">
                        </div>

                        {{-- COMPROBANTE --}}
                        <div class="col-md-4">
                            <label class="form-label">Comprobante de Pago (PDF)</label>

                            @if($volquete->comprobante_pago)
                                <div class="mb-1">
                                    <a href="{{ asset('storage/'.$volquete->comprobante_pago) }}"
                                       target="_blank"
                                       class="btn btn-sm btn-outline-primary">
                                        Ver PDF
                                    </a>
                                </div>
                            @endif

                            <input type="file"
                                   name="comprobante_pago"
                                   class="form-control"
                                   accept="application/pdf">
                        </div>

                        <div class="col-md-12">
                            <label class="form-label">Observaciones</label>
                            <textarea name="observaciones" class="form-control" rows="2">{{ $volquete->observaciones }}</textarea>
                        </div>

                    </div>

                    {{-- DETALLES DE VUELTAS --}}
                    <h5 class="fw-bold mt-4">Detalles de Vueltas</h5>
                    <hr>

                    <div class="row g-3">
                        <div class="col-md-4">
                            <label>Hora Vuelta 1</label>
                            <input type="time" name="hora_vuelta_1" class="form-control" value="{{ $volquete->hora_vuelta_1 }}">
                        </div>

                        <div class="col-md-4">
                            <label>Lámparas 1</label>
                            <input type="number" name="lampadas_vuelta_1" class="form-control" value="{{ $volquete->lampadas_vuelta_1 }}">
                        </div>

                        <div class="col-md-4">
                            <label>Peso 1</label>
                            <input type="number" step="0.01" name="peso_vuelta_1" class="form-control" value="{{ $volquete->peso_vuelta_1 }}">
                        </div>
                    </div>

                    {{-- MONTOS --}}
                    <h5 class="fw-bold mt-4">Montos</h5>
                    <hr>

                    <div class="row g-3">
                        <div class="col-md-3">
                            <label>Total S/</label>
                            <input type="number" step="0.01" name="total" class="form-control" value="{{ $volquete->total }}">
                        </div>

                        <div class="col-md-3">
                            <label>Detracción</label>
                            <input type="number" step="0.01" name="detraccion" class="form-control" value="{{ $volquete->detraccion }}">
                        </div>

                        <div class="col-md-3">
                            <label>Retención</label>
                            <input type="number" step="0.01" name="retencion" class="form-control" value="{{ $volquete->retencion }}">
                        </div>

                        <div class="col-md-3">
                            <label>Depósito Total</label>
                            <input type="number" step="0.01" name="deposito_total" class="form-control" value="{{ $volquete->deposito_total }}">
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button class="btn btn-warning">Actualizar</button>
                </div>

            </div>
        </form>
    </div>
</div>


<script>
document.addEventListener('DOMContentLoaded', () => {
    // Usamos delegación: cuando se abre cualquier modal de edit, cargamos el precio por tonelada
    document.querySelectorAll('[id^="modalEditVolquete"]').forEach(modalEl => {
        modalEl.addEventListener('show.bs.modal', function (event) {
            const id = this.id.replace('modalEditVolquete',''); // id numérico
            const select = document.getElementById('selectFrenteEdit' + id);
            const precioInput = this.querySelector('#precioToneladaEdit' + id);

            if (!select || !precioInput) return;

            // actualizar precio al cargar modal
            const opt = select.options[select.selectedIndex];
            precioInput.value = opt ? (opt.getAttribute('data-precio') || '') : '';

            // Listener para cambios dentro del modal
            select.addEventListener('change', function () {
                const opt2 = this.options[this.selectedIndex];
                precioInput.value = opt2 ? (opt2.getAttribute('data-precio') || '') : '';
            });
        });
    });
});
</script>
