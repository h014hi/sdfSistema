<!-- ***************************** Modal Registrar Resoluciones ************************************** -->
<div class="modal fade" id="modalRegistrarResoluciones" tabindex="-1" role="dialog" >
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-dialog-custom modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: rgb(214 224 27);">
                <h4 class="modal-title" id="myModalLabel" ><b>CREACIÓN DE NUEVA RESOLUCION</b></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>


            <form action="{{route('registrar.resolucion')}}" method="POST">
                @csrf
                <div class="modal-body">

                        <div class="form-group">
                            <div class="input-group mb-3">
                            <label for="">N° de Acta:</label>
                                    <select name="acta" value="" id="acta" required
                                        class="bg-white border border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:focus:border-blue-500" required>
                                        <option value="">Seleccione..</option>
                                        @foreach ($actas as $acta)
                                            @if($acta->estado == "CONDESCARGO" || $acta->estado != "ARCHIVADO")
                                                <option value= "{{$acta->id}}">{{ $acta->numero}}</option>
                                            @endif
                                        @endforeach
                            </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="n_resolucion">Numero de Resolucion</label>
                            <input type="text" class="form-control" id="n_resolucion" name="n_resolucion" placeholder="Ingrese el N° de Resolucion" autocomplete="off" required>
                        </div>

                        <div class="form-group">
                            <label for="fecha">Fecha </label>
                            <input type="date" class="form-control" id="fecha" name="fecha" required>
                        </div>


                        <div class="form-group">
                            <label for="detalle">Detalle</label>
                            <input type="text" class="form-control" id="detalle" name="detalle" placeholder="Ingrese mas informacion sobre la resolucion" autocomplete="off">
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


 <!-- *******************************Modal Editar Resoluciones ******************************** -->
<div class="modal fade" id="modalEditarResoluciones" tabindex="-1" role="dialog" >
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-dialog-custom modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: rgb(36, 142, 243);">
                <h4 class="modal-title" id="myModalLabel"><b>EDITAR RESOLUCION</b></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="" id="editarForm" method="POST">
            <div class="modal-body">
                    @csrf

                    <div class="form-group">
                        <div class="input-group mb-3">
                        <label for="">N° de Acta:</label>
                                <select name="acta" id="actaedit" name="acta" value=""
                                    class="bg-white border border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:focus:border-blue-500" required>
                                    <option value="">Seleccione..</option>
                                    @foreach ($actas as $acta)
                                        @if($acta->estado == "CONRDR")
                                            <option value= "{{$acta->id}}">{{ $acta->numero}}</option>
                                        @endif
                                    @endforeach
                                </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="n_resolucion">Numero de Resolucion</label>
                        <input type="text" class="form-control" id="n_resolucionedit" name="n_resolucion" placeholder="Ingrese el N° de Resolucion" autocomplete="off" required>
                    </div>

                    <div class="form-group">
                        <label for="fecha">Fecha </label>
                        <input type="date" class="form-control" id="fechaedit" name="fecha" required>
                    </div>


                    <div class="form-group">
                        <label for="detalle">Detalle</label>
                        <input type="text" class="form-control" id="detalleedit" name="detalle" placeholder="Ingrese mas informacion sobre la resolucion" autocomplete="off">
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
