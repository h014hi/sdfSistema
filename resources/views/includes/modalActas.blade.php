<!-- ********************* Modal Registrar Acta ************************* -->
<div class="modal fade" id="modalRegistrarActas" tabindex="-1" role="dialog" >
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-dialog-custom modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header"  style="background-color: #fb2d5b;;" id = "headmod">
                <h4 class="modal-title" id="myModalLabel"><b>REGISTRAR ACTA DE CONTROL</b></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body" style="padding: 40px;">

                <form id="formulario" action="{{ route('guardar.actas', ['id' => $id]) }}" method="POST">
                    @csrf
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
                                                    <option type="text" value="OPERADORTERMINAL">Operador de Terminal</option>
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
                                                    @foreach ($inspectores as $inspector)
                                                        @if($inspector->acreditado == "SI")
                                                        <option value= "{{$inspector->id}}">{{ $inspector->nombres}} {{$inspector->apellidos}}</option>
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

                            <!-- Campos de Infracción -->
                            <div id="infraccionFields">
                                <div class="flex-1 space-y-3 small_container">
                                    <label for="">Codigo:</label>
                                    <select required name="fracumfather" id="fracumfather" onchange="loadSubCodigo(this)"
                                        class="bg-white border border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500  w-full p-2.5 dark:focus:border-blue-500">
                                        <option value="" selected disabled>Seleccione</option>
                                        @foreach ($fracumfather as $item)
                                            <option value="{{$item->id}}">{{$item->codigo}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="flex-1 space-y-3 small_container">
                                    <label for="">SubCódigo:</label>
                                    <select required id="fracumson" name="fracumson" class="bg-white border border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500  w-full p-2.5 dark:focus:border-blue-500">
                                        <option value="Null" selected disabled> Seleccione</option>
                                    </select>
                                </div>
                            </div>
                            <div class="flex-1 space-y-3 small_container">
                                    <label for="">Retencion de documentos:</label>
                                    <input type="text" name="retencion" id="retencion" value="NINGUNA"
                                    class="bg-gray-50 border outline-none border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        placeholder="Detalles de retención" autocomplete="off">
                            </div>
                                <!--
                                <button class="btn btn-success btn-sm" onclick="agregarCampo()">
                                    Agregar
                                </button>
                                -->
                        </div>
                    </div>

                    <div class="space-y-3 mb-4 ">
                        <h2 class="font-bold">DATOS DEL CONDUCTOR <a id="alerta"></a></h2>
                        <hr style="border-top: 2px solid #000;">
                        <div class="space-x-3 flex justify-between ">
                            <div class="flex-1 space-y-3 small_container">
                                <label for="">DNI:</label>
                                <input type="number" name="n_documento" id="n_documento"
                                    class="bg-gray-50 border outline-none border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    placeholder="Ingrese su DNI" autocomplete="off" oninput="limitarDigitos(this,8)">
                            </div>

                            <div class=" flex-1 space-y-3 small_container">
                                <label for="">Nombres:</label>
                                <input type="text" name="nombres" id="nombres" value=''
                                    class="bg-gray-50 border outline-none border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    placeholder="Ingrese sus Nombres" autocomplete="off" >
                            </div>
                            <div class="flex-1 space-y-3 small_container">
                                <label for="">Apellidos:</label>
                                <input type="text" name="apellidos" value=''
                                    id="apellidos"
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
                                    <select required name="Letralic" class="bg-white-50 border border-gray-200 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-64 h-10 p-2.5 dark:focus:border-blue-500">
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
                </form>
            </div>
        </div>
    </div>
</div>

<!-- ********************* Modal Editar Acta ************************* -->

<div class="modal fade" id="modalEditarActas" tabindex="-1" role="dialog" >
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-dialog-custom modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header"  style="background-color: #fb2d5b;" id = "headmod">
                <h4 class="modal-title" id="myModalLabel"><b>EDITAR ACTA DE CONTROL</b></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body" style="padding: 40px;">
                <form id="formularioid" action="" method="POST">
                    @csrf
                    <div class="space-y-3 mb-4">
                        <h2 class="font-bold"></h2>
                        <div class="space-y-3">
                            <div class="space-y-3 mb-4">
                                <h2 class="font-bold">DATOS DEL ACTA:</h2>
                                <hr style="border-top: 2px solid #000;">
                                <div class="space-x-3 flex justify-between">

                                    <div class="flex-1 space-y-3 small_container" >
                                        <label for="estado">Estado del Acta</label>
                                        <select required name="condicion_id"  id="colorSelectedit" class="bg-white-50 border border-gray-200 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-64 h-10 p-2.5 dark:focus:border-blue-500">
                                            <option type="text" value="PENDIENTE">Pendiente</option>
                                            <option type="text" value="CONDESCARGO">Con Descargo</option>
                                            <option type="text" value="TRAMITADO">Tramitado</option>
                                            <option type="text" value="ARCHIVADO">Archivado</option>
                                            <option type="text" value="CONRDR">Con Resolucion</option>
                                        </select>
                                    </div>

                                    <div class="flex-1 space-y-3 small_container" >
                                        <label for="agente_infrac_edit">Agente Infractor</label>
                                        <select name="agente_infrac_edit" required id="agente_infrac_edit" class="bg-white-50 border border-gray-200 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-64 h-10 p-2.5 dark:focus:border-blue-500">
                                            <option type="text" value="CONDUCTOR">Conductor</option>
                                            <option type="text" value="TRANSPORTISTA">Transportista</option>
                                            <option type="text" value="OPERADOR DE TERMINAL">Operador de Terminal</option>
                                        </select>
                                    </div>

                                    <div class="flex-1 space-y-3 small_container">
                                            <label for="numero">N° de Acta:</label>
                                            <input type="text" name="actaedit" id="actaedit" required
                                                class="bg-gray-50 border outline-none border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                                placeholder="Ingrese número de acta de control">
                                    </div>

                                    <div class="flex-1 space-y-3 small_container">
                                    <label for="">Inspector</label>
                                        <select name="inspectoredit" value="" id="inspectoredit" required
                                            class="bg-white border border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:focus:border-blue-500">
                                            <option value="">Seleccione</option>
                                            @foreach ($inspectores as $item)
                                                        <option value= "{{$item->id}}">{{ $item->nombres}} {{$item->apellidos}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-3 mb-4">
                        <h2 class="font-bold">DATOS DE LA INFRACCIÓN</h2>
                        <hr style="border-top: 2px solid #000;">
                        <div class="space-x-3 flex justify-between">

                            <div id="infraFieldsv2" >
                                <div class="flex-1 space-y-3 small_container">
                                    <label for="">Codigo:</label>
                                    <select name="fracumfather_edit" id="fracumfather_edit" onchange="loadSubCodigov2(this)"
                                        class="bg-white border border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500  w-full p-2.5 dark:focus:border-blue-500">
                                        <option value="" selected disabled>Seleccione</option>
                                        @foreach ($fracumfather as $item)
                                            <option value="{{$item->id}}">{{$item->codigo}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="flex-1 space-y-3 small_container">
                                    <label for="">SubCódigo:</label>
                                    <select id="fracumson_edit" name="fracumson_edit" class="bg-white border border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500  w-full p-2.5 dark:focus:border-blue-500">
                                        <option value="Null" selected disabled>Seleccione</option>
                                    </select>
                                </div>
                            </div>
                            <div class="flex-1 space-y-3 small_container">
                                <label for="">Retencion de documentos:</label>
                                <input type="text" name="retencionedit" id="retencionedit" value="NINGUNA"
                                class="bg-gray-50 border outline-none border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    placeholder="Detalles de retención" autocomplete="off">
                            </div>
                        </div>
                    </div>

                    <div class="space-y-3 mb-4 ">
                        <h2 class="font-bold">DATOS DEL CONDUCTOR <a id="alerta"></a></h2>
                        <hr style="border-top: 2px solid #000;">
                        <div class="space-x-3 flex justify-between">
                            <div class="flex-1 space-y-3 small_container">
                                <label for="">DNI:</label>
                                <input type="text" name="dniedit" id="dniedit" value=""
                                    class="bg-gray-50 border outline-none border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    placeholder="Ingrese su DNI">
                            </div>

                            <div class="flex-1 space-y-3 small_container">
                                <label for="">Nombres:</label>
                                <input type="text" name="nombresedit" id="nombresedit" value=''
                                    class="bg-gray-50 border outline-none border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    placeholder="Ingrese sus Nombres">
                            </div>
                            <div class="flex-1 space-y-3 small_container">
                                <label for="">Apellidos:</label>
                                <input type="text" name="apellidosedit" value=''
                                    id="apellidosedit"
                                    class="bg-gray-50 border outline-none border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    placeholder="Ingrese sus Apellidos">
                            </div>
                        </div>
                    </div>

                    <div class="space-y-3 mb-4">
                        <h2 class="font-bold"><b>DATOS DE LA LICENCIA</b></h2>
                        <hr style="border-top: 2px solid #000;">
                        <div class="space-x-3 flex justify-between">

                            <div class="flex-1 space-y-3 small_container">
                                <label for="licencia">N° Licencia:</label>
                                <input type="text" name="licenciaedit" id="licenciaedit"
                                class="bg-gray-50 border outline-none border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                >
                            </div>

                            <div class="flex-1 space-y-3">
                                <label for="categoria">Categoria:</label>
                                <select required  name="categoriaedit" id="categoriaedit" class="bg-white-50 border border-gray-200 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-64 h-10 p-2.5 dark:focus:border-blue-500">
                                    <option type="text" value="AI">AI</option>
                                    <option type="text" value="A-IIa">A-IIa</option>
                                    <option type="text" value="A-IIb">A-IIb</option>
                                    <option type="text" value="A-IIIa">A-IIIa</option>
                                    <option type="text" value="A-IIIb">A-IIIb</option>
                                    <option type="text" value="A-IIIc">A-IIIc</option>
                                    <option value="DESCONOCIDO">Desconocido</option>
                                </select>
                            </div>

                            <div class="flex-1 space-y-3">
                                <label for="estadol">Estado de la licencia:</label>
                                <select name="estadoedit" id="estadoedit" class="bg-white-50 border border-gray-200 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-64 h-10 p-2.5 dark:focus:border-blue-500">
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
                                <select name="empresaedit" value="" id="empresaedit" required
                                    class="bg-white border border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:focus:border-blue-500">
                                    <option value="">Seleccione</option>
                                    <option value= "21">PERSONA NATURAL NO HAY EMPRESA</option>
                                    @foreach ($empresas as $item)
                                        <option value= "{{$item->id}}">{{ $item->razon_social}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="flex-1 space-y-3 small_container">
                                <label for="">Placa:</label>
                                <input type="text" name="placaedit" id="placaedit"
                                class="bg-gray-50 border outline-none border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    placeholder="Ingrese la Placa">
                            </div>

                            <div class="flex-1 space-y-3 small_container">
                                <label for="">Ruta:</label>
                                <input type="text" name="rutaedit" id="rutaedit"
                                class="bg-gray-50 border outline-none border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    placeholder="Ingrese su ruta">
                            </div>
                        </div>
                    </div>

                    <div class="space-y-1 mb-4">
                        <h2 class="font-bold">OBSERVACIONES</h2>
                        <hr style="border-top: 2px solid #000;">
                        <div class="space-x-3 flex justify-between">

                            <div class="space-y-3 mb-4">
                                <div class="space-x-3 flex justify-between">
                                    <div class="flex-1 space-y-3 small_container">
                                        <label for="">Observacion del Intervenido</label>
                                        <textarea type="text" name="obs_intervenidoedit" id="obs_intervenidoedit"
                                        class="bg-gray-50 border outline-none border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        placeholder="Ingrese alguna observaciones del intervenido"    rows="4"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="space-y-3 mb-4">
                                <div class="space-x-3 flex justify-between">
                                    <div class="flex-1 space-y-3 small_container">
                                        <label for="">Observaciones del Inspector</label>
                                        <textarea type="text" name="obs_inspectoredit" id="obs_inspectoredit"
                                        class="bg-gray-50 border outline-none border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                            placeholder="Ingrese alguna observaciones del inspector" rows="4"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="space-y-3 mb-4">
                                <div class="space-x-3 flex justify-between">
                                    <div class="flex-1 space-y-3 small_container">
                                        <label for="">Observaciones del Acta</label>
                                        <textarea type="text" name="obs_actaedit" id="obs_actaedit"
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
                </form>
            </div>
        </div>
    </div>
</div>
