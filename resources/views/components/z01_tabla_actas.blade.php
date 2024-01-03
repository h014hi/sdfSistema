@props(['resultados'])


@php
        function esFinDeSemana($fecha) {
          $diaSemana = date('N', strtotime($fecha)); // 1 (lunes) a 7 (domingo)
          return ($diaSemana == 6 || $diaSemana == 7);
        }
@endphp

        <!--CUERPO-->

        <tbody>
                @foreach($resultados as $acta)
                        <script>
                                mostrarInfraccion('{{$acta->infraccion->codigo}}','{{$acta->infraccion->descripcion}}','{{$acta->infraccion->consecuencia}}')
                        </script>
                        <tr>
                                <td>{{$acta->numero}}</td>
                                <td>{{$acta->operativo->fecha}}</td>
                                <td>{{$acta->operativo->lugar}}</td>
                                <td>{{$acta->conductor->nombres}} {{$acta->conductor->apellidos}}</td>
                                <td>{{$acta->vehiculo->placa}}</td>
                                <!-- <td><a href="#" onclick="mostrarInfraccion('{{$acta->infraccion->codigo}}','{{$acta->infraccion->descripcion}}','{{$acta->infraccion->consecuencia}}')" id="mInfraccion">{{$acta->infraccion->codigo}}</a></td> -->
                                <td>{{$acta->infraccion->codigo}}</td>
                                <td>{{$acta->infraccion->descripcion}}</td>
                                <td>{{$acta->observacion}}</td>

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


                                        @if($acta->estado == "ARCHIVADO")
                                                <td > <div style="color: white; background-color: #89f13a; padding: 1em;"><b>Archivado PAS</b></div></td>
                                        @else
                                                @if($acta->estado == "TRAMITADO")
                                                        <td>  <div style="color: black; background-color: yellow; padding: 1em;"><b>Tramitado</b></div></td>
                                                @else
                                                        @if($acta->estado == "CONDESCARGO")
                                                                <td>  <div style="color: white; background-color: #3ac7f1; padding: 1em;"><b>Pendiente de tramite</b></div></td>
                                                        @else
                                                                @if($acta->infraccion->tipo == "INFRACCION")
                                                                        @if($fechaHoy > $nuevaFecha)
                                                                        <td><div style="color: black; background-color: #f53838; padding: 1em;"><b>Para su Tramite</b></div></td>
                                                                        @else
                                                                        <td> <div style="color: white; background-color: orange; padding: 1em;"><b>Dentro del plazo para Pago y/o Descargo</b></div></td>
                                                                        @endif
                                                                @else
                                                                        @if($fechaHoy > $nuevaFecha)
                                                                        <td>  <div style="color: white; background-color: #f53838; padding: 1em;"><b>Para su Tramite</b></div></td>
                                                                        @else
                                                                        <td> <div style="color: white; background-color: orange; padding: 1em;"><b>Dentro del plazo para Descargo</b></div></td>
                                                                        @endif
                                                                @endif
                                                        @endif
                                                @endif
                                        @endif

                        </tr>
                @endforeach


        </tbody>
