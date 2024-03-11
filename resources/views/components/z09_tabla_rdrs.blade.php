@props(['resultados'])

<tbody>
    @foreach($resultados as $rdr)
        <tr>
            <td>{{$rdr->n_resolucion}}</td>
            <td>{{$rdr->fecha}}</td>
            <td>{{$rdr->acta->numero}}</td>
            <td>{{$rdr->acta->operativo->lugar}}</td>
            <td>{{$rdr->acta->operativo->fecha}}</td>
            <td>{{$rdr->acta->empresa->razon_social}}</td>
            <td>{{$rdr->acta->vehiculo->placa}}</td>
            <td>{{$rdr->acta->conductor->nombres}}{{$rdr->acta->conductor->apellidos}}</td>
            <td>{{$rdr->detalle}}</td>
        </tr>
    @endforeach
</tbody>
