@props(['pagos','actas','uit'])
@include('includes.modalPagos')

@php
    $yearNow  = date('Y');
@endphp

<div class="row">
    <div class="col-md-8">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalRegistrarPagos" style=" background-color: #187BEC; margin: 10px 10px 10px -15px; font-size: 14px; margin-left:10px;">
            Nuevo Pago
        </button>
    </div>

    <div class="col-md-4 d-flex align-items-center justify-content-end">
        @foreach ($uit as $uitActual)
            @if ($uitActual->anio == $yearNow)
                <h2 style="margin-bottom: 0;">
                    UIT- {{$uitActual->anio}} :
                    <span style="color: #e78d8d; padding-right:15px; font-size:20px;">S/. {{$uitActual->valor}} </span>
                </h2>
            @endif
        @endforeach
        <div class="btn-group">
            <a class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#modalRegistrarUit" style="background-color: #72e795; font-size: 12px;">
                Agregar UIT
            </a>
            @foreach ($uit as $uitActual)
                @if ($uitActual->anio == $yearNow)
                    <a class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#modalEditarUit" style="background-color: #72e795; font-size: 12px;" onclick="
                    capturarUit(
                        {{ json_encode($uitActual->id) }},
                        {{ json_encode($uitActual->anio ) }},
                        {{ json_encode($uitActual->valor) }}
                    )">
                        Modificar UIT
                    </a>
                @endif

            @endforeach


        </div>
    </div>
</div>


<div class="table-responsive">
    <table class="table" style="font-size: 75%; text-align: center;">

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
                    <a class="btn btn-warning" data-toggle="modal" data-target="#modalEditarPagos" onclick="
                        capturar(
                            {{ json_encode($pago->id) }},
                            {{ json_encode($pago->tipo) }},
                            {{ json_encode($pago->acta->id) }},
                            {{ json_encode($pago->fecha) }},
                            {{ json_encode($pago->codigo) }},
                            {{ json_encode($pago->monto) }}
                        )">
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
            document.getElementById("fecha_edit").value = fecha;
            document.getElementById("montoedit").value = monto;
            document.getElementById("codigoedit").value = codigo;
            document.getElementById("tipo").value = tipo;
            document.getElementById("actaedit").value = numero;
        }

    function capturarUit(id,anio,valor)
    {
        var ruta = "{{ route('editar.uit', ['id' => ':id']) }}";
        ruta = ruta.replace(':id', id);
        document.getElementById("editarUitForm").action = ruta;
        document.getElementById("anio_edit").value = anio;
        document.getElementById("valor_edit").value = valor;
    }
</script>
