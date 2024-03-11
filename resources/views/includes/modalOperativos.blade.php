<!-- ************************************* MODALES OPERATIVO ****************************************** -->
<!-- ********************* Modal Operativo ************************* -->
<div class="modal fade" id="modalOperativo" tabindex="-1" role="dialog" >
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-dialog-custom modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: rgb(36, 142, 243);">
                <h4 class="modal-title" id="myModalLabel" ><b>CREACIÓN DE NUEVO OPERATIVO</b></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{ route('registrar.operativo') }}" method="POST">
                @csrf
                <div class="modal-body">

                    <div class="form-group">
                        <div class="input-group mb-3">
                        <label class="input-group-text" >Tipo de Operativo</label>
                        <select class="form-select" id="tipo_operativo" name = "tipo_operativo" >
                            <option disabled>Seleccionar...</option>
                            <option value="PROGRAMADO" selected>PROGRAMADO</option>
                            <option value="INOPINADO">INOPINADO</option>
                        </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="lugar" >Lugar:</label>
                        <input type="text" class="form-control" id="lugar" name="lugar" placeholder="Ingrese el lugar" required>
                    </div>

                    <div class="form-group">
                        <label for="provincia">Provincia:</label>
                        <select class="form-control" id="provincia" name="provincia" onchange="loadDistritos(this)">
                            <option value="">Seleccione</option>
                            @foreach($provinces as $province)
                                <option value="{{ $province->name }}" id="{{$province->id}}">{{ $province->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="distrito">Distrito:</label>
                        <select class="form-control" id="distrito" name="distrito">
                            <option value="">Seleccione</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="fecha">Fecha:</label>
                        <input type="date" class="form-control" id="fecha" name="fecha" required>
                    </div>
                    <div class="form-group">
                        <label for="habilitado">Habilitar:</label>
                        <input type="number" class="form-control" id="numero" name="dias" value="0">
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

<!-- ********************* Modal Operativo  Editar************************* -->

<div class="modal fade" id="modalOperativoEditar" tabindex="-1" role="dialog" >
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-dialog-custom modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: rgb(36, 142, 243);">
                <h4 class="modal-title" id="myModalLabel"><b>EDITAR OPERATIVO</b></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="" id="operativoEditarForm" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <div class="input-group mb-3">
                        <label class="input-group-text">Tipo de Operativo</label>
                        <select class="form-select" id="tipo_operativo_edit" name = "tipo_operativo_edit" >
                            <option selected>Seleccionar...</option>
                            <option value="PROGRAMADO">PROGRAMADO</option>
                            <option value="INOPINADO">INOPINADO</option>
                        </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="lugar">Lugar:</label>
                        <input  type="text" class="form-control" id="lugar_edit" name="lugar_edit" >
                    </div>

                    <div class="form-group">
                        <label for="">Provincia:</label>
                        <input class="form-control" id="provincia_edit" name="provincia_edit" >
                    </div>

                    <div class="form-group">
                        <label for="">Distrito:</label>
                        <input  class="form-control" id="distrito_edit"  name="distrito_edit" >
                    </div>

                    <div class="form-group">
                        <label for="fecha">Fecha:</label>
                        <input type="date" class="form-control" id="fecha_edit" name="fecha_edit" >
                    </div>

                    <div class="form-group">
                        <label for="habilitado">Habilitar:</label>
                        <input type="number" class="form-control" id="numero_edit" name="numero_edit" >
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
