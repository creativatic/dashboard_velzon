<!-- Modal Editar Programación -->
<div class="modal fade" id="editProgramacionModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <form id="editProgramacionForm" method="POST" class="modal-content">
            @csrf @method('PUT')

            <div class="modal-header">
                <h5 class="modal-title">Editar Programación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>

            <div class="modal-body">
                <input type="hidden" id="edit-id" name="id">

                <div class="row g-3">
                    @php
                        $campos = [
                            'fecha_progracion' => 'Fecha Programación',
                            'dni' => 'DNI',
                            'guia_remision' => 'Guía Remisión',
                            'placa_tracto' => 'Placa Tracto',
                            'placa_carreta' => 'Placa Carreta',
                            'marca_vehiculo' => 'Marca Vehículo',
                            'tipo_plataforma' => 'Tipo Plataforma',
                            'constancia_mtc_tracto' => 'Constancia MTC Tracto',
                            'constancia_mtc_carreta' => 'Constancia MTC Carreta',
                            'razon_social_transporte' => 'Razón Social Transporte',
                            'ruc_transporte' => 'RUC Transporte',
                            'nombres_conductor' => 'Nombres Conductor',
                            'apellidos_conductor' => 'Apellidos Conductor',
                            'licencia' => 'Licencia',
                            'telefono_conductor' => 'Teléfono Conductor',
                            'cuenta_banco' => 'Cuenta Banco',
                            'cci_banco' => 'CCI Banco',
                            'banco' => 'Banco',
                            'tipo_mineral' => 'Tipo Mineral',
                            'tipo_operacion' => 'Tipo Operación',
                            'conformidad_adelanto' => 'Conformidad Adelanto',
                            'guia_transportista' => 'Guía Transportista',
                            'grupo_cargio' => 'Grupo Carguío',
                        ];
                    @endphp

                    @foreach($campos as $key => $label)
                        <div class="col-md-4">
                            <label class="form-label">{{ $label }}</label>
                            <input type="text" name="{{ $key }}" id="edit-{{ $key }}" class="form-control">
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="ri-close-circle-line"></i> Cancelar
                </button>
                <button type="submit" class="btn btn-primary">
                    <i class="ri-save-3-line"></i> Actualizar
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function openEditProgramacionModal(programacion) {
    const form = document.getElementById('editProgramacionForm');
    form.action = `/programacions/${programacion.id}`;

    for (const key in programacion) {
        const input = document.getElementById(`edit-${key}`);
        if (input) input.value = programacion[key] ?? '';
    }

    new bootstrap.Modal(document.getElementById('editProgramacionModal')).show();
}
</script>
