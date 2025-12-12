<div class="modal fade" id="modalEditVolquete{{ $volquete->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <form method="POST" action="{{ route('volquetes.update', $volquete->id) }}">
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
                                            {{ ($volquete->detalle_programacion_id ?? null) == $f->id ? 'selected' : '' }}>
                                        {{ $f->frente }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- campo readonly precio dentro del edit modal -->
                        <div class="col-md-4">
                            <label class="form-label">Precio por Tonelada</label>
                            <input type="text" id="precioToneladaEdit{{ $volquete->id }}" class="form-control" value="{{ $volquete->detalleProgramacion->precio_tn ?? '' }}" readonly>
                        </div>



                        <div class="col-md-4">
                            <label class="form-label">Factura</label>
                            <input type="text" name="factura" class="form-control" value="{{ $volquete->factura }}">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Conformidad</label>
                            <input type="text" name="conformidad" class="form-control" value="{{ $volquete->conformidad }}">
                        </div>

                        <div class="col-md-12">
                            <label class="form-label">Observaciones</label>
                            <textarea name="observaciones" class="form-control" rows="2">{{ $volquete->observaciones }}</textarea>
                        </div>

                    </div>

                    {{-- DETALLE DE VUELTAS --}}
                    <h5 class="fw-bold mt-4">Detalles de Vueltas</h5>
                    <hr>

                    <div class="row g-3">

                        <div class="col-md-4">
                            <label class="form-label">Hora Vuelta 1</label>
                            <input type="time" name="hora_vuelta_1" class="form-control" value="{{ $volquete->hora_vuelta_1 }}">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Lámparas 1</label>
                            <input type="number" name="lampadas_vuelta_1" class="form-control" value="{{ $volquete->lampadas_vuelta_1 }}">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Peso 1</label>
                            <input type="number" step="0.01" name="peso_vuelta_1" class="form-control" value="{{ $volquete->peso_vuelta_1 }}">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Hora Vuelta 2</label>
                            <input type="time" name="hora_vuelta_2" class="form-control" value="{{ $volquete->hora_vuelta_2 }}">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Lámparas 2</label>
                            <input type="number" name="lampadas_vuelta_2" class="form-control" value="{{ $volquete->lampadas_vuelta_2 }}">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Peso 2</label>
                            <input type="number" step="0.01" name="peso_vuelta_2" class="form-control" value="{{ $volquete->peso_vuelta_2 }}">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Pasadas</label>
                            <input type="number" name="pasadas" class="form-control" value="{{ $volquete->pasadas }}">
                        </div>

                    </div>


                    {{-- MONTOS --}}
                    <h5 class="fw-bold mt-4">Montos</h5>
                    <hr>

                    <div class="row g-3">
                        <div class="col-md-3">
                            <label class="form-label">Total S/</label>
                            <input type="number" step="0.01" name="total" class="form-control" value="{{ $volquete->total }}">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Detracción</label>
                            <input type="number" step="0.01" name="detraccion" class="form-control" value="{{ $volquete->detraccion }}">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Retención</label>
                            <input type="number" step="0.01" name="retencion" class="form-control" value="{{ $volquete->retencion }}">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Depósito a Proveer</label>
                            <input type="number" step="0.01" name="deposito_a_proveer" class="form-control" value="{{ $volquete->deposito_a_proveer }}">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Depósito Total</label>
                            <input type="number" step="0.01" name="deposito_total" class="form-control" value="{{ $volquete->deposito_total }}">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Fecha Pago</label>
                            <input type="date" name="fecha_pago" class="form-control" value="{{ $volquete->fecha_pago }}">
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
