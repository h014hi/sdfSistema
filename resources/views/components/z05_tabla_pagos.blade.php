<div class="col-md-12">

        <!-- Botón o enlace que abre el modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal" style="background-color: #187BEC; margin: 10px 10px 10px -15px;">
            Nuevo Pago
        </button>


        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" >
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-dialog-custom modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color: rgb(214 224 27);">
                            <h4 class="modal-title" id="myModalLabel" ><b>CREACIÓN DE NUEVO PAGO</b></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>


                        <form action="{{route('registrar.pago')}}" method="GET">
                        <div class="modal-body">

                                <div class="form-group">
                                    <div class="input-group mb-3">
                                    <label class="input-group-text" for="inputGroupSelect01">PAGO:</label>
                                    <select class="form-select" id="inputGroupSelect01" name = "inputGroupSelect01" value="" required>
                                        <option value="">Seleccione..</option>
                                        <option value="INFRACCION">POR MULTAS (ACTAS DE CONTROL)</option>
                                        <option value="SANCION">POR MULTAS DE RESOLUCIÓN DE SANCIÓN</option>
                                        <option value="DESCARGO">POR DERECHOS DE TRÁMITES</option>
                                        <option value="RDR">POR RESOLUCION</option>
                                    </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group mb-3">
                                    <label for="">N° de Acta:</label>
                                            <select name="acta" value="" id="acta"
                                                        class="bg-white border border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:focus:border-blue-500" required>
                                                        <option value="">Seleccione..</option>
                                                        @foreach ($actas as $acta)
                                                            @if($acta->estado != "CONDESCARGO")
                                                                @if($acta->estado != "ARCHIVADO")
                                                                    <option value= "{{$acta->id}}">{{ $acta->numero}}</option>
                                                                @endif
                                                            @endif
                                                        @endforeach
                                            </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="codigo">Codigo de Voucher:</label>
                                    <input type="text" class="form-control" id="codigo" name="codigo" placeholder="Ingrese el codigo de pago" autocomplete="off" required>
                                </div>

                                <div class="form-group">
                                    <label for="monto">Monto de pago:</label>
                                    <input type="float" class="form-control" id="monto" name="monto" placeholder="Ingrese el monto de pago" autocomplete="off" required>
                                </div>


                                <div class="form-group">
                                    <label for="fecha">Fecha de Pago:</label>
                                    <input type="date" class="form-control" id="fecha" name="fecha" required>
                                </div>

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal" style = "background-color: #EC7518; color:white;">Cerrar</button>
                            <button type="submit" class="btn btn-primary" style = "background-color: #229ed1; color:white;" >Guardar</button>
                        </div>

                        </form>

                    </div>
                </div>
        </div>


        <!--FORMULARIO PARA EDITAR-->


        <div class="modal fade" id="myModalEdit" tabindex="-1" role="dialog" >
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-dialog-custom modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color: rgb(36, 142, 243);">
                            <h4 class="modal-title" id="myModalLabel"><b>EDITAR PAGO</b></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <form action="" id="editarForm" method="POST">
                        <div class="modal-body">
                                @csrf

                                <div class="form-group">
                                    <div class="input-group mb-3">
                                    <label class="input-group-text" for="inputGroupSelect01">Tipo:</label>
                                    <select class="form-select" id="tipo" name = "inputGroupSelect01" value="" required>
                                        <option value="">Seleccione..</option>
                                        <option value="INFRACCION">POR MULTAS (ACTAS DE CONTROL)</option>
                                        <option value="SANCION">POR MULTAS DE RESOLUCIÓN DE SANCIÓN</option>
                                        <option value="DESCARGO">POR DERECHOS DE TRÁMITES</option>
                                        <option value="RDR">POR RESOLUCION</option>
                                    </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group mb-3">
                                    <label for="">N° de Acta:</label>
                                            <select name="acta" id="actaedit" name="acta" value=""
                                                class="bg-white border border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:focus:border-blue-500" required>
                                                <option value="">Seleccione..</option>
                                                @foreach ($actas as $acta)
                                                    <option value= "{{$acta->id}}">{{ $acta->numero}}</option>
                                                @endforeach
                                            </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="codigo">Codigo de Voucher:</label>
                                    <input type="text" class="form-control" id="codigoedit" name="codigo" placeholder="Ingrese el codigo de pago" required>
                                </div>

                                <div class="form-group">
                                    <label for="monto">Monto de pago:</label>
                                    <input type="float" class="form-control" id="montoedit" name="monto" placeholder="Ingrese el monto de pago" required>
                                </div>


                                <div class="form-group">
                                    <label for="fecha">Fecha de Pago:</label>
                                    <input type="date" class="form-control" id="fechaedit" name="fecha" required>
                                </div>

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal" style = "background-color: #EC7518; color:white;">Cerrar</button>
                            <button type="submit" class="btn btn-primary" style = "background-color: #229ed1; color:white;" >Guardar</button>
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
                                    <th scope="col">N°</th>
                                    <th scope="col">PAGO POR</th>
                                    <th scope="col">N° DE ACTA</th>
                                    <th scope="col">INFRACTOR</th>
                                    <th scope="col">FECHA DE PAGO</th>
                                    <th scope="col">CODIGO DE PAGO</th>
                                    <th scope="col">MONTO DE PAGO</th>
                                    <th scope="col">ESTADO DE ACTA</th>
                                    <th scope="col">ACCIONES</th>
                                </tr>
                        </thead>

                        @props(['pagos'])

                        <tbody>

                            @foreach($pagos as $index => $pago)
                                    <tr>
                                        <td>{{$index+1}}</td>
                                        <td>{{$pago->tipo}}</td>
                                        <td>{{$pago->acta->numero}}</td>
                                        <td>{{$pago->acta->conductor->nombres}}</td>
                                        <td>{{$pago->fecha}}</td>
                                        <td>{{$pago->codigo}}</td>
                                        <td>{{$pago->monto}}</td>
                                        <td> <span class="badge bg-success" style="font-size: 120%">{{$pago->acta->estado}}</span></td>
                                        <td>
                                        <a class="btn btn-warning" data-toggle="modal" data-target="#myModalEdit" onclick="capturar({{ json_encode($pago->id) }},{{ json_encode($pago->tipo) }},{{ json_encode($pago->acta->id) }},{{ json_encode($pago->fecha) }},{{ json_encode($pago->codigo) }},{{ json_encode($pago->monto) }})">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                            <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                            </svg>
                                        </a>
                                        <!-- Delete button-->
                                        <form action="{{ route('pago.destroy', ['id' => $pago->id]) }}" method="POST" class="btn btn-danger d-inline" >
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-danger" onclick="return confirm('Esta seguro que desea eliminar este pago ?')">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                                    <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                                                </svg>
                                            </button>
                                        </form>
                                        </td>
                                    </tr>
                            @endforeach
                        </tbody>

    </table>
</div>

<script>
     function capturar(id,tipo,numero,fecha,codigo, monto)
        {
            var ruta = "{{ route('pago.update', ['id' => ':id']) }}";
            ruta = ruta.replace(':id', id);
            document.getElementById("editarForm").action = ruta;
            document.getElementById("fechaedit").value = fecha;
            document.getElementById("montoedit").value = monto;
            document.getElementById("codigoedit").value = codigo;
            document.getElementById("tipo").value = tipo;
            document.getElementById("actaedit").value = numero;
        }
</script>
