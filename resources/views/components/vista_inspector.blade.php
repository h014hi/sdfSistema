@include('includes.modalInspectores')
<div class="col-md-12">
    <!-- Botón o enlace que abre el modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalRegistrarInspector" style="background-color: #187BEC; margin: 10px 10px 10px -15px;">
        Registrar Inspector
    </button>
</div>
<div class="table-responsive">
    <table class="table" style="font-size: 75%; text-align: center;">

        <!--CABECERA-->
        <thead class="thead-dark">
            <tr>
                <th scope="col">NOMBRES</th>
                <th scope="col">APELLIDOS</th>
                <th scope="col">DNI</th>
                <th scope="col">TELEFONO</th>
                <th scope="col">N° RDR AUTORIZACION</th>
                <th scope="col">ACREDITADO</th>
                <th scope="col">ACCIONES</th>
            </tr>
        </thead>

        <!--CUERPO-->
        <tbody>
            @foreach($resultados as $inspector)
                    <tr>
                        <td>{{$inspector->nombres}}</td>
                        <td>{{$inspector->apellidos}}</td>
                        <td>{{$inspector->dni}}</td>
                        <td>{{$inspector->telefono}}</td>
                        <td>{{$inspector->rdrauto}}</td>
                        @if($inspector->acreditado == "SI")
                            <td><span class="badge bg-success" style="font-size: 100%">ACREDITADO</span></td>
                        @else
                            <td><span class="badge bg-danger" style="font-size: 100%">NO ACREDITADO</span></td>
                        @endif
                        <td>

                            <a class="btn btn-warning" data-toggle="modal" data-target="#modalEditarInspector" onclick="editar_inspector(
                                {{json_encode($inspector->id)}},
                                {{json_encode($inspector->nombres)}},
                                {{json_encode($inspector->apellidos)}},
                                {{json_encode($inspector->dni)}},
                                {{json_encode($inspector->telefono)}},
                                {{json_encode($inspector->rdrauto)}},
                                {{json_encode($inspector->acreditado)}})">
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

<script>
    function editar_inspector(id,nombres,apellidos,dni,telefono,rdrauto,acreditado)
        {

            var ruta = "{{ route('inspector.update', ['id' => ':id']) }}";
            ruta = ruta.replace(':id', id);
            document.getElementById("formularioid").action = ruta;
            document.getElementById("nombresedit").value = nombres;
            document.getElementById("apellidosedit").value = apellidos;
            document.getElementById("inspecdniedit").action = dni;
            document.getElementById("telefonoedit").value = telefono;
            document.getElementById("rdrautoedit").value = rdrauto;
            document.getElementById("acreditadoedit").value = acreditado;
        }

</script>
