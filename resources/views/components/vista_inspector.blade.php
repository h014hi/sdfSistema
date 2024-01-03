
<!--BOTONES DE ACCIONAR REGISTRAR GENERAR PDF GENERAR EXCEL-->
    <div class="col-md-12">
        <!-- Botón o enlace que abre el modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal" style="background-color: #187BEC; margin: 10px 10px 10px -15px;">
         Registrar Inspector
        </button>
        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" >
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-dialog-custom modal-xl" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Registrar Inspectores</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form id="formulario" action="{{ route('guardar-datos') }}" method="GET">
                @csrf
                 <div class="space-y-3 mb-4">
                   <h2 class="font-bold"></h2>
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
                            </div>
                    </div>
        </div>

        <div class="space-y-3 mb-4">
        <h2 class="font-bold">ESTADO DEL INSPECTOR</h2>
        <div class="space-x-3 flex justify-between">
            <div class="flex-1 space-y-3">
                    <label for="">ESTA ACREDITADO PARA TRABAJO DE CAMPO (SI/NO)</label>
                    <input type="text" name="telefono" id="telefono"
                        class="bg-gray-50 border outline-none border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        value="SI">
                </div>
            </div>
        </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-dismiss="modal" style = "background-color: #EC7518; color:white;">Cerrar</button>
                <button type="submit" class="btn btn-primary" style = "background-color: #187BEC;" >Guardar</button>
            </div>
            </div>
        </form>
        </div>
        </div>
    </div>
    </div>



<div class="table-responsive">
        <table class="table" style="font-size: 75%; text-align: center;">

            <!--CABECERA-->
            <thead class="thead-dark">
                    <tr>
                        <th scope="col">NOMBRES</th>
                        <th scope="col">APELLIDOS</th>
                        <th scope="col">INSPECTOR</th>
                        <th scope="col">ACCIONES</th>
                    </tr>
            </thead>

            @props(['resultados'])

            <!--CUERPO-->
            <tbody>
                    @foreach($resultados as $inspector)
                            <tr>
                            <td>{{$inspector->nombres}}</td>
                            <td>{{$inspector->apellidos}}</td>
                            @if($inspector->telefono == "SI")
                                <td><span class="badge bg-success" style="font-size: 100%">ACREDITADO</span></td>
                            @else
                                <td><span class="badge bg-danger" style="font-size: 100%">NO ACREDITADO</span></td>
                            @endif
                            <td>

                                <a class="btn btn-warning" data-toggle="modal" data-target="#myModalEdit" onclick="editar_inspector(
                                    {{json_encode($inspector->id)}},
                                    {{json_encode($inspector->nombres)}},
                                    {{json_encode($inspector->apellidos)}},
                                    {{json_encode($inspector->telefono)}})">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                </svg>
                                </a>

                                <!-- Delete button-->
                                <!-- i causes crashes if some inspector is deleted
                                <form action="{{ route('inspector.destroy', ['id' => $inspector->id]) }}" method="POST" class="btn btn-danger d-inline" >
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-danger" onclick="return confirm('Are you sure you want to delete this inspector?')">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                            <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                                        </svg>
                                    </button>
                                </form>
                                -->
                            </td>
                            </tr>
                    @endforeach
            </tbody>
        </table>

    <div class="col-md-12">{{$resultados->links()}}</div>

</div>

</div>
<!-- Modal -->
<div class="modal fade" id="myModalEdit" tabindex="-1" role="dialog" >
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-dialog-custom modal-xl" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Editar Inspectores</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <div class="modal-body">
        <form id="formularioid" action="" method="">
            @csrf
         <div class="space-y-3 mb-4">
           <h2 class="font-bold"></h2>
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
                    </div>
            </div>
</div>

<div class="space-y-3 mb-4">
<h2 class="font-bold">ESTADO DEL INSPECTOR</h2>
<div class="space-x-3 flex justify-between">
    <div class="flex-1 space-y-3">
            <label for="">ESTA ACREDITADO PARA TRABAJO DE CAMPO (SI/NO)</label>
            <input type="text" name="telefono" id="telefonoedit"
                class="bg-gray-50 border outline-none border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Ingrese telefono">
        </div>
    </div>
</div>

    <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-dismiss="modal" style = "background-color: #EC7518; color:white;">Cerrar</button>
        <button type="submit" class="btn btn-primary" style = "background-color: #187BEC;" >Guardar</button>
    </div>
    </div>
</form>
</div>
</div>
</div>
</div>
</div>
</div>

<script>
    function editar_inspector(id,nombres,apellidos,telefono)
        {

            var ruta = "{{ route('inspector.update', ['id' => ':id']) }}";
            ruta = ruta.replace(':id', id);
            document.getElementById("formularioid").action = ruta;
            document.getElementById("nombresedit").value = nombres;
            document.getElementById("apellidosedit").value = apellidos;
            document.getElementById("telefonoedit").value = telefono;
        }

</script>
