@php
    $indicaciones = "INGRESE N° DE RESOLUCION";
    $ndigits = 7;
@endphp
<form class="row col-md-12"  action="{{ route('consultardr.buscar') }}" method="GET">
    @csrf
        <div class=" col-md-3 form-group">
            <label for="buscar_por">BUSCAR RDR POR:</label>
            <select class="form-control" id="buscar_por" name="buscar_por">
                <option type= "text" value="rdr">N° RDR</option>
                <option type= "text" value="acta">N° ACTA DE CONTROL</option>
            </select>

        </div>

        <div class="col-md-3 form-group">
            <label for="nombre"  id="indicaciones-label"> {{$indicaciones}}:</label>
            <input type="text" class="form-control" id="nrdr" name="nrdr" placeholder="Ej. 1234" autocomplete="off" required oninput="limitarDigitos(this,{{$ndigits}})">
            <div class="invalid-feedback">Este campo es obligatorio.</div>
        </div>

        <div class="col-md-3 form-group">
            <label for="date" style="font-size: 15px;">FECHA: (Opcional)</label>
            <input type="date" class="form-control" id="fechardr" name="fechardr" placeholder="Opcional">
        </div>

    <div class="col-md-3">
        <button type="submit" class="col-md-12 btn btn-primary" style = "background-color: #187BEC; margin: 10%;">BUSCAR</button>
    </div>


</form>


<!--PARA HACER DINAMICO EL PLACEHOLDER QUE AYUDARA A LOS CONDUCTORES-->

<script>

    // Obtener referencia a los elementos
    const opciones = document.getElementById('buscar_por');
    const campo = document.getElementById('actardr');
    const indicacionesLabel = document.getElementById('indicaciones-label');

    // Escuchar el evento de cambio en el primer elemento
    opciones.addEventListener('change', function() {
        // Obtener el valor seleccionado
        const opcionSeleccionada = opciones.value;

        // Actualizar el placeholder del segundo elemento según la selección
        if (opcionSeleccionada === 'rdr') {
        campo.placeholder = 'Ej. 0123';
        indicacionesLabel.innerText = 'INGRESE EL N° DE RDR';
        campo.maxLength = 4;
        campo.oninput = function() {
            limitarDigitos(this, 4);
        };
    } else if (opcionSeleccionada === 'acta') {
        campo.placeholder = 'Ej. 0000452';
        indicacionesLabel.innerText = 'INGRESE EL N° DEL ACTA DE CONTROL';
        campo.oninput = function() {
            limitarDigitos(this, 7);
        };
    }
    });
    function limitarDigitos(inputElement, maxLength) {
        let inputValue = inputElement.value;
        inputValue = inputValue.slice(0, maxLength);
        inputElement.value = inputValue;
    }
</script>


