<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-dialog-custom modal-lg" role="document" >
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Editar Registro</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="flex justify-end space-x-2 rounded-md p-2.5">
                <div class="relative">
                    <label for="">Estado del Acta</label>
                    <select name="condicion_id" velue="" id="countries" class="bg-white-50 border border-gray-200 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-64 h-10 p-2.5 dark:focus:border-blue-500">
                        <option value="">Seleccione</option>
                        <option value="1">Infracción</option>
                        <option value="2">Incumplimiento</option>
                    </select>
                </div>
            </div>
            
            <div class="modal-body">    
          <!--desde aqui es el formulario--> 
          <div class="space-y-3 mb-4">
            <h2 class="font-bold"></h2>
                    <div class="space-y-3">
                        <div class="space-y-3 mb-4">
                            <h2 class="font-bold">Datos del Acta</h2>
                        <div class="space-x-3 flex justify-between">  
                            <div class="flex-1 space-y-3">
                                    <label for="">Nro de Acta</label>
                                    <input type="text" name="provincia" id="provinac"
                                        class="bg-gray-50 border outline-none border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="Ingrese la Provincia">
                                </div>
                                <div class="flex-1 space-y-3">
                                    <label for="">Fecha</label>
                                    <input type="text" name="correoinst" id="correoinst"
                                        class="bg-gray-50 border outline-none border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="Ingrese su Correo Institucional">
                                </div>
                                <div class="flex-1 space-y-3">
                                    <label for="">Lugar </label>
                                    <input type="text" name="correoinst" id="correoinst"
                                        class="bg-gray-50 border outline-none border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="Ingrese su Correo Institucional">
                                </div>
                            </div>
                            </div>
                         </div>       
                     </div>

        <div class="space-y-3 mb-4">
            <h2 class="font-bold">Datos de la Infraccion</h2>
            <div class="space-x-3 flex justify-between">

            <div class="flex-1 space-y-3">    
            <label for="">Tipo</label>
            <select name="condicion_id" velue="" id="countries"
                class="bg-white-50 border border-gray-200 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:focus:border-blue-500">
                <option value="">Seleccione</option>
                <option value="1">Infraccion</option>
                <option value="2">Incumplimiento</option>
            </select>
        </div>

            <div class="flex-1 space-y-3">
                <label for="">Codigo de Infraccion</label>
                <select name="facultad_id" value=""
                    class="bg-gray-50 border border-white-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option selected>Seleccione</option>
                </select>
            </div>       
        </div>
    </div>

    <div class="space-y-3 mb-4">
        <h2 class="font-bold">Datos del Conductor</h2>
        <div class="space-x-3 flex justify-between">
            <div class="flex-1 space-y-3">
                <label for="">DNI</label>
                <input type="number" name="dni" id="dni" value=''
                    class="bg-gray-50 border outline-none border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 pointer-events-none cursor-not-allowed "
                    placeholder="Ingrese su DNI" readonly>
            </div>
            <div class="flex-1 space-y-3">
                <label for="">Nombres</label>
                <input type="text" name="nombres" id="first_name" value=''
                    class="bg-gray-50 border outline-none border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 cursor-not-allowed pointer-events-none"
                    placeholder="Ingrese sus Nombres" readonly>
            </div>
            <div class="flex-1 space-y-3">
                <label for="">Apellidos</label>
                <input type="text" name="apellidos" value=''
                    id="first_apelli"
                    class="bg-gray-50 border outline-none border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 cursor-not-allowed pointer-events-none"
                    placeholder="Ingrese sus Apellidos" readonly>
            </div>
        </div>
    </div>

    <div class="space-y-3 mb-4">
    <h2 class="font-bold">Datos del vehiculo</h2>
    <div class="space-x-3 flex justify-between">  
        <div class="flex-1 space-y-3">
                <label for="">PLACA</label>
                <input type="text" name="provincia" id="provinac"
                    class="bg-white-50 border outline-none border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 white:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Ingrese la Provincia">
            </div>
            <div class="flex-1 space-y-3">
                <label for="">Empresa</label>
                <input type="text" name="correoinst" id="correoinst"
                    class="bg-gray-50 border outline-none border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Ingrese su Correo Institucional">
            </div>
            <div class="flex-1 space-y-3">
                <label for="">Ruta</label>
                <input type="text" name="correoinst" id="correoinst"
                    class="bg-gray-50 border outline-none border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Ingrese su Correo Institucional">
            </div>
        </div>
    </div>

    <div class="space-y-3 mb-4">
        <h2 class="font-bold">Datos de la licencia</h2>
    <div class="space-x-3 flex justify-between">  
        <div class="flex-1 space-y-3">
                <label for="">Licencia</label>
                <input type="text" name="provincia" id="provinac"
                    class="bg-gray-50 border outline-none border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Ingrese la Provincia">
            </div>
            <div class="flex-1 space-y-3">
                <label for="">Clase y categoria</label>
                <input type="text" name="correoinst" id="correoinst"
                    class="bg-gray-50 border outline-none border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Ingrese su Correo Institucional">
            </div>
            <div class="flex-1 space-y-3">
                <label for="">Estado</label>
                <input type="text" name="correoinst" id="correoinst"
                    class="bg-gray-50 border outline-none border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Ingrese su Correo Institucional">
            </div>
        </div>
    </div>
            
        <div class="space-y-3 mb-4">
        <h2 class="font-bold">Otros datos</h2>
        <div class="space-x-3 flex justify-between">  
            <div class="flex-1 space-y-3">
                    <label for="">Inspector</label>
                    <input type="text" name="provincia" id="provinac"
                        class="bg-gray-50 border outline-none border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Ingrese la Provincia">
                </div>
                <div class="flex-1 space-y-3">
                    <label for="">Retencion de documentos</label>
                    <input type="text" name="correoinst" id="correoinst"
                        class="bg-gray-50 border outline-none border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Ingrese su Correo Institucional">
                </div>
            </div>
        </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-dismiss="modal" style = "background-color: #EC7518; color:white;">Cerrar</button>
                <button type="button" class="btn btn-primary" style = "background-color: #187BEC;" >Guardar</button>
            </div>
            </div>
        </div>
    </div>
</div>
