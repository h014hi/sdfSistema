<!-- ************************************* MODALES INSPECTORES ****************************************** -->
<!-- ********************* Modal Registrar Inspector ************************* -->
<div class="modal fade" id="modalRegistrarInspector" tabindex="-1" role="dialog" >
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-dialog-custom modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Registrar Inspectores</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form id="formulario" action="{{ route('guardar-datos') }}" method="POST">
                    @csrf
                    <div class="space-y-3 mb-4">
                        <div class="space-y-3">
                            <div class="space-y-3 mb-4">
                                <h2 class="font-bold">Datos del Inspector</h2>
                                <div class="space-x-3 flex justify-between">
                                        <div class="flex-1 space-y-3">
                                            <label for="">Nombres</label>
                                            <input type="text" name="nombres" id="nombres"
                                                class="bg-gray-50 border outline-none border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                placeholder="Ingrese nombre">
                                        </div>
                                        <div class="flex-1 space-y-3">
                                            <label for="">Apellido Paterno</label>
                                            <input type="text" name="apellidos" id="apellidos"
                                                class="bg-gray-50 border outline-none border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                placeholder="Ingrese apellidos">
                                        </div>
                                </div>
                                <div class="space-x-3 flex justify-between">
                                    <div class="flex-1 space-y-3">
                                        <label for="">DNI</label>
                                        <input type="text" name="inspecdni" id="inspecdni"
                                            class="bg-gray-50 border outline-none border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="Ingrese DNI">
                                    </div>
                                    <div class="flex-1 space-y-3">
                                        <label for="">Telefono</label>
                                        <input type="text" name="telefono" id="telefono"
                                            class="bg-gray-50 border outline-none border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="Ingrese telefono">
                                    </div>
                                </div>
                                <div class="space-x-3 flex justify-between">
                                    <div class="flex-1 space-y-3">
                                        <label for="">N° RDR de Autorizacion</label>
                                        <input type="text" name="rdrauto" id="rdrauto"
                                            class="bg-gray-50 border outline-none border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="Ingrese N° de RDR de autorizacion">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-3 mb-4">
                        <h2 class="font-bold">ESTADO DEL INSPECTOR</h2>
                        <div class="space-x-3 flex justify-between">
                            <div class="flex-1 space-y-3">
                                <label for="">ESTA ACREDITADO PARA TRABAJO DE CAMPO (SI/NO)</label>
                                <input type="text" name="acreditado" id="acreditado"
                                    class="bg-gray-50 border outline-none border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    value="SI" placeholder="Escriba si o no">
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

<!-- ********************* Modal Editar Inspector ************************* -->
<div class="modal fade" id="modalEditarInspector" tabindex="-1" role="dialog" >
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-dialog-custom modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Editar Inspectores</h4>
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
                                <h2 class="font-bold">Datos del Inspector</h2>
                                <div class="space-x-3 flex justify-between">
                                    <div class="flex-1 space-y-3">
                                        <label for="">Nombres</label>
                                        <input type="text" name="nombres" id="nombresedit"
                                            class="bg-gray-50 border outline-none border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="Ingrese nombre" value="">
                                    </div>
                                    <div class="flex-1 space-y-3">
                                        <label for="">Apellido Paterno</label>
                                        <input type="text" name="apellidos" id="apellidosedit"
                                            class="bg-gray-50 border outline-none border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="Ingrese apellidos">
                                    </div>
                                </div>
                                <div class="space-x-3 flex justify-between">
                                    <div class="flex-1 space-y-3">
                                        <label for="">DNI</label>
                                        <input type="text" name="inspecdni" id="inspecdniedit"
                                            class="bg-gray-50 border outline-none border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="Ingrese DNI">
                                    </div>
                                    <div class="flex-1 space-y-3">
                                        <label for="">Telefono</label>
                                        <input type="text" name="telefono" id="telefonoedit"
                                            class="bg-gray-50 border outline-none border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="Ingrese telefono">
                                    </div>
                                </div>
                                <div class="space-x-3 flex justify-between">
                                    <div class="flex-1 space-y-3">
                                        <label for="">N° RDR de Autorizacion</label>
                                        <input type="text" name="rdrauto" id="rdrautoedit"
                                            class="bg-gray-50 border outline-none border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="Ingrese N° de RDR de autorizacion">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-3 mb-4">
                        <h2 class="font-bold">ESTADO DEL INSPECTOR</h2>
                        <div class="space-x-3 flex justify-between">
                            <div class="flex-1 space-y-3">
                                <label for="">ESTA ACREDITADO PARA TRABAJO DE CAMPO (SI/NO)</label>
                                <input type="text" name="acreditado" id="acreditadoedit"
                                    class="bg-gray-50 border outline-none border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Ingrese telefono">
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
