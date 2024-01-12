<table>
    <thead>
        <tr>
            <th>Código:</th>
            <th>Descripcion</th>
            <th>Calificacion</th>
            <th>Medidas Preventivas</th>
            <th>Consecuencia</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{$fracum->ffather->codigo}} {{$fracum->sub_cod}}</td>
            <td>{{$fracum->ffather->detalle}} {{$fracum->descripcion}}</td>
            <td>{{$fracum->calificacion}}</td>
            <td>{{$fracum->m_preventivas}}</td>
            <td>{{$fracum->consecuencia}}</td>
        </tr>
    </tbody>
</table>

<p class="m_p">
    *   De considerar la presentación de un descargo, puede realizarlo en la Sede Principal(Jr. Lima N°944-ciudad de Puno)
    (Tramite Documentario) de la Direccion Regional de Transportes y Comunicaciones de Puno; para lo cual dispone de cinco
    (5) dias habiles a partir del dia siguiente de notificado el acta de control de acuerdo con lo dispuesto en el Reglamento
    del Procedimiento Administrativo Sancionador Especial de Tramitacion Sumaria en materia de transporte y transito terrestre
    y sus servicios.
</p>
<a href="{{ route('home') }}" class="btn btn-primary">
    Página principal
</a>
