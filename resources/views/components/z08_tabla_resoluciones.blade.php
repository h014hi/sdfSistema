@include('includes.modalResoluciones')
<div class="col-md-12">
    <!-- Botón o enlace que abre el modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalRegistrarResoluciones" style="background-color: #187BEC; margin: 10px 10px 10px -15px;">
        Nueva Resolucion
    </button>
<div class="table-responsive">
    <table class="table" style="font-size: 75%; text-align: center;">
        <thead class="thead-dark">
            <tr>
                <th scope="col" rowspan="2" >N°</th>
                <th scope="col" rowspan="2" >EMPRESA DE TRANSPORTES</th>
                <th scope="col" colspan="4" class="borders_1">DATOS DEL ACTA</th>
                <th scope="col" colspan="3" class="borders_1">DATOS DEL CONDUCTOR</th>
                <th scope="col" rowspan="2" >NUMERO DE RESOLUCION</th>
                <th scope="col" rowspan="2" >FECHA DE RESOLUCION</th>
                <th scope="col" rowspan="2" >DETALLE</th>
                <th scope="col" rowspan="2" >ACCIONES</th>
            </tr>
            <tr>
                <th scope="col" class="borders_1" >N° DE ACTA</th>
                <th scope="col" class="borders_1" >FECHA DE ACTA</th>
                <th scope="col" class="borders_1" >LUGAR INTERVENCION</th>
                <th scope="col" class="borders_1" >PLACA VEHICULO</th>
                <th scope="col" class="borders_1" >NOMBRES</th>
                <th scope="col" class="borders_1" >APELLIDOS</th>
                <th scope="col" class="borders_1" >LICENCIA</th>
            </tr>
        </thead>

        <tbody>
            @foreach($resoluciones as $index => $resolucion)
                    <tr>
                        <td>{{$index +1}}</td>
                        <td>{{$resolucion->acta->empresa->razon_social}}</td>
                        <td>{{$resolucion->acta->numero}}</td>
                        <td>{{$resolucion->acta->operativo->fecha}}</td>
                        <td>{{$resolucion->acta->operativo->lugar}}</td>
                        <td>{{$resolucion->acta->vehiculo->placa}}</td>
                        <td>{{$resolucion->acta->conductor->nombres}}</td>
                        <td>{{$resolucion->acta->conductor->apellidos}}</td>
                        <td>{{$resolucion->acta->conductor->licencia}}</td>
                        <td>{{$resolucion->n_resolucion}}</td>
                        <td>{{$resolucion->fecha}}</td>
                        <td>{{$resolucion->detalle}}</td>
                        <td>
                            <a class="btn btn-warning" data-toggle="modal" data-target="#modalEditarResoluciones" onclick="capturar({{ json_encode($resolucion->id) }},{{ json_encode($resolucion->acta->id) }},{{ json_encode($resolucion->n_resolucion) }},{{ json_encode($resolucion->fecha) }},{{ json_encode($resolucion->detalle) }})">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                </svg>
                            </a>
                            <form action="{{ route('resolucion.destroy', ['id' => $resolucion->id]) }}" method="POST" class="btn btn-danger d-inline" >
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-danger" onclick="return confirm('Seguro que desea eliminar esta Resolucion?')">
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

</div>

<style>
    .borders_1{
        border:1px solid white;
    }
</style>

<script>
    function capturar(id,numero,n_resolucion,fecha,detalle)
       {
           var ruta = "{{ route('resolucion.update', ['id' => ':id']) }}";
           ruta = ruta.replace(':id', id);
           document.getElementById("editarForm").action = ruta;
           document.getElementById("actaedit").value = numero;
           document.getElementById("n_resolucionedit").value = n_resolucion;
           document.getElementById("fechaedit").value = fecha;
           document.getElementById("detalleedit").value = detalle;

           console.log(document.getElementById("actaedit").value = numero);
       }
</script>
