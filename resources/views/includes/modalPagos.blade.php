<!-- *********************** Modal Registrar Pagos **************************** -->
<div class="modal fade" id="modalRegistrarPagos" tabindex="-1" role="dialog" >
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-dialog-custom modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: rgb(214 224 27);">
                <h4 class="modal-title" id="myModalLabel" ><b>CREACIÓN DE NUEVO PAGO</b></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>


            <form action="{{route('registrar.pago')}}" method="POST">
                @csrf
                <div class="modal-body">

                        <div class="form-group">
                            <div class="input-group mb-3">
                            <label class="input-group-text" for="inputGroupSelect01">PAGO:</label>
                            <select class="form-select" id="inputGroupSelect01" name = "inputGroupSelect01" value="" required>
                                <option value="">Seleccione..</option>
                                <option value="infraccion">POR MULTAS (ACTAS DE CONTROL)</option>
                                <option value="descargo">POR DESCARGO</option>
                                <option value="tramite">POR DERECHOS DE TRÁMITES</option>
                                <option value="rdr">POR RESOLUCION DE SANCION</option>
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

<!-- *********************** Modal Editar Pagos **************************** -->

<div class="modal fade" id="modalEditarPagos" tabindex="-1" role="dialog" >
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
                            <option value="infraccion">POR MULTAS (ACTAS DE CONTROL)</option>
                            <option value="descargo">POR DESCARGO</option>
                            <option value="tramite">POR DERECHOS DE TRÁMITES</option>
                            <option value="rdr">POR RESOLUCION DE SANCION</option>
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
                        <input type="date" class="form-control" id="fecha_edit" name="fecha" required>
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

<!-- *********************** Modal Registrar UIT **************************** -->

<div class="modal fade" id="modalRegistrarUit" tabindex="-1" role="dialog" >
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-dialog-custom modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: rgb(36, 142, 243);">
                <h4 class="modal-title" id="myModalLabel"><b>AGREGAR UIT</b></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{route('registrar.uit')}}" id="editarForm" method="POST">
                <div class="modal-body">
                        @csrf

                        <div class="form-group">
                            <label for="anio">Año:</label>
                            <input type="text" class="form-control" id="anio" name="anio" placeholder="Ingrese el año" required>
                        </div>

                        <div class="form-group">
                            <label for="valor">Valor de la UIT</label>
                            <input type="float" class="form-control" id="valor" name="valor" placeholder="Ingrese el valor de la UIT del año descrito" required>
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

<!-- *********************** Modal Editar UIT **************************** -->

<div class="modal fade" id="modalEditarUit" tabindex="-1" role="dialog" >
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-dialog-custom modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: rgb(36, 142, 243);">
                <h4 class="modal-title" id="myModalLabel"><b>EDITAR UIT</b></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="" id="editarUitForm" method="POST">
                <div class="modal-body">
                        @csrf

                        <div class="form-group">
                            <label for="anio">Año:</label>
                            <input type="text" class="form-control" id="anio_edit" name="anio_edit" placeholder="Ingrese el año" required>
                        </div>

                        <div class="form-group">
                            <label for="valor">Valor de la UIT</label>
                            <input type="float" class="form-control" id="valor_edit" name="valor_edit" placeholder="Ingrese el valor de la UIT del año descrito" required>
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
