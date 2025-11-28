<div class="modal fade" id="modalEditConductor{{ $conductor->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header bg-warning">
                <h5 class="modal-title">Editar Conductor - {{ $conductor->nombres }} {{ $conductor->apellidos }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form action="{{ route('conductores.update', $conductor->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="modal-body">
                    <div class="row g-3">

                        <div class="col-md-6">
                            <label class="form-label">DNI <span class="text-danger">*</span></label>
                            <input type="text" name="dni" class="form-control"
                                value="{{ old('dni', $conductor->dni) }}"
                                required maxlength="8">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Licencia <span class="text-danger">*</span></label>
                            <input type="text" name="licencia" class="form-control"
                                value="{{ old('licencia', $conductor->licencia) }}" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Nombres <span class="text-danger">*</span></label>
                            <input type="text" name="nombres" class="form-control"
                                value="{{ old('nombres', $conductor->nombres) }}" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Apellidos <span class="text-danger">*</span></label>
                            <input type="text" name="apellidos" class="form-control"
                                value="{{ old('apellidos', $conductor->apellidos) }}" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Teléfono</label>
                            <input type="text" name="telefono" class="form-control"
                                value="{{ old('telefono', $conductor->telefono) }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Unidad Asociada <span class="text-danger">*</span></label>
                            <select name="unidad_id" class="form-select" required>
                                <option value="">-- Seleccione unidad --</option>

                                @php
                                    $unidadActual = $conductor->unidades->first()->id ?? null;
                                @endphp

                                @foreach($unidades as $u)
                                    <option value="{{ $u->id }}"
                                        {{ $unidadActual == $u->id ? 'selected' : '' }}>
                                        {{ $u->placa_tracto }} - {{ $u->placa_carreta }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-warning">Actualizar</button>
                </div>

            </form>
        </div>
    </div>
</div>
