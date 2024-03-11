@include('template.plantillaheader')

<hr>
<h5 style="text-align: center;">REPORTE DE EMPRESA POR ACTAS</h5>
<h2 style="text-align: center;">"{{$datosempresa->razon_social}}</h2>
<hr>
<p style="text-align: left;"><i><b>GERENTE DE LA EMPRESA: </b>{{$datosempresa->nombres_rep_legal}} {{$datosempresa->apellidos_rep_legal}}</p></i>
<p style="text-align: left;"><i><b>FECHA DE CONSULTA: </b>{{$fechahoy}}</p></i>
@if ($fechaInicio!=NULL && $fechaFin!=NULL)
    <p>Reporte desde {{$fechaInicio}} hasta {{$fechaFin}}.</p>
@endif

@php
    $svgContent = '<svg height="200" width="500" version="1.1" xmlns="http://www.w3.org/2000/svg">';
    $svgContent_incum = '<svg height="200" width="500" version="1.1" xmlns="http://www.w3.org/2000/svg">';
    $barWidth = 50; // Ancho de las barras (puedes ajustarlo según tus necesidades)
    $barMargin = 10; // Margen entre cada barra (puedes ajustarlo según tus necesidades)
    $maxHeight = 150; // Altura máxima de las barras (puedes ajustarlo según tus necesidades)

    // Generar los rectángulos, etiquetas y valores en el eje X e Y para cada barra de infracciones
    foreach ($datos as $i => $dato) {
        $x = $i * ($barWidth + $barMargin);
        $y = $maxHeight - ($dato * ($maxHeight / max($datos))); // Ajustar la altura en función del dato máximo

        // Generar el rectángulo de la barra
        $svgContent .= sprintf('<rect x="%d" y="%d" width="%d" height="%d" fill="#ebd231" />',
            $x, $y, $barWidth, ($dato * ($maxHeight / max($datos))));

        // Generar la etiqueta en el eje X
        $svgContent .= sprintf('<text x="%d" y="%d" text-anchor="middle">%s</text>',
            ($x + $barWidth / 2), ($maxHeight + 20), $label[$i]);

        // Generar el valor en el eje Y
        $svgContent .= sprintf('<text x="%d" y="%d" text-anchor="middle">%d</text>',
            ($x + $barWidth / 2), ($y - 5), $dato);
    }

    $svgContent .= '</svg>';

    $file = tempnam(sys_get_temp_dir(), 'svg');
    file_put_contents($file, $svgContent);

    // Generar los rectángulos, etiquetas y valores en el eje X e Y para cada barra de incumplimientos
    foreach ($datos_incum as $i => $dato_incum) {
        $x = $i * ($barWidth + $barMargin);
        $y = $maxHeight - ($dato_incum * ($maxHeight / max($datos_incum))); // Ajustar la altura en función del dato máximo

        // Generar el rectángulo de la barra
        $svgContent_incum .= sprintf('<rect x="%d" y="%d" width="%d" height="%d" fill="#ebd231" />',
            $x, $y, $barWidth, ($dato_incum * ($maxHeight / max($datos_incum))));

        // Generar la etiqueta en el eje X
        $svgContent_incum .= sprintf('<text x="%d" y="%d" text-anchor="middle">%s</text>',
            ($x + $barWidth / 2), ($maxHeight + 20), $label_incum[$i]);

        // Generar el valor en el eje Y
        $svgContent_incum .= sprintf('<text x="%d" y="%d" text-anchor="middle">%d</text>',
            ($x + $barWidth / 2), ($y - 5), $dato_incum);
    }

    $svgContent_incum .= '</svg>';

    $file_incum = tempnam(sys_get_temp_dir(), 'svg');
    file_put_contents($file_incum, $svgContent_incum);

@endphp

<br>
<center><h3>GRAFICO ESTADISTICO</h3></center>
@if (count($datos) > 0)
    <div style="margin-top:10px;">
        <center><h5>Infracciones</h5></center>
        <img src="data:image/svg+xml;base64,{{ base64_encode(file_get_contents($file)) }}" />
    </div>
@else
    <div>
        <p>No se encontraron actas de Infraccionoes de la empresa</p>
    </div>
@endif

@if (count($datos_incum) > 0)
    <div style="margin-top:10px;">
        <center><h5>Incumplimmientos</h5></center>
        <img src="data:image/svg+xml;base64,{{ base64_encode(file_get_contents($file_incum)) }}" />
    </div>
@else
    <div>
        <p>No se encontraron actas de Incumplimientos de la empresa</p>
    </div>
@endif
@php
    $infracciones = array_sum($datos);
    $archivado_i = array_sum($archivados);

    $incumplimientos = array_sum($datos_incum);
    $archivado_j = array_sum($archivados_incum);
@endphp
<table style="width: 100%; border-collapse: collapse; margin: auto; border: 1px solid #ccc; text-align: center;">
    <thead>
        <tr>
            <th style="border: 1px solid #ccc; padding: 8px; background-color:#0c5ba1;  color: white;">ID</th>
            <th style="border: 1px solid #ccc; padding: 8px; background-color:#0c5ba1;  color: white;">TIPO</th>
            <th style="border: 1px solid #ccc; padding: 8px; background-color:#0c5ba1;  color: white;">ARCHIVADAS</th>
            <th style="border: 1px solid #ccc; padding: 8px; background-color:#0c5ba1;  color: white;">PENDIENTES</th>
            <th style="border: 1px solid #ccc; padding: 8px; background-color:#0c5ba1;  color: white;">CANTIDAD</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td style="border: 1px solid #ccc; padding: 8px;">1</td>
            <td style="border: 1px solid #ccc; padding: 8px;">INFRACCIONES</td>
            <td style="border: 1px solid #ccc; padding: 8px;">{{$archivado_i}}</td>
            <td style="border: 1px solid #ccc; padding: 8px;">{{$infracciones-$archivado_i}}</td>
            <td style="border: 1px solid #ccc; padding: 8px;">{{$infracciones}}</td>
        </tr>

        <tr>
            <td style="border: 1px solid #ccc; padding: 8px;">2</td>
            <td style="border: 1px solid #ccc; padding: 8px;">INCUMPLIMIENTOS</td>
            <td style="border: 1px solid #ccc; padding: 8px;">{{$archivado_j}}</td>
            <td style="border: 1px solid #ccc; padding: 8px;">{{$incumplimientos-$archivado_j}}</td>
            <td style="border: 1px solid #ccc; padding: 8px;">{{$incumplimientos}}</td>
        </tr>

        <tr>
            <td style="border: 1px solid #ccc; padding: 8px; background-color:#0c5ba1;  color: white;" colspan="4">CANTIDAD TOTAL DE ACTAS IMPUESTAS</td>
            <td style="border: 1px solid #ddd; padding: 8px;">{{$infracciones+$incumplimientos}}</td>
        </tr>
    </tbody>
</table>
