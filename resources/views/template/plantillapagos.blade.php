@include('template.plantillaheader')
<hr>
    <h2 style="text-align: center;">REPORTE DE PAGOS</h2>
    <h5 style="text-align: center;">SUBDIRECCIÓN DE FISCALIZACIÓN</h5>
<hr>
<p style="text-align: left;"><i><b>FECHA DE CONSULTA: </b>{{$fechahoy}}</p></i>
@if ($fechaInicio!=NULL && $fechaFin!=NULL)
    <p>Reporte desde {{$fechaInicio}} hasta {{$fechaFin}}.</p>
@endif

<table style="width: 100%; border-collapse: collapse; margin: auto; border: 1px solid #ccc; text-align: center;">
     <thead>
         <tr>
             <th style="border: 1px solid #ccc; padding: 8px; background-color:#0c5ba1;  color: white;">TIPO DE PAGO</th>
             <th style="border: 1px solid #ccc; padding: 8px; background-color:#0c5ba1;  color: white;">MONTO TOTAL</th>
         </tr>
     </thead>
     <tbody>
        <tr>
            <td style="border: 1px solid #ccc; padding: 8px;">MONTOS RECAUDADOS POR MULTAS (ACTAS DE CONTROL)</td>
            <td style="border: 1px solid #ccc; padding: 8px;">{{$p_infraccion}}</td>
        </tr>

        <tr>
            <td style="border: 1px solid #ccc; padding: 8px;">MONTOS RECAUDADOS POR MULTAS DE RESOLUCIÓN DE SANCIÓN</td>
            <td style="border: 1px solid #ccc; padding: 8px;">{{$p_rdr}}</td>
        </tr>

        <tr>
            <td style="border: 1px solid #ccc; padding: 8px;">MONTOS RECAUDADOS POR DERECHOS DE TRÁMITES</td>
            <td style="border: 1px solid #ccc; padding: 8px;">{{$p_tramite}}</td>
        </tr>

        <tr>
            <td style="border: 1px solid #ccc; padding: 8px;">MONTOS RECAUDADOS POR DESCARGOS</td>
            <td style="border: 1px solid #ccc; padding: 8px;">{{$p_descargo}}</td>
        </tr>


        <tr>
            <td style="border: 1px solid #ccc; padding: 8px;">TOTAL</td>
            <td style="border: 1px solid #ccc; padding: 8px;">{{$p_infraccion+$p_rdr+$p_tramite+$p_descargo}}</td>
        </tr>

     </tbody>
 </table>
