@php
    $indicaciones = "INGRESE N° DE ACTA DE CONTROL";
    $ndigits = 7;
@endphp
<form class="row col-md-12"  action="{{ route('consulta.buscar') }}" method="GET">
    @csrf
        <div class=" col-md-3 form-group">
            <label for="tipo">SELECCIONAR TIPO DE DOCUMENTO :</label>
            <select class="form-control" id="tipo" name="tipo">
                <option type= "text" value="tipo1">DNI DEL CONDUCTOR</option>
                <option type= "text" value="tipo2" selected>N° DEL ACTA DE CONTROL</option>
                <option type= "text" value="tipo3">PLACA DEL VEHICULO</option>
            </select>

            <!--BOTON DE AYUDA INDICACIONES-->
            <a class="btn-ayuda" onclick="mostrarAyuda()" id="ayuda">
                <center>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-question-octagon" viewBox="0 0 16 16">
                        <path d="M4.54.146A.5.5 0 0 1 4.893 0h6.214a.5.5 0 0 1 .353.146l4.394 4.394a.5.5 0 0 1 .146.353v6.214a.5.5 0 0 1-.146.353l-4.394 4.394a.5.5 0 0 1-.353.146H4.893a.5.5 0 0 1-.353-.146L.146 11.46A.5.5 0 0 1 0 11.107V4.893a.5.5 0 0 1 .146-.353L4.54.146zM5.1 1 1 5.1v5.8L5.1 15h5.8l4.1-4.1V5.1L10.9 1H5.1z"/>
                        <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z"/>
                    </svg>
                </center>
            </a>
        </div>

        <div class="col-md-3 form-group">
            <label for="nombre"  id="indicaciones-label"> {{$indicaciones}}:</label>
            <input type="text" class="form-control" id="actadecontrol" name="actadecontrol" placeholder="Ej. 01524563" autocomplete="off" required oninput="limitarDigitos(this,{{$ndigits}})">
            <div class="invalid-feedback">Este campo es obligatorio.</div>
        </div>

        <div class="col-md-3 form-group">
            <label for="date" style="font-size: 15px;">FECHA: (Opcional)</label>
            <input type="date" class="form-control" id="fecha" name="fecha" placeholder="Opcional">
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
        campo.placeholder = 'Ej. 01524563';
        indicacionesLabel.innerText = 'INGRESE EL DNI DEL CONDUCTOR';
        campo.maxLength = 8;
        campo.oninput = function() {
            limitarDigitos(this, 8);
        };
    } else if (opcionSeleccionada === 'tipo2') {
        campo.placeholder = 'Ej. 784';
        indicacionesLabel.innerText = 'INGRESE EL N° DEL ACTA DE CONTROL';
        campo.oninput = function() {
            limitarDigitos(this, 7);
        };
    } else if (opcionSeleccionada === 'tipo3') {
        campo.placeholder = 'Ej. X2Z-123';
        indicacionesLabel.innerText = 'INGRESE LA PLACA DEL VEHICULO';
        campo.oninput = function() {
            limitarDigitos(this, 7);
        };
    }
    });

    // funcion para ayuda
    function mostrarAyuda() {
        Swal.fire({
            html: `
            <div>
                <h4 style="color: black;"><b>UBICA LOS DATOS DE TU ACTA DE CONTROL</b></h4>
                <br>

                <img src="{{ asset('image/acta_ejemplo.png') }}" style="width:100%;">
            </div>
                `,
            confirmButtonText: 'Aceptar',
            width: '50%',
        });
    }

    //Funcion mostrar tabla infraccion onclick
    function mostrarInfraccion(codigo,descripcion,consequencia) {
        Swal.fire({
            html: `
                <h3 style="color: black;"><b>Sobre la Infraccion o Incumplimiento</b></h3>
                <br>
                <style>
                    table {
                        width: 100%;
                        border-collapse: collapse;
                    }

                    th, td {
                        border-bottom: 1px solid black; /* Añade un borde inferior a las celdas de encabezado y datos */
                        padding: 8px;
                        text-align: left;
                    }

                    th {
                        border-top: 1px solid black; /* Añade un borde superior a las celdas de encabezado */
                    }

                    tr:last-child td {
                        border-bottom: 0px solid black; /* Elimina el borde inferior de la última fila de datos */
                    }
                </style>

                <!--TABLA FLOTANTE -->
                <table>
                    <tr>
                        <th>Codigo</th>
                        <th style="width:70%;">Infraccion</th>
                        <th>Consecuencia</th>
                    </tr>
                    <tr>
                        <td>${codigo}</td>
                        <td>${descripcion}</td>
                        <td>${consequencia}</td>
                    </tr>
                </table>
            `,
            confirmButtonText: 'Aceptar',
            width: '75%'
        });
    }
    function limitarDigitos(inputElement, maxLength) {
        let inputValue = inputElement.value;
        inputValue = inputValue.slice(0, maxLength);
        inputElement.value = inputValue;
    }
</script>

<style>
    #ayuda
        {
            border-radius: 50%;
            position: absolute;
            top: 3px;
            right: 9%;
            color:black;
            z-index: 0;
        }
</style>

