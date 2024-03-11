<!-- ********************* Modal Registrar Empresas ************************* -->
<div class="modal fade" id="modalRegistrarEmpresas" tabindex="-1" role="dialog" >
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-dialog-custom modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">REGISTRAR EMPRESAS</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form id="formulario" action="{{ route('guardar-empresas') }}" method="POST">
                    @csrf
                    <fieldset>
                        <legend>Datos de la Empresa</legend>
                        <div class="space-y-3 mb-4">
                            <h2 class="font-bold"></h2>
                            <div class="space-y-3">
                                <div class="space-y-3 mb-4">
                                    <div class="space-x-3 flex justify-between">
                                        <div class="flex-1 space-y-3">
                                            <label for="">Razon Social</label>
                                            <input type="text" name="razon_social" id="razon_social"
                                                class="bg-gray-50 border outline-none border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                placeholder="Ingrese la razon social">
                                        </div>
                                        <div class="flex-1 space-y-3">
                                            <label for="">RUC</label>
                                            <input type="text" name="ruc" id="ruc"
                                                class="bg-gray-50 border outline-none border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                placeholder="Ingrese la RUC">
                                        </div>
                                    </div>
                                    <div class="space-x-3 flex justify-between">
                                        <div class="flex-1 space-y-3">
                                            <label for="">Resolucion de Funcionamiento</label>
                                            <input type="text" name="res_funcionamiento" id="res_funcionamiento"
                                                class="bg-gray-50 border outline-none border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                placeholder="Ingrese el numero de resolucion">
                                        </div>
                                        <div class="flex-1 space-y-3">
                                            <label for="">N° Partida Electronica</label>
                                            <input type="text" name="partida_electronica" id="partida_electronica"
                                                class="bg-gray-50 border outline-none border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                placeholder="Ingrese N° de partida electronica">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset>
                        <legend>Datos del representante legal</legend>
                        <div class="space-y-3 mb-4">
                        <div class="space-x-3 flex justify-between">
                            <div class="flex-1 space-y-3">
                                    <label for="">DNI</label>
                                    <input type="text" name="dni_rep_legal" id="dni_rep_legal"
                                        class="bg-gray-50 border outline-none border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="Ingrese el DNI">
                                </div>
                                <div class="flex-1 space-y-3">
                                    <label for="">Nombres</label>
                                    <input type="text" name="nombres_rep_legal" id="nombres_rep_legal"
                                        class="bg-gray-50 border outline-none border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="Ingrese los nombres">
                                </div>
                                <div class="flex-1 space-y-3">
                                    <label for="">Apellidos</label>
                                    <input type="text" name="apellidos_rep_legal" id="apellidos_rep_legal"
                                        class="bg-gray-50 border outline-none border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="Ingrese los apellidos">
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset>
                        <legend>Otros Datos</legend>
                        <div class="space-y-3 mb-4">
                            <div class="space-x-3 flex justify-between">
                                    <div class="flex-1 space-y-3">
                                        <label for="">Celular</label>
                                        <input type="text" name="numero_celular" id="numero_celular"
                                            class="bg-gray-50 border outline-none border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="Ingrese el celular">
                                    </div>
                                    <div class="flex-1 space-y-3">
                                        <label for="">Domicilio</label>
                                        <input type="text" name="domicilio" id="domicilio"
                                            class="bg-gray-50 border outline-none border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="Ingrese el domicilio">
                                    </div>
                                </div>
                            </div>
                    </fieldset>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" data-dismiss="modal" style = "background-color: #EC7518; color:white;">Cerrar</button>
                        <button type="submit" class="btn btn-primary" style = "background-color: #187BEC;" >Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- ********************* Modal Editar Empresas ************************* -->
<div class="modal fade" id="modalEditarEmpresas" tabindex="-1" role="dialog" >
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-dialog-custom modal-xl" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Editar Empresas</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form id="formularioid" action="" method="POST">
                    @csrf
                    <div class="space-y-3 mb-4">
                        <div class="space-y-3">
                            <div class="space-y-3 mb-4">
                                <h2 class="font-bold">Datos de la Empresa</h2>
                                <div class="space-x-3 flex justify-between">
                                    <div class="flex-1 space-y-3">
                                        <label for="">Razon Social</label>
                                        <input type="text" name="razon_social" id="razon_socialedit" value=""
                                            class="bg-gray-50 border outline-none border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="Ingrese la Provincia">
                                    </div>
                                    <div class="flex-1 space-y-3">
                                        <label for="">RUC</label>
                                        <input type="text" name="ruc" id="rucedit" value=""
                                            class="bg-gray-50 border outline-none border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="Ingrese su Correo Institucional">
                                    </div>
                                </div>
                                <div class="space-x-3 flex justify-between">
                                    <div class="flex-1 space-y-3">
                                        <label for="">esolucion de Funcionamiento</label>
                                        <input type="text" name="res_funcionamiento" id="res_funcionamientoedit" value=""
                                            class="bg-gray-50 border outline-none border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="Ingrese el N° de Resolucion">
                                    </div>
                                    <div class="flex-1 space-y-3">
                                        <label for="">Partida Electronica</label>
                                        <input type="text" name="partida_electronica" id="partida_electronicaedit" value=""
                                            class="bg-gray-50 border outline-none border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="Ingrese N° de partida electronica">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="space-y-3 mb-4">
                        <h2 class="font-bold">Datos del representante legal</h2>
                        <div class="space-x-3 flex justify-between">

                            <div class="flex-1 space-y-3">
                                <label for="">Nombres</label>
                                <input type="text" name="nombres_rep_legal" id="nombres_rep_legaledit" value=""
                                    class="bg-gray-50 border outline-none border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Ingrese su Correo Institucional">
                            </div>
                            <div class="flex-1 space-y-3">
                                <label for="">Apellidos</label>
                                <input type="text" name="apellidos_rep_legal" id="apellidos_rep_legaledit" value=""
                                    class="bg-gray-50 border outline-none border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    >
                            </div>
                            <div class="flex-1 space-y-3">
                                <label for="">DNI</label>
                                <input type="text" name="dni_rep_legal" id="dni_rep_legaledit"
                                    class="bg-gray-50 border outline-none border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Ingrese la Provincia">

                            </div>
                        </div>
                    </div>
                    <div class="space-y-3 mb-4">
                        <h2 class="font-bold">Otros Datos</h2>
                        <div class="space-x-3 flex justify-between">
                            <div class="flex-1 space-y-3">
                                <label for="">Telefono</label>
                                <input type="text" name="numero_celular" id="numero_celularedit" value=""
                                    class="bg-gray-50 border outline-none border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Ingrese su Correo Institucional">
                            </div>
                            <div class="flex-1 space-y-3">
                                <label for="">Domicilio</label>
                                <input type="text" name="domicilio" id="domicilioedit"
                                    class="bg-gray-50 border outline-none border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Ingrese su Correo Institucional" value="">
                            </div>
                        </div>
                    </div>
                    <dsiv class="modal-footer">
                        <button type="button" class="btn btn-warning" data-dismiss="modal" style = "background-color: #EC7518; color:white;">Cerrar</button>
                        <button type="submit" class="btn btn-primary" style = "background-color: #187BEC;" >Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
