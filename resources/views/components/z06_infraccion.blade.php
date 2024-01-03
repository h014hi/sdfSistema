@php
    $nsa=false;
@endphp

<table>
    <thead>
        <tr>
            <th>Código:</th>
            <th>Calificación</th>
            <th>Consecuencia</th>
            <th>Importe *</th>
            <th>Importe con 50% dscto. **</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{ $infrac->codigo }}</td>
            <td>{{ $infrac->calificacion }}</td>
            <td>{{ $infrac->consecuencia }}</td>
            <td>{{ $infrac->importe }}</td>

            @if( $infrac->descuento=true)
                <td>{{ $infrac->importe/2 }}</td>
            @else
                {{ $nsa=true}}
                <td> NSA ***</td>
            @endif

        </tr>
    </tbody>
</table>

<div >
    <p class="m_p">
        *   Si usted no esta de acuerdo con realizar el importe respectivo, puede presentar un descargo dentro del
        plazo de cinco (5) dias habiles, contando despues del dia siguiente de la intervencion(no se cuentan Sabados
        o Domingos), de acuerdo al <b>D.S. Nº 004-2020-MTC, Artículo 7 numeral 7.1 > Efectuar los descargos de la
        imputación efectuada</b>
    </p>
    <p>
        Siempre y cuando tenga las suficientes evidencias para desvirtuar el acta de control.
    </p>
    <p class="m_p_infra">
        **  El importe con 50% de descuento se aplica siempre y cuando este dentro del plazo de los cinco (5) dias
        habiles, contando despues del dia siguiente de la intervencion(no se cuentan Sabados o Domingos).
    </p>
    @if ($nsa==true)
        <p class="m_p_infra">
            *** NSA: No se Aplica (No todas las infracciones tienen descuento).
        </p>
    @endif
</div>
<a href="{{ route('home') }}" class="btn btn-primary">
    Regresar a la página principal
</a>
