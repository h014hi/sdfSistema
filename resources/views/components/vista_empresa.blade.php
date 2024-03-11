@include('includes.modalEmpresas')
<div class="col-md-12">
    <!-- Botón o enlace que abre el modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalRegistrarEmpresas" style="background-color: #187BEC; margin: 10px 10px 10px -15px;">
        Registrar Empresa
    </button>
</div>

<div class="table-responsive">
    <table class="table" style="font-size: 75%; text-align: center;">

        <thead class="thead-dark">
            <tr>
                <th scope="col" rowspan="2">Item</th>
                <th scope="col" rowspan="2">RUC</th>
                <th scope="col" rowspan="2">RAZON SOCIAL</th>
                <th scope="col" rowspan="2">N° RESOLUCION DE FUNCIONAMIENTO</th>
                <th scope="col" rowspan="2">N° PARTIDA ELECTRONICA</th>
                <th scope="col" colspan="3">DATOS DEL GERENTE DE LA EMPRESA</th>
                <th></th>
                <th scope="col" rowspan="2">DOMICILIO LEGAL</th>
                <th scope="col" rowspan="2">ACCIONES</th>
            </tr>
            <tr>
                <!-- Subheaders for the grouped columns with colspan to cover the merged cells -->

                <th scope="col">NOMBRES</th>
                <th scope="col">APELLIDOS</th>
                <th scope="col">DNI</th>
                <th scope="col">CELULAR</th>
                <!-- Additional columns if needed -->
            </tr>
        </thead>

        <tbody>
            @foreach($resultados as $index=>$empresa)
                    <tr>
                    <td>{{$index + 1 }}</td>
                    <td>{{$empresa->ruc}}</td>
                    <td>{{$empresa->razon_social}}</td>
                    <td>{{$empresa->res_funcionamiento}}</td>
                    <td>{{$empresa->partida_electronica}}</td>
                    <td>{{$empresa->nombres_rep_legal}}</td>
                    <td>{{$empresa->apellidos_rep_legal}}</td>
                    <td>{{$empresa->dni_rep_legal}}</td>
                    <td>{{$empresa->numero_celular}}</td>
                    <td>{{$empresa->domicilio}}</td>
                    <td>
                        <!-- Update button-->
                        <a class="btn btn-warning" data-toggle="modal" data-target="#modalEditarEmpresas" onclick="editar_empresa(
                            {{json_encode($empresa->id)}},
                            {{json_encode($empresa->razon_social)}},
                            {{json_encode($empresa->ruc)}},
                            {{json_encode($empresa->res_funcionamiento)}},
                            {{json_encode($empresa->partida_electronica)}},
                            {{json_encode($empresa->nombres_rep_legal)}},
                            {{json_encode($empresa->apellidos_rep_legal)}},
                            {{json_encode($empresa->dni_rep_legal)}},
                            {{json_encode($empresa->numero_celular)}},
                            {{json_encode($empresa->domicilio)}})">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                        <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                        </svg>
                        </a>
                        <!-- Delete button-->
                        <form action="{{ route('empresa.destroy', ['id' => $empresa->id]) }}" method="POST" class="btn btn-danger" >
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-danger" onclick="return confirm('Are you sure you want to delete this Empresa?')">
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

    <div class="col-md-12">{{$resultados->links()}}</div>
</div>

<script>
    function editar_empresa(id,razon_social,ruc,res_funcionamiento,partida_electronica,nombres_rep_legal,apellidos_rep_legal,dni_rep_legal,numero_celular,domicilio)
        {
            var ruta = "{{ route('empresa.update', ['id' => ':id']) }}";
            ruta = ruta.replace(':id', id);
            document.getElementById("formularioid").action = ruta;
            document.getElementById("razon_socialedit").value = razon_social;
            document.getElementById("rucedit").value = ruc;
            document.getElementById("res_funcionamientoedit").value = res_funcionamiento;
            document.getElementById("partida_electronicaedit").value = partida_electronica;
            document.getElementById("nombres_rep_legaledit").value = nombres_rep_legal;
            document.getElementById("apellidos_rep_legaledit").value = apellidos_rep_legal;
            document.getElementById("dni_rep_legaledit").value = dni_rep_legal;
            document.getElementById("numero_celularedit").value = numero_celular;
            document.getElementById("domicilioedit").value = domicilio;
        }

</script>



