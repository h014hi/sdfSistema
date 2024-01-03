<!--GENERAR REPORTE--> 

<script>
    function cargarEmpresas() {
        // Obtener el campo de selección de empresas
        const empresasSelect = document.getElementById('empresas');

        // Limpiar el campo de selección actual
        empresasSelect.innerHTML = '';

        // Realizar la solicitud AJAX para obtener los datos de las empresas
        const request = new XMLHttpRequest();
        request.open('GET', 'http://127.0.0.1:8000/empresasreport', true);

        request.onload = function () {
            if (request.status >= 200 && request.status < 400) {
                const empresas = JSON.parse(request.responseText);

                // Agregar las opciones de empresas al campo de selección
                empresas.forEach((empresa) => {
                    const option = document.createElement('option');
                    option.value = empresa.id;
                    option.textContent = empresa.razon_social;
                    empresasSelect.appendChild(option);
                });
            } else {
                // Manejar el error si la solicitud falla
                console.error('Error al cargar los datos de empresas');
            }
        };

        request.onerror = function () {
            console.error('Error al realizar la solicitud AJAX');
        };

        request.send();
    }
</script>

<!-- Modal -->
<div class="modal fade" id="myModaldos" tabindex="-1" role="dialog" aria-labelledby="myModaldosLabel">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
            <div class="modal-header"  style="background-color: #53a4d6;">
                <h4 class="modal-title" id="myModalLabel"><b>GENERAR REPORTE</b></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{route('generar.reporte')}}" method="POST">
            <div class="modal-body">                     
                                
                                    @csrf <!-- Agrega el token CSRF de Laravel para proteger el formulario -->

                                    <div class="form-group">
                                        <!-- Campo Tipo de Reporte -->
                                        <label for="tipo_reporte">Tipo de Reporte:</label>
                                        <select class="form-control" name="tipo_reporte" id="tipo_reporte" required>
                                            <option value="OPERATIVO">REPORTE DE OPERATIVOS</option>
                                            <option value="INFRACCION">REPORTE DE INFRACCIONES E INCUMPLIMIENTOS</option>
                                            <option value="PAGO">REPORTE DE PAGOS</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <!-- Campo Consulta por -->
                                        <label for="consulta_por">Consulta por:</label>
                                        <select class="form-control" name="consulta_por" id="consulta_por" required>
                                            <option selected>Selecciona</option>
                                            <option value="empresa">EMPRESA</option>
                                            <option value="general">GENERAL</option>
                                        </select>
                                    </div>

                                    <div class="form-group" id="empresas_field" style="display: none;">
                                        <!-- Campo Empresas (solo visible si selecciona "Por Empresa") -->
                                        <label for="empresas">Seleccione la empresa:</label>
                                        <select class="form-control" name="empresas" id="empresas">
                                            <!-- Opciones se cargarán dinámicamente -->
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <!-- Campos de Fechas -->
                                        <label for="fecha_inicio">Fecha de Inicio:</label>
                                        <input type="date" class="form-control" name="fecha_inicio" id="fecha_inicio">
                                    </div>

                                    <div class="form-group">
                                        <label for="fecha_fin">Fecha de Fin:</label>
                                        <input type="date" class="form-control" name="fecha_fin" id="fecha_fin">
                                    </div>
                                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" style = "background-color: #EC7518; color:white;">Cerrar</button>
                <button type="button" class="btn btn-success" style = "background-color: #2AA611;" >EXCEL</button>
                <button type="submit" class="btn btn-danger" style = "background-color: #EC4518;">PDF</button>
            </div>

            </form>
            </div>
        </div>
</div>

<!--<a href="/generar-pdf" target="_blank" class="btn">Generar PDF</a>-->
<button class="btn btn-warning"  data-toggle="modal" data-target="#myModaldos" style = "background-color: #EC7518; color:white;"  onclick="cargarEmpresas()">Generar Reporte</button>


<script>


        // Mostrar u ocultar los campos de Meses y Empresas según la opción seleccionada en "Consulta por"
        const consultaPorField = document.getElementById('consulta_por');

        consultaPorField.addEventListener('change', function() {
            const selectedOption = consultaPorField.value;
            const empresasField = document.getElementById('empresas_field');

            if (selectedOption === 'empresa') {
                empresasField.style.display = 'block';
            }
            else
            {
                empresasField.style.display = 'none';
            }
        });
</script>