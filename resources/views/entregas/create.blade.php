<!-- Modal Crear Entrega -->
<div class="modal fade" id="createEntregaModal" tabindex="-1" aria-labelledby="createEntregaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form action="{{ route('entregas.store') }}" method="POST" class="modal-content">
            @csrf

            <div class="modal-header bg-success text-white">
                <h5 class="modal-title text-white mb-3" id="createEntregaModalLabel">Registrar Entrega de EPP</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">

                {{-- 🔍 Buscador de persona por DNI --}}
                <div class="mb-3">
                    <label class="form-label">Buscar por DNI</label>
                    <input type="text" id="buscar_dni" class="form-control" placeholder="Ingrese DNI..." maxlength="8" autocomplete="off">
                    <div id="resultados_dni" class="list-group mt-1" style="position:absolute; z-index:1000; width:100%; display:none;"></div>
                </div>

                {{-- Campo solo lectura del nombre --}}
                <div class="mb-3">
                    <label class="form-label">Persona seleccionada</label>
                    <input type="text" id="nombre_persona" class="form-control" readonly>
                    <input type="hidden" name="persona_id" id="persona_id">
                </div>

                {{-- 🔽 Múltiples EPPs --}}
                <div class="mb-3">
                    <label class="form-label">EPPs a entregar</label>

                    <table class="table table-bordered align-middle" id="tablaEpps">
                        <thead class="table-light">
                            <tr>
                                <th>EPP</th>
                                <th>Cantidad</th>
                                <th>Observación</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="eppItems">
                            <tr>
                                <td style="position: relative;">
                                    <input type="text" class="form-control buscar-epp" placeholder="Buscar EPP..." autocomplete="off">
                                    <input type="hidden" name="epps[0][epp_id]" class="epp_id">
                                    <div class="resultados-epp list-group" style="position:absolute; z-index:1000; width:100%; display:none;"></div>
                                </td>
                                <td><input type="number" name="epps[0][cantidad]" class="form-control" min="1" required></td>
                                <td><input type="text" name="epps[0][observacion]" class="form-control"></td>
                                <td><button type="button" class="btn btn-danger btn-sm eliminarFila">🗑</button></td>
                            </tr>
                        </tbody>
                    </table>

                    <button type="button" class="btn btn-primary btn-sm" id="agregarEpp">➕ Agregar ítem</button>
                </div>

                <div class="mb-3">
                    <label class="form-label">N° de Vale</label>
                    <input type="text" name="numero_vale" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Orden de Trabajo</label>
                    <input type="text" name="orden_trabajo" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Fecha de Entrega</label>
                    <input type="date" name="fecha_entrega" class="form-control" value="{{ date('Y-m-d') }}" required>
                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-success">Registrar</button>
            </div>
        </form>
    </div>
</div>

{{-- Script del autocompletado --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    // --- AUTOCOMPLETADO DE PERSONAS ---
    const inputDni = document.getElementById('buscar_dni');
    const resultados = document.getElementById('resultados_dni');
    const nombrePersona = document.getElementById('nombre_persona');
    const personaId = document.getElementById('persona_id');

    inputDni.addEventListener('keyup', function() {
        const dni = this.value.trim();
        if (dni.length < 3) {
            resultados.style.display = 'none';
            return;
        }
        fetch(`/personas/buscar/${dni}`)
            .then(response => response.json())
            .then(data => {
                resultados.innerHTML = '';
                if (data.length > 0) {
                    data.forEach(persona => {
                        const item = document.createElement('button');
                        item.type = 'button';
                        item.classList.add('list-group-item', 'list-group-item-action');
                        item.textContent = `${persona.dni} - ${persona.nombres}`;
                        item.addEventListener('click', () => {
                            nombrePersona.value = persona.nombres;
                            personaId.value = persona.id;
                            inputDni.value = persona.dni;
                            resultados.style.display = 'none';
                        });
                        resultados.appendChild(item);
                    });
                    resultados.style.display = 'block';
                } else {
                    resultados.style.display = 'none';
                }
            })
            .catch(() => resultados.style.display = 'none');
    });

    document.addEventListener('click', function(e) {
        if (!inputDni.contains(e.target) && !resultados.contains(e.target)) {
            resultados.style.display = 'none';
        }
    });

    // --- AGREGAR Y ELIMINAR FILAS DE EPP ---
    let indice = 1;
    const btnAgregar = document.getElementById('agregarEpp');
    const tbody = document.getElementById('eppItems');

    btnAgregar.addEventListener('click', () => {
        const fila = document.createElement('tr');
        fila.innerHTML = `
            <td style="position: relative;">
                <input type="text" class="form-control buscar-epp" placeholder="Buscar EPP..." autocomplete="off">
                <input type="hidden" name="epps[${indice}][epp_id]" class="epp_id">
                <div class="resultados-epp list-group" style="position:absolute; z-index:1000; width:100%; display:none;"></div>
            </td>
            <td><input type="number" name="epps[${indice}][cantidad]" class="form-control" min="1" required></td>
            <td><input type="text" name="epps[${indice}][observacion]" class="form-control"></td>
            <td><button type="button" class="btn btn-danger btn-sm eliminarFila">🗑</button></td>
        `;
        tbody.appendChild(fila);
        indice++;
    });

    tbody.addEventListener('click', e => {
        if (e.target.classList.contains('eliminarFila')) {
            e.target.closest('tr').remove();
        }
    });

    // --- AUTOCOMPLETADO DE EPPs ---
    tbody.addEventListener('keyup', function(e) {
        if (!e.target.classList.contains('buscar-epp')) return;

        const input = e.target;
        const resultadosEpp = input.parentElement.querySelector('.resultados-epp');
        const eppIdInput = input.parentElement.querySelector('.epp_id');
        const termino = input.value.trim();

        if (termino.length < 2) {
            resultadosEpp.style.display = 'none';
            return;
        }

        fetch(`/epps/buscar/${termino}`)
            .then(res => res.json())
            .then(data => {
                resultadosEpp.innerHTML = '';
                if (data.length > 0) {
                    data.forEach(epp => {
                        const item = document.createElement('button');
                        item.type = 'button';
                        item.classList.add('list-group-item', 'list-group-item-action');
                        item.textContent = `${epp.nombre} (Stock: ${epp.stock})`;
                        item.addEventListener('click', () => {
                            input.value = epp.nombre;
                            eppIdInput.value = epp.id;
                            resultadosEpp.style.display = 'none';
                        });
                        resultadosEpp.appendChild(item);
                    });
                    resultadosEpp.style.display = 'block';
                } else {
                    resultadosEpp.style.display = 'none';
                }
            })
            .catch(() => resultadosEpp.style.display = 'none');
    });

    // Cierra dropdown de EPPs al hacer clic afuera
    document.addEventListener('click', function(e) {
        document.querySelectorAll('.resultados-epp').forEach(div => {
            if (!div.contains(e.target) && !e.target.classList.contains('buscar-epp')) {
                div.style.display = 'none';
            }
        });
    });
});
</script>
