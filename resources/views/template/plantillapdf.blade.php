@include('template.plantillaheader')
<div class="container">
    <center><h1>REPORTE DE OPERATIVOS</h1></center>
    <p>Fecha de consulta: {{ $fechahoy }}</p>
    @if ($fechaInicio!=NULL && $fechaFin!=NULL)
        <p>Reporte desde {{$fechaInicio}} hasta {{$fechaFin}}.</p>
    @endif

    <table style="border: 1px solid #ddd; border-collapse: collapse; width: 100%; text-align: center; font-size:12px; ">
        <thead style="background-color: #f5f5f5;">
            <tr>
                <th style="border: 1px solid #ddd; padding: 8px; width:15%;">FECHA</th>
                <th style="border: 1px solid #ddd; padding: 8px; width:15%;">N° DE OPERATIVOS</th>
                <th style="border: 1px solid #ddd; padding: 8px; width:24%;">TIPO DE OPERATIVO</th>
                <th style="border: 1px solid #ddd; padding: 8px; width:23%;">LUGAR DE INTERVENCIÓN</th>
                <th style="border: 1px solid #ddd; padding: 8px; width:25%;">N° DE ACTAS DE CONTROL IMPUESTAS</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($operativos as $operativo)
            <tr>
                <td style="border: 1px solid #ddd; padding: 8px;">{{ $operativo->fecha }}</td>
                <td style="border: 1px solid #ddd; padding: 8px;">{{ str_pad(1, 2, '0', STR_PAD_LEFT) }}</td>
                <td style="border: 1px solid #ddd; padding: 8px;">{{ $operativo->tipo }}</td>
                <td style="border: 1px solid #ddd; padding: 8px;">{{ $operativo->lugar }}</td>
                <td style="border: 1px solid #ddd; padding: 8px;">{{ str_pad(count(json_decode($operativo->actas, true)), 2, '0', STR_PAD_LEFT) }}</td>
            </tr>
            @endforeach
            <tr>
                <td style="border: 1px solid #ddd; padding: 8px;"><b>TOTAL</b></td>
                <td style="border: 1px solid #ddd; padding: 8px;">{{ str_pad($total_operativos, 2, '0', STR_PAD_LEFT) }}</td>
                <td style="border: 1px solid #ddd; padding: 8px;" colspan="2"></td>
                <td style="border: 1px solid #ddd; padding: 8px;">{{ str_pad($total_actas, 2, '0', STR_PAD_LEFT) }}</td>
            </tr>
        </tbody>
    </table>
</div>
