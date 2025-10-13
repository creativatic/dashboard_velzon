<!-- Modal Crear Programación -->
<div class="modal fade" id="createProgramacionModal" tabindex="-1" aria-labelledby="createProgramacionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <form action="{{ route('programacions.store') }}" method="POST" class="modal-content">
            @csrf
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="createProgramacionModalLabel">
                    <i class="ri-calendar-check-line me-1"></i> Nueva Programación
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>

            <div class="modal-body">
                <div class="row g-3">

                    {{-- Frente / Detalle Programación --}}
                    <div class="col-md-4">
                        <label class="form-label">Frente</label>
                        <select name="detalle_programacion_id" class="form-select">
                            <option value="">-- Seleccionar Frente --</option>
                            @foreach($detalles as $detalle)
                                <option value="{{ $detalle->id }}">{{ $detalle->frente }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    {{-- Fecha Programación --}}
                    <div class="col-md-3">
                        <label class="form-label">Fecha Programación</label>
                        <input type="date" name="fecha_progracion" class="form-control" value="{{ now()->format('Y-m-d') }}" required>
                    </div>

                    {{-- DNI --}}
                    <div class="col-md-3">
                        <label class="form-label">DNI</label>
                        <input type="text" name="dni" class="form-control" maxlength="8" placeholder="DNI del conductor">
                    </div>

                    {{-- Guía Remisión --}}
                    <div class="col-md-3">
                        <label class="form-label">Guía Remisión</label>
                        <input type="text" name="guia_remision" class="form-control" placeholder="Ej: 001-000123">
                    </div>

                    {{-- Placas --}}
                    <div class="col-md-3">
                        <label class="form-label">Placa Tracto</label>
                        <input type="text" name="placa_tracto" class="form-control" placeholder="ABC-123">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Placa Carreta</label>
                        <input type="text" name="placa_carreta" class="form-control" placeholder="DEF-456">
                    </div>

                    {{-- Marca y Tipo --}}
                    <div class="col-md-4">
                        <label class="form-label">Marca Vehículo</label>
                        <input type="text" name="marca_vehiculo" class="form-control" placeholder="Ej: Volvo, Scania">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Tipo Plataforma</label>
                        <input type="text" name="tipo_plataforma" class="form-control" placeholder="Ej: Plataforma baja, Furgón">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Constancia MTC Tracto</label>
                        <input type="text" name="constancia_mtc_tracto" class="form-control" placeholder="N° constancia">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Constancia MTC Carreta</label>
                        <input type="text" name="constancia_mtc_carreta" class="form-control" placeholder="N° constancia">
                    </div>

                    {{-- Datos del Transporte --}}
                    <div class="col-md-8">
                        <label class="form-label">Razón Social del Transporte</label>
                        <input type="text" name="razon_social_transporte" class="form-control" placeholder="Nombre o empresa de transporte">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">RUC Transporte</label>
                        <input type="text" name="ruc_transporte" class="form-control" maxlength="11">
                    </div>

                    {{-- Datos del Conductor --}}
                    <div class="col-md-4">
                        <label class="form-label">Nombres Conductor</label>
                        <input type="text" name="nombres_conductor" class="form-control" placeholder="Nombres">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Apellidos Conductor</label>
                        <input type="text" name="apellidos_conductor" class="form-control" placeholder="Apellidos">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Licencia</label>
                        <input type="text" name="licencia" class="form-control" placeholder="N° Licencia">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Teléfono Conductor</label>
                        <input type="text" name="telefono_conductor" class="form-control" placeholder="Ej: 987654321">
                    </div>

                    {{-- Cuenta bancaria --}}
                    <div class="col-md-4">
                        <label class="form-label">Cuenta Banco</label>
                        <input type="text" name="cuenta_banco" class="form-control" placeholder="Cuenta bancaria">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">CCI Banco</label>
                        <input type="text" name="cci_banco" class="form-control" placeholder="Código CCI">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Banco</label>
                        <input type="text" name="banco" class="form-control" placeholder="Ej: BCP, BBVA, Interbank">
                    </div>

                    {{-- Tipo y operación --}}
                    <div class="col-md-4">
                        <label class="form-label">Tipo Mineral</label>
                        <input type="text" name="tipo_mineral" class="form-control" placeholder="Ej: Hierro, Cobre">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Tipo Operación</label>
                        <select name="tipo_operacion" class="form-select">
                            <option value="">Seleccionar...</option>
                            <option value="nacional">Nacional</option>
                            <option value="internacional">Internacional</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Conformidad Adelanto</label>
                        <input type="text" name="conformidad_adelanto" class="form-control" placeholder="Ej: Sí / No / Pendiente">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Guía Transportista</label>
                        <input type="text" name="guia_transportista" class="form-control" placeholder="N° guía transportista">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Grupo Carguío</label>
                        <input type="text" name="grupo_cargio" class="form-control" placeholder="Ej: Grupo 1, Grupo 2">
                    </div>

                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="ri-close-circle-line"></i> Cancelar
                </button>
                <button type="submit" class="btn btn-primary">
                    <i class="ri-save-3-line"></i> Guardar Programación
                </button>
            </div>
        </form>
    </div>
</div>
