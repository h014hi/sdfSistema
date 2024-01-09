<script>
    function changeColor() {
    var select = document.getElementById("colorSelect");
    var div2 = document.getElementById("headmod");

    if(select.value == "CONDESCARGO")
    {
    div2.style.backgroundColor = "orange";
    }

    if(select.value == "ARCHIVADO")
    {
    div2.style.backgroundColor = "#2bd390";
    }

    if(select.value == "TRAMITADO")
    {
    div2.style.backgroundColor = "#248ef3";
    }

    if(select.value == "PENDIENTE")
    {
    div2.style.backgroundColor = "#fb2d5b";
    }
    if(select.value == "CONRDR")
    {
    div2.style.backgroundColor = "ligthblue";
    }
    }


    function consultarDatosDNI(dni) {
        // Realiza la solicitud HTTP a la API
        fetch('http://127.0.0.1:8000/conductores/' + dni)
            .then(response => response.json())
            .then(data => {
            // Verifica si la respuesta tiene los campos necesarios
            if (data.nombres && data.apellidos) {
                // Actualiza los campos de nombres y apellidos con los datos obtenidos
                var tituloElement = document.getElementById('alerta');
                tituloElement.style.color = 'red';
                tituloElement.innerHTML = '(REINCIDENTE) El conductor esta volviendo a cometer una infracción';

                document.getElementById('first_name').value = data.nombres;
                document.getElementById('first_apellido').value = data.apellidos;
            } else {
                document.getElementById('first_name').value = "NO SE ENCONTRÓ EN LA API";
                document.getElementById('first_apellido').value = "NO SE ENCONTRÓ EN LA API";
            }
            })
            .catch(error => {
                var tituloElement = document.getElementById('alerta');
                tituloElement.style.color = 'black';
                tituloElement.innerHTML = '';
            document.getElementById('first_name').value = "";
            document.getElementById('first_apellido').value = "";

            });
            }

        function consultarPlaca(placa) {
        // Realiza la solicitud HTTP a la API
        fetch('http://127.0.0.1:8000/placas/' + placa)
            .then(response => response.json())
            .then(data => {
            // Verifica si la respuesta tiene los campos necesarios
            if (data.placa) {

                var tituloElement = document.getElementById('alertados');
                tituloElement.style.color = 'green';
                tituloElement.innerHTML = 'El vehiculo vuelve a ser intervenido';

            }
            })
            .catch(error => {
                var tituloElement = document.getElementById('alertados');
                tituloElement.style.color = 'black';
                tituloElement.innerHTML = '';
            });
            }

        function limitarDigitos(inputElement, maxLength) {
            let inputValue = inputElement.value;
            inputValue = inputValue.slice(0, maxLength);
            inputElement.value = inputValue;
        }
</script>


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" >
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-dialog-custom modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header"  style="background-color: #fb2d5b;;" id = "headmod">
                <h4 class="modal-title" id="myModalLabel"><b>REGISTRAR ACTA DE CONTROL</b></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
<div class="modal-body" style="padding: 40px;">
<form id="formulario" action="{{ route('guardar.actas', ['id' => $id]) }}" method="GET">

@csrf
          <!--desde aqui es el formulario-->

          <div class="space-y-3 mb-4">
            <h2 class="font-bold"></h2>
                    <div class="space-y-3">
                        <div class="space-y-3 mb-4">
                            <h2 class="font-bold">DATOS DEL ACTA:</h2>
                            <hr style="border-top: 2px solid #000;">
                                <div class="space-x-3 flex justify-between">

                                    <div class="flex-1 space-y-3 small_container">
                                        <label for="estado" >Estado del Acta</label>
                                        <select name="condicion_id"  id="colorSelect" required onchange="changeColor()" class="bg-white-50 border border-gray-200 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-64 h-10 p-2.5 dark:focus:border-blue-500">
                                            <option type="text" value="" selected disabled>Seleccione</option>
                                            <option type="text" value="PENDIENTE">Pendiente</option>
                                            <option type="text" value="CONDESCARGO">Con Descargo</option>
                                            <option type="text" value="TRAMITADO">Tramitado</option>
                                            <option type="text" value="ARCHIVADO">Archivado</option>
                                            <option type="text" value="CONRDR">Con Resolucion</option>
                                        </select>
                                    </div>

                                    <div class="flex-1 space-y-3 small_container" >
                                        <label for="agente_infrac">Agente Infractor</label>
                                        <select name="agente_infrac" required id="agente_infrac" class="bg-white-50 border border-gray-200 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-64 h-10 p-2.5 dark:focus:border-blue-500">
                                            <option type="text" value="CONDUCTOR">Conductor</option>
                                            <option type="text" value="TRANSPORTISTA" selected>Transportista</option>
                                            <option type="text" value="OPERADOR DE TERMINAL">Operador de Terminal</option>
                                        </select>
                                    </div>

                                    <div class="flex-1 space-y-3 small_container">
                                            <label for="">N° de Acta:</label>
                                            <input type="number" name="acta" id="acta_de_control"
                                                class="bg-gray-50 border outline-none border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                                placeholder="Ingrese número de acta de control"
                                                autocomplete="off" required
                                                oninput="limitarDigitos(this,7)"
                                                required>
                                    </div>

                                    <div class="flex-1 space-y-3 small_container">
                                    <label for="">Inspector:</label>
                                        <select name="inspector" value="" id="" required
                                            class="bg-white border border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:focus:border-blue-500">
                                            <option value="" disabled selected>Seleccione</option>
                                            @foreach ($inspectores as $item)
                                                @if($item->telefono == "SI")
                                                <option value= "{{$item->id}}">{{ $item->nombres}} {{$item->apellidos}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                        </div>
                    </div>
        </div>

        <div class="space-y-3 mb-4">
            <h2 class="font-bold">DATOS DE LA INFRACCIÓN/INCUMPLIMIENTO</h2>
            <hr style="border-top: 2px solid #000;">
            <div class="space-x-3 flex justify-between">

            <div class="flex-1 space-y-3 small_container">
                <label for="">Seleccione:</label>
                <select name="seleccion" id="seleccion" onchange="toggleFields(this)"
                    class="bg-white border border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-24 p-2.5 dark:focus:border-blue-500">
                    <option value="">Seleccione</option>
                    <option value="infraccion">Infracción</option>
                    <option value="incumplimiento">Incumplimiento</option>
                </select>
            </div>

            <!-- Campos de Infracción -->
            <div id="infraccionFields" style="display: none;">
                <div class="flex-1 space-y-3 small_container">
                    <label for="">Infracción:</label>
                    <select name="infraccion" id="infraccion" onchange="loadSubCodigo(this, 'infraccion')"
                        class="bg-white border border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500  w-full p-2.5 dark:focus:border-blue-500">
                        <option value="" selected disabled>Seleccione</option>
                        @foreach ($infra as $item)
                            <option value="{{$item->id}}">{{$item->codigo}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="flex-1 space-y-3 small_container">
                    <label for="">SubCódigo:</label>
                    <select id="infra_sub" name="infra_sub" class="bg-white border border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500  w-full p-2.5 dark:focus:border-blue-500">
                        <option value="Null" selected disabled>Seleccione</option>
                    </select>
                </div>
            </div>

            <!-- Campos de Incumplimiento -->
            <div id="incumplimientoFields" style="display: none;">
                <div class="flex-1 space-y-3 small_container">
                    <label for="">Incumplimiento:</label>
                    <select name="incumplimiento" id="incumplimiento" onchange="loadSubCodigo(this, 'incumplimiento')"
                        class="bg-white border border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500  w-full p-2.5 dark:focus:border-blue-500">
                        <option value="" selected disabled>Seleccione</option>
                        @foreach ($incum as $item)
                            <option value="{{$item->id}}">{{$item->codigo}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="flex-1 space-y-3 small_container">
                    <label for="">Articulo:</label>
                    <select id="incum_sub" name="incum_sub" class="bg-white border border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500  w-full p-2.5 dark:focus:border-blue-500">
                        <option value="Null" selected disabled>Seleccione</option>
                    </select>
                </div>
            </div>

            <!-------------------------------------------------------------->

            <div class="flex-1 space-y-3 small_container">
                    <label for="">Retencion de documentos:</label>
                    <input type="text" name="retencion" id="retencion" value="NINGUNA"
                    class="bg-gray-50 border outline-none border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder="Detalles de retención" autocomplete="off">
            </div>
            <!-------------------------------->
            <!-- Botón para añadir más campos -->
            <button class="btn btn-success btn-sm" onclick="agregarCampo()">
                Agregar
            </button>

        </div>
    </div>

                    <div class="space-y-3 mb-4 ">
                    <h2 class="font-bold">DATOS DEL CONDUCTOR <a id="alerta"></a></h2>
                    <hr style="border-top: 2px solid #000;">
                    <div class="space-x-3 flex justify-between ">
                        <div class="flex-1 space-y-3 small_container">
                            <label for="">DNI:</label>
                            <input type="number" name="dni" id="dni" value=""
                                class="bg-gray-50 border outline-none border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="Ingrese su DNI" autocomplete="off" oninput="limitarDigitos(this,8)">
                        </div>

                        <div class=" flex-1 space-y-3 small_container">
                            <label for="">Nombres:</label>
                            <input type="text" name="nombres" id="first_name" value=''
                                class="bg-gray-50 border outline-none border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="Ingrese sus Nombres" autocomplete="off" >
                        </div>
                        <div class="flex-1 space-y-3 small_container">
                            <label for="">Apellidos:</label>
                            <input type="text" name="apellidos" value=''
                                id="first_apellido"
                                class="bg-gray-50 border outline-none border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="Ingrese sus Apellidos" autocomplete="off" >
                        </div>
                    </div>
                </div>

    <div class="space-y-3 mb-4">
        <h2 class="font-bold"><b>DATOS DE LA LICENCIA</b></h2>
        <hr style="border-top: 2px solid #000;">
    <div class="space-x-3 flex justify-between">

            <div class="flex-1 space-y-3 small_container" >
                <label for="Letral">Letra Licencia:</label>
                <select required name="Letral" class="bg-white-50 border border-gray-200 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-64 h-10 p-2.5 dark:focus:border-blue-500">
                    @foreach (range('A', 'Z') as $letter)
                        <option value="{{ $letter }}" {{ $letter === 'U' ? 'selected' : '' }}>{{ $letter }}</option>
                    @endforeach
                    <option value="000000000">Desconocido</option>
                </select>
            </div>

            <div class="flex-1 space-y-3 small_container">
                <label for="categoria">Categoria:</label>
                <select required  name="categoria"  class="bg-white-50 border border-gray-200 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-64 h-10 p-2.5 dark:focus:border-blue-500">
                    <option type="text" value="AI">AI</option>
                    <option type="text" value="A-IIa">A-IIa</option>
                    <option type="text" value="A-IIb" selected>A-IIb</option>
                    <option type="text" value="A-IIIa">A-IIIa</option>
                    <option type="text" value="A-IIIb">A-IIIb</option>
                    <option type="text" value="A-IIIc">A-IIIc</option>
                    <option value="DESCONOCIDO">Desconocido</option>
                </select>
            </div>

            <div class="flex-1 space-y-3 small_container">
                <label for="estadol">Estado de la licencia:</label>
                <select required name="estadol" class="bg-white-50 border border-gray-200 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-64 h-10 p-2.5 dark:focus:border-blue-500">
                    <option type="text" value="VIGENTE">VIGENTE</option>
                    <option type="text" value="VENCIDO">VENCIDO</option>
                    <option type="text" value="ENTRAMITE">EN TRAMITE</option>
                    <option type="text" value="DESCONOCIDO">DESCONOCIDO</option>
                </select>
            </div>

        </div>
    </div>

    <div class="space-y-3 mb-4">
    <h2 class="font-bold">DATOS DEL VEHICULO <a id="alertados"></a></h2>
    <hr style="border-top: 2px solid #000;">
    <div class="space-x-3 flex justify-between">

            <div class="flex-1 space-y-3 small_container">
                <label for="">Empresa:</label>
                <select name="empresas" value="" id="" required
                    class="bg-white border border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:focus:border-blue-500">
                    <option value="" selected disabled>Seleccione</option>
                    <option value= "21">PERSONA NATURAL NO HAY EMPRESA</option>
                    @foreach ($empresas as $item)
                        <option value= "{{$item->id}}">{{ $item->razon_social}}</option>
                    @endforeach
                </select>
            </div>


            <div class="flex-1 space-y-3 small_container">
                <label for="">Placa:</label>
                <input type="text" name="placa" id="placa"
                class="bg-gray-50 border outline-none border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    placeholder="Ingrese la Placa" onchange="consultarPlaca(this.value)" autocomplete="off"  oninput="limitarDigitos(this,7)">
            </div>

            <div class="flex-1 space-y-3 small_container">
                <label for="">Ruta:</label>
                <input type="text" name="ruta" id="ruta"
                class="bg-gray-50 border outline-none border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    placeholder="Ingrese su ruta" autocomplete="off" >
            </div>
        </div>
    </div>


        <div class="space-y-1 mb-4" >
            <h2 class="font-bold">OBSERVACIONES</h2>
            <hr style="border-top: 2px solid #000;">
            <div class="space-x-3 flex justify-between">

                <div class="space-y-3 mb-4">
                    <div class="space-x-3 flex justify-between">
                        <div class="flex-1 space-y-3 small_container" >
                            <label for="">Observacion del Intervenido</label>
                            <textarea type="text" name="obs_intervenido" id="obs_intervenido"
                            class="bg-gray-50 border outline-none border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    placeholder="Ingrese alguna observaciones del intervenido"rows="4"></textarea>
                        </div>
                    </div>
                </div>
                <div class="space-y-3 mb-4">
                    <div class="space-x-3 flex justify-between">
                        <div class="flex-1 space-y-3 small_container" >
                            <label for="">Observaciones del Inspector</label>
                            <textarea type="text" name="obs_inspector" id="obs_inspector"
                            class="bg-gray-50 border outline-none border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="Ingrese alguna observaciones del inspector" rows="4"></textarea>
                        </div>
                    </div>
                </div>
                <div class="space-y-3 mb-4">
                    <div class="space-x-3 flex justify-between">
                        <div class="flex-1 space-y-3 small_container" >
                            <label for="">Observaciones del Acta</label>
                            <textarea type="text" name="obs_acta" id="obs_acta"
                            class="bg-gray-50 border outline-none border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="Ingrese alguna observaciones del Acta" rows="4"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-dismiss="modal" style = "background-color: #EC7518; color:white;">Cerrar</button>
                <button type="submit" class="btn btn-primary" style = "background-color: #187BEC;" >Guardar</button>
            </div>
            </div>
        </div>
        </div>
        </form>
</div>





<!--NAVAR DE LAS ACTAS-->
<div class="row col-md-12" style="margin: 10px 0px 0px -15px;">

  <div class="col-auto">
        <a href="{{ route('operativos') }}" class="btn btn-danger">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="23" fill="currentColor" class="bi bi-box-arrow-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0v2z"/>
                    <path fill-rule="evenodd" d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z"/>
                    </svg>
        </a>

        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal" style="background-color: #187BEC;">
         Registrar Acta
        </button>

  </div>
</div>
<br>

<!--tabla de registros-->
    <div class="col-md-12 table-responsive">
                <table class="table" style="font-size: 75%; text-align: center;">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">ITEM</th>
                        <th scope="col">N° DE ACTA</th>
                        <th scope="col">RAZON SOCIAL</th>
                        <th scope="col">N° DE PLACA</th>
                        <th scope="col">RUTA</th>
                        <th scope="col">NOMBRE DEL CONDUCTOR</th>
                        <th scope="col">LICENCIA / CATEGORIA</th>
                        <th scope="col">ESTADO</th>
                        <th scope="col">INSPECTOR</th>
                        <th scope="col">FALTA</th>
                        <th scope="col">RETENCION</th>
                        <th scope="col">OBSERVACIONES</th>
                        <th scope="col">ESTADO</th>
                        <th scope="col">ACCIONES</th>
                    </tr>
                    </thead>
                    <x-z01_tabla_actas_admin :operativo="$operativo" :resultados="$resultados" :inspectores="$inspectores" :empresas="$empresas" :conductores="$conductores" :infra="$infra" :incum="$incum" :infracciones="$infracciones" :vehiculos="$vehiculos" :pagos="$pagos"/>

                </table>
    </div>


<style>
    /* Hide the stepper arrows for number input */
    input[type="number"]::-webkit-inner-spin-button,
    input[type="number"]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    input[type="number"] {
        -moz-appearance: textfield;
    }
    .small_container{
        margin-right: 10px;
    }
</style>

<script>
    function toggleFields(select) {
        var selectedValue = select.value;
        // Mostrar u ocultar campos según la selección
        var infraccionFields = document.getElementById('infraccionFields');
        var incumplimientoFields = document.getElementById('incumplimientoFields');

        if (selectedValue === 'infraccion') {
            infraccionFields.style.display = 'block';
            incumplimientoFields.style.display = 'none';
        } else if (selectedValue === 'incumplimiento') {
            infraccionFields.style.display = 'none';
            incumplimientoFields.style.display = 'block';
        } else {
            // En caso de que no se haya seleccionado nada
            infraccionFields.style.display = 'none';
            incumplimientoFields.style.display = 'none';
        }
    }

    // Select Anidado
    function loadSubCodigo(codigo, tipo) {
        let codigoId = codigo.value;
        let temproute = (tipo === 'infraccion') ? 'infra' : 'incum';

        fetch('/' + temproute + '/' + codigoId)
            .then(function (response) {
                return response.json();
            })
            .then(function (jsonData) {
                buildSelectInfra_incum(jsonData, tipo);
            });
    }

    function buildSelectInfra_incum(infra_incums, tipo) {
        let subId = (tipo === 'infraccion') ? 'infra_sub' : 'incum_sub';
        let infra_incumSelect = document.getElementById(subId);

        clearSelect(infra_incumSelect);


        infra_incums.forEach(function (infra_incum) {


            let optiontag = document.createElement('option');
            optiontag.value = infra_incum.id;

            if (tipo === 'infraccion') {
                optiontag.innerHTML = infra_incum.sub_cod;
            } else {
                optiontag.innerHTML = infra_incum.articulo;
            }

            infra_incumSelect.append(optiontag);
        });
    }

    function clearSelect(select){
        while(select.options.length > 1){
            select.remove(1);
        }
    }

    //Para agregar
    let contadorInfraccion = 1; // Contador para nombres únicos de campos

    function agregarCampo() {
        // Clonar el campo existente (puedes cambiar esto según la lógica específica)
        let nuevoCampo = document.getElementById("infraccionFields").cloneNode(true);

        // Incrementar el contador y actualizar los IDs y nombres únicos
        contadorInfraccion++;
        nuevoCampo.id = "infraccionFields_" + contadorInfraccion;

        // Limpiar los valores de los campos clonados
        nuevoCampo.querySelector("#infraccion").value = "";
        nuevoCampo.querySelector("#infra_sub").value = "Null";

        // Añadir el nuevo campo al final del contenedor
        document.getElementById("infraccionFields").after(nuevoCampo);

        // También puedes cambiar la lógica para cambiar el tipo del campo según tus necesidades
        // En este ejemplo, simplemente cambio el nombre y el ID del campo clonado
        nuevoCampo.id = "incumplimientoFields_" + contadorInfraccion;
        nuevoCampo.querySelector("#infraccion").id = "incumplimiento";
        nuevoCampo.querySelector("#infra_sub").id = "incum_sub";

        // Añadir el nuevo campo al final del contenedor
        document.getElementById("infraccionFields").after(nuevoCampo);
    }

</script>
