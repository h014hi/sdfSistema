<table>
    <thead>
        <tr>
            <th>Código:</th>
            <th>Calificación</th>
            <th>Consecuencia</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{ $infrac->codigo }}</td>
            <td>{{ $infrac->calificacion }}</td>
            <td>{{ $infrac->consecuencia }}</td>
        </tr>
    </tbody>
</table>

<p class="m_p">
    Usted puede presentar su descargo dentro del plazo de 5 dias habiles, contando luego del dia siguiente a la
    intervencion (No se cuentan Sabados o Domingos), de acuerdo al:
</p>
<p>
   <b>D.S. Nº 004-2020-MTC, Artículo 7 numeral 7.1 : Efectuar los descargos de la imputación efectuada.</b></p>
<p>
    Siempre y cuando tenga las suficientes evidencias para desvirtuar el acta de control.
</p>
<a href="{{ route('home') }}" class="btn btn-primary">
    Regresar a la página principal
</a>
