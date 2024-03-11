@props(['resultados'])
<!--CUERPO-->

<tbody>
    @foreach($resultados as $acta)
        <tr>
            <td>{{$acta->numero}}</td>
            <td>{{$acta->operativo->fecha}}</td>
            <td>{{$acta->operativo->lugar}}</td>
            <td>{{$acta->conductor->nombres}} {{$acta->conductor->apellidos}}</td>
            <td>{{$acta->vehiculo->placa}}</td>

            @foreach ($acta->fracums as $fracum)
                @if ($fracum->tipo == "incumplimiento")
                    @foreach ($fracum->fSubCods as $subcod)
                        <td> {{ $subcod->fFather->codigo}} <br> ({{$fracum->tipo}}) </td>
                        <td>{{ $subcod->ffather->detalle}} </td>
                    @endforeach
                @elseif ($fracum->tipo == "infraccion")
                    @foreach ($fracum->fSubCods as $subcod)
                        <td>{{ $subcod->fFather->codigo}} {{$subcod->sub_cod}} <br> ({{$fracum->tipo}})</td>
                        <td>{{ $subcod->ffather->detalle}} <br> {{ $subcod->descripcion}}</td>
                    @endforeach
                @endif
            <td>
                <a href="{{ route('infraccion.mostrar', ['tipo' => $fracum->tipo, 'id' => $subcod->id]) }}"
                    class="btn btn-info w-100">
                    Saber mas...
                </a>
            </td>
            @endforeach

            @php
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

            @endphp

            @include('includes.estadoActas')
        </tr>
    @endforeach
</tbody>
