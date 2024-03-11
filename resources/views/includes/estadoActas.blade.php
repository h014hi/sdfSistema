@if($acta->estado == "ARCHIVADO")
    <td > <div style="color: white; background-color: #89f13a; padding: 1em;"><b>Archivado PAS</b></div></td>
@elseif ($acta->estado == "TRAMITADO")
    <td>  <div style="color: black; background-color: yellow; padding: 1em;"><b>Tramitado</b></div></td>
@elseif ($acta->estado == "CONDESCARGO")
    <td>  <div style="color: white; background-color: #3ac7f1; padding: 1em;"><b>Pendiente de tramite</b></div></td>
@elseif ($acta->estado == "CONRDR")
    <td>  <div style="color: white; background-color: #3ac7f1; padding: 1em;"><b>Con RDR</b></div></td>
@else
    @foreach ($acta->fracums as $fracum)
        @if ($fracum->tipo == "infraccion")
            @if($fechaHoy > $nuevaFecha)
                <td><div style="color: rgb(255, 255, 255); background-color: #f53838; padding: 1em;"><b>Para su Tramite</b></div></td>
            @else
                <td> <div style="color: white; background-color: orange; padding: 1em;"><b>Dentro del plazo para Pago y/o Descargo</b></div></td>
            @endif
        @elseif ($fracum->tipo == "incumplimiento")
            @if($fechaHoy > $nuevaFecha)
                <td>  <div style="color: white; background-color: #f53838; padding: 1em;"><b>Para su Tramite</b></div></td>
            @else
                <td> <div style="color: white; background-color: orange; padding: 1em;"><b>Dentro del plazo para Descargo</b></div></td>
            @endif
        @endif
    @endforeach
@endif
