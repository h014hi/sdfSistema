@php
    $indicaciones = "INGRESE DNI DEL CONDUCTOR";
@endphp

<form class="row col-md-12"  action="{{ route('consulta.buscar') }}" method="GET">
            @csrf
                
                    <div class=" col-md-3 form-group">
                    <label for="tipo">SELECCIONAR DOCUMENTO:</label>
                    <select class="form-control" id="tipo" name="tipo">
                        <option type= "text" value="tipo1">DNI DEL CONDUCTOR</option>
                        <option type= "text" value="tipo2">NUMERO DEL ACTA DE CONTROL</option>
                        <option type= "text" value="tipo3">PLACA DEL VEHICULO</option>
                    </select>
                    </div>
               
                    <div class="col-md-3 form-group">
                    <label for="nombre"  id="indicaciones-label"> {{$indicaciones}}:</label>
                    <input type="text" class="form-control" id="actadecontrol" name="actadecontrol" placeholder="Ej. 75XXXXXX" autocomplete="off" required>
                    <div class="invalid-feedback">Este campo es obligatorio.</div>
                    </div>
                
                    <div class="col-md-3 form-group">
                    <label for="nombre">FECHA DE INSPECCIÓN:</label>
                    <input type="date" class="form-control" id="fecha" name="fecha" placeholder="xxxxxxxxx">
                    </div>
              
                <div class="col-md-3">
                    <button type="submit" class="col-md-12 btn btn-primary" style = "background-color: #187BEC; margin: 10%;">BUSCAR</button>
                </div>
</form>

<!--PARA HACER DINAMICO EL PLACEHOLDER QUE AYUDARA A LOS CONDUCTORES-->

<script>
    // Obtener referencia a los elementos
    const opciones = document.getElementById('tipo');
    const campo = document.getElementById('actadecontrol');
    const indicacionesLabel = document.getElementById('indicaciones-label');

    // Escuchar el evento de cambio en el primer elemento
    opciones.addEventListener('change', function() {
        // Obtener el valor seleccionado
        const opcionSeleccionada = opciones.value;

        // Actualizar el placeholder del segundo elemento según la selección
        if (opcionSeleccionada === 'tipo1') {
        campo.placeholder = 'Ej. 75XXXXXX';
        indicacionesLabel.innerText = 'INGRESE EL DNI DEL CONDUCTOR';
        } else if (opcionSeleccionada === 'tipo2') {
        campo.placeholder = 'Ej. 0000XXXX';
        indicacionesLabel.innerText = 'INGRESE N° DE ACTA';
        } else if (opcionSeleccionada === 'tipo3') {
        campo.placeholder = 'Ej. XYZ-123';
        indicacionesLabel.innerText = 'INGRESE LA PLACA DEL VEHICULO';
        }
    });
</script>

