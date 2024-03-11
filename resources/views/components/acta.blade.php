@include('includes.modalActas')
@include('includes.styles')

<!--NAVAR DE LAS ACTAS-->
<div class="row col-md-12" style="margin: 10px 0px 0px -15px;">
    <div class="col-auto">
        <a href="{{ route('operativos') }}" class="btn btn-danger">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="23" fill="currentColor" class="bi bi-box-arrow-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0v2z"/>
                    <path fill-rule="evenodd" d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z"/>
                    </svg>
        </a>

        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalRegistrarActas" style="background-color: #187BEC;">
            Registrar Acta
        </button>

        <!--
        <button type="button" class="btn btn-success" style="background-color: #207743;">
            Exportar a Excel
        </button>
        -->
    </div>
</div>

<!--tabla de registros-->
<div class="col-md-12 table-responsive">

    @php
        /*Para fecha en español*/
        use Carbon\Carbon;
        $ope = $operativo;
        $fechaFormateada = Carbon::parse($ope->fecha)->locale('es')->isoFormat('LL');

        foreach($resultados as $acta){
            /*Para mostrar placa con -*/
            $placa_temp=$acta->vehiculo->placa;
            $placa_temp = substr($placa_temp, 0, 3) . '-' . substr($placa_temp, 3);

            /*Para determinar plazo de dias*/
            // en caso de paros o huelgas o feriados

            $dias_aumentados = $acta->operativo->diashabiles;
            $nuevaFecha = date('Y-m-d', strtotime($acta->operativo->fecha . ' + ' . strval($dias_aumentados) . ' days'));
            $nuevaFecha = date('Y-m-d', strtotime($nuevaFecha . ' + 5 days'));

            // en caso de sabados y domingos
            $sabados_domingos = 0;
            $fechaActual = date('Y-m-d', strtotime($acta->operativo->fecha . ' + 0 days'));

            //contando cuantos sabados y domingos hay para sumarlos
            while ($fechaActual <= $nuevaFecha) {
                    $diaSemana = date('N', strtotime($fechaActual));
                    if ($diaSemana == 6 || $diaSemana == 7) {
                            $sabados_domingos++;
                    }
                    $fechaActual = date('Y-m-d', strtotime($fechaActual . ' + 1 days'));
            }

            $nuevaFecha = date('Y-m-d', strtotime($nuevaFecha . ' + ' . strval($sabados_domingos) . ' days'));

            $fechaHoy = date('Y-m-d');
        }
    @endphp

    <h2 class="formatted-info">
        Operativo <span class="highlight">{{$ope->tipo}}</span> llevado a cabo el <span class="highlight">{{$fechaFormateada}}</span>
        en el lugar denominado: <span class="highlight">{{$ope->lugar}}</span> del distrito de:
        <span class="c">{{$ope->distrito}}</span>, provincia de: <span class="highlight">{{$ope->provincia}}</span>, con un total de <span class="highlight">{{$cantidadactas}}</span> actas.
    </h2>

    <table class="table" style="font-size: 75%; text-align: center;">
        <thead class="thead-dark">
            <tr>
                <th scope="col">ITEM</th>
                <th scope="col">N° DE ACTA</th>
                <th scope="col">RAZON SOCIAL</th>
                <th scope="col">N° DE PLACA</th>
                <th scope="col">RUTA</th>
                <th scope="col">NOMBRE DEL CONDUCTOR</th>
                <th scope="col">LICENCIA / CATEGORIA</th>
                <th scope="col">ESTADO</th>
                <th scope="col">INSPECTOR</th>
                <th scope="col" style="width: 5%;">FALTA</th>
                <th scope="col">RETENCION</th>
                <th scope="col">OBSERVACIONES</th>
                <th scope="col" style="width: 10%;">ESTADO</th>
                <th scope="col">ACCIONES</th>
            </tr>
        </thead>
        <tbody>
            @foreach($resultados as $index => $acta)
                <tr>
                    <td>{{$index + 1 }}</td>
                    <td>{{$acta->numero}}</td>
                    <td>{{$acta->empresa->razon_social}}</td>
                    <td>{{$acta->vehiculo->placa}}</td>
                    <td>{{$acta->ruta}}</td>
                    <td>{{$acta->conductor->nombres}}</td>
                    <td>{{$acta->conductor->licencia}} <br> {{$acta->conductor->categoria}}</td>
                    <td>{{$acta->conductor->estadolicencia}}</td>
                    <td>{{$acta->inspector->nombres}}{{$acta->inspector->apellidos}}</td>
                    <td>
                        @foreach ($acta->fracums as $fracum)
                            @foreach ($fracum->fSubCods as $subcod)
                                {{ $subcod->fFather->codigo}} {{$subcod->sub_cod}} <br>
                            @endforeach
                        @endforeach
                    </td>

                    <td>{{$acta->retencion}}</td>
                    <td>
                        <div>
                            <a class="btn btn-info" data-toggle="modal" onclick="mostrarObsevaciones('{{$acta->obs_intervenido}}','{{$acta->obs_inspector}}','{{$acta->obs_acta}}')">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                    <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
                                </svg>
                            </a>
                        </div>
                    </td>
                    @include('includes.estadoActas')
                    <td>
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <a class="btn btn-warning" data-toggle="modal" data-target="#modalEditarActas" onclick="capturar(
                                    {{json_encode($acta->id)}},
                                    {{json_encode($acta->numero)}},
                                    {{json_encode($acta->estado)}},
                                    {{json_encode($acta->inspector->id)}},
                                    {{json_encode($acta->retencion)}},
                                    {{json_encode($acta->conductor->dni)}},
                                    {{json_encode($acta->conductor->nombres)}},
                                    {{json_encode($acta->conductor->apellidos)}},
                                    {{json_encode($acta->conductor->licencia)}},
                                    {{json_encode($acta->conductor->categoria)}},
                                    {{json_encode($acta->conductor->estadolicencia)}},
                                    {{json_encode($acta->empresa->id)}},
                                    {{json_encode($acta->vehiculo->placa)}},
                                    {{json_encode($acta->ruta)}},
                                    {{json_encode($acta->obs_acta)}},
                                    {{json_encode($acta->obs_intervenido)}},
                                    {{json_encode($acta->obs_inspector)}})"> <!--   Mucho OJO con el parentesis XD -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                </svg>
                            </a>
                            <a href="{{ route('ifi', ['id' => json_encode($acta->id)]) }}" class="btn btn-success position-relative">
                                IFI
                            </a>

                            <form action="{{ route('acta.destroy', ['id' => $acta->id]) }}" method="POST" class="btn btn-danger d-inline" >
                                @csrf
                                @method('DELETE')
                                <button type="submit"  onclick="return confirm('Esta seguro de eliminar esta acta?')">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                        <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="col-md-12">{{$resultados->links()}}</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    function capturar(id,numero,estado,inspector_id,retencion,conductor_dni,conductor_nombres,conductor_apellidos,conductor_licencia,categoria,estadolicencia,empresa_id,vehiculo_placa,ruta2,obs_acta,obs_intervenido,obs_inspector)
    {
        var ruta = "{{ route('acta.update', ['id' => ':id']) }}";
        ruta = ruta.replace(':id', id);
        document.getElementById("formularioid").action = ruta;
        document.getElementById("actaedit").value = numero;
        document.getElementById("colorSelectedit").value = estado;
        document.getElementById("inspectoredit").value = inspector_id;
        document.getElementById("retencionedit").value = retencion;
        document.getElementById("dniedit").value = conductor_dni;
        document.getElementById("nombresedit").value = conductor_nombres;
        document.getElementById("apellidosedit").value = conductor_apellidos;
        document.getElementById("licenciaedit").value = conductor_licencia;
        document.getElementById("categoriaedit").value = categoria;
        document.getElementById("estadoedit").value = estadolicencia;
        document.getElementById("empresaedit").value = empresa_id;
        document.getElementById("placaedit").value = vehiculo_placa;
        document.getElementById("rutaedit").value = ruta2;
        document.getElementById("obs_actaedit").value = obs_acta;
        document.getElementById("obs_intervenidoedit").value = obs_intervenido;
        document.getElementById("obs_inspectoredit").value = obs_inspector;
    }

    function mostrarObsevaciones(obs_intervenido,obs_inspector,obs_acta) {
        obs_intervenido = obs_intervenido || 'Ninguna';
        obs_inspector = obs_inspector || 'Ninguna';
        obs_acta = obs_acta || 'Ninguna';
        Swal.fire({
            html: `
                <h3 style="color: black;"><b>OBSERVACIONES</b></h3>
                <br>
                <style>
                    table {
                        width: 100%;
                        border-collapse: collapse;
                    }

                    th, td {
                        border-bottom: 1px solid black; /* Añade un borde inferior a las celdas de encabezado y datos */
                        padding: 8px;
                        text-align: left;
                    }

                    th {
                        border-top: 1px solid black; /* Añade un borde superior a las celdas de encabezado */
                    }

                    tr:last-child td {
                        border-bottom: 0px solid black; /* Elimina el borde inferior de la última fila de datos */
                    }
                </style>

                <!--TABLA FLOTANTE -->
                <table>
                    <tr>
                        <th style="width:33%;">Del Intervenido</th>
                        <th style="width:33%;">Del Inspector</th>
                        <th style="width:33%;">Del Acta</th>
                    </tr>
                    <tr>
                        <td>${obs_intervenido}</td>
                        <td>${obs_inspector}</td>
                        <td>${obs_acta}</td>
                    </tr>
                </table>
            `,
            confirmButtonText: 'Salir',
            width: '75%'
        });
    }

    function changeColor(){
        var select = document.getElementById("colorSelect");
        var div2 = document.getElementById("headmod");
        var color;

        switch (select.value) {
            case "CONDESCARGO":
                color = "orange";
                break;
            case "ARCHIVADO":
                color = "#2bd390";
                break;
            case "TRAMITADO":
                color = "#248ef3";
                break;
            case "PENDIENTE":
                color = "#fb2d5b";
                break;
            case "CONRDR":
                color = "#248ef3";
                break;
            default:
                color = "white"; // Color por defecto o ninguna acción
                break;
        }

        div2.style.backgroundColor = color;
    }

    function limitarDigitos(inputElement, maxLength) {
        let inputValue = inputElement.value;
        inputValue = inputValue.slice(0, maxLength);
        inputElement.value = inputValue;
    }

    // Select Anidado
    function loadSubCodigo(codigo) {
        let codigoId = codigo.value;
        fetch('/fracum/' + codigoId)
            .then(function (response) {
                return response.json();
            })
            .then(function (jsonData) {
                buildSelectInfra_incum(jsonData);
            });
    }

    function buildSelectInfra_incum(fracums) {
        let fracumSelect = document.getElementById('fracumson');

        clearSelect(fracumSelect);


        fracums.forEach(function (fracum) {

            let optiontag = document.createElement('option');
            optiontag.value = fracum.id;
            optiontag.innerHTML = fracum.sub_cod;
            fracumSelect.append(optiontag);
        });
    }

    function clearSelect(select){
        while(select.options.length > 1){
            select.remove(1);
        }
    }

    function buscarDNI(dni) {
        $.ajax({
            url: '{{ route("acta.consultardni") }}',
            type: 'GET',
            data: {dni: dni},
            dataType: 'json',
            success: function(response) {
                if(response.numeroDocumento == dni) {
                    var apellidos = response.apellidoPaterno + ' ' + response.apellidoMaterno;
                    $('#apellidos').val(apellidos);
                    $('#nombres').val(response.nombres);
                } else {
                    alert(response.error);
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }

    $(document).ready(function() {
        $('#n_documento').keyup(function() {
            var dni = $(this).val();
            if (dni.length == 8) {
                buscarDNI(dni);
            }
        });
    });
</script>
