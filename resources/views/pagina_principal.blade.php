<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>SDF-PUNO</title>

        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="../css/app.css">
    </head>
    <body class=" container col-md-12">
        <div class="col-md-12">

            <x-navfiscalizacion/>


            @if (Route::has('login'))
                <div class=" navar col-md-12 text-right">
                    @auth
                        <a href="{{ url('/operativos') }}" class="font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Iniciar Sesión</a>

                        <!-- @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                        @endif -->
                    @endauth
                </div>
            @endif

            <br>
            <div class="col-md-12">
            <p class="text-center" style="font-size: 130%;"><b>VERIFICA TU ACTA DE CONTROL</b></p>
            <br>


            </div>

            <!--FORMULARIO DE CONSULTA-->
            <div class="col-md-12">
                <x-z02_formulario_consulta/>
            </div>

            <div class=" col-md-12 table-responsive">

                <table class="table" style="font-size: 75%; text-align: center;">

                        <!--CABECERA-->
                        <thead class="thead-dark">
                                <tr>
                                    <th scope="col">N° DE ACTA DE CONTROL</th>
                                    <th scope="col">FECHA DE INTERVENCION</th>
                                    <th scope="col">LUGAR DE INTERVENCIÓN</th>
                                    <th scope="col">CONDUCTOR INTERVENIDO</th>
                                    <th scope="col">PLACA DEL VEHICULO</th>
                                    <th scope="col">CODIGO DE INFRACCION Y/O INCUMPLIMIENTO</th>
                                    <th scope="col">DESCRIPCION</th>
                                    <th scope="col">AVISO</th>
                                    <th scope="col">ESTADO</th>
                                </tr>
                        </thead>

                @if(isset($resultados) && count($resultados) > 0)

                    <!--TABLA DE ACTAS-->
                        <x-z01_tabla_actas :resultados="$resultados"></x-z01_tabla_actas>


                @else
                    @if(isset($mensaje) && count($mensaje) > 0)
                        <script>
                            // Función para mostrar una alerta personalizada
                            function mostrarAlerta(conflicto,mensaje) {
                                Swal.fire({
                                title:conflicto,
                                text: mensaje,
                                icon: 'error',
                                confirmButtonText: 'Aceptar',
                                customClass: {
                                    popup: 'mi-alerta',
                                    title: 'mi-titulo',
                                    confirmButton: 'mi-boton'
                                }
                                });
                            }
                            mostrarAlerta('{{$mensaje[0]}}','{{$mensaje[1]}}');
                        </script>
                    @endif
                @endif

                </table>

                @if(isset($resultados) && count($resultados) > 0)
                    @foreach($resultados as $acta)
                        <div class="container w-25" >
                            @php
                                $infraccion_data = [
                                    'infra_id'      => $acta->infraccion->id,
                                    'codigo'        => $acta->infraccion->codigo,
                                    'tipo'          => $acta->infraccion->tipo,
                                    'descripcion'   => $acta->infraccion->descripcion,
                                    'calificacion'  => $acta->infraccion->calificacion,
                                    'm_preventivas' => $acta->infraccion->m_preventivas,
                                    'consecuencia'  => $acta->infraccion->consecuencia,
                                    'importe'       => $acta->infraccion->importe,
                                    'descuento'     => $acta->infraccion->descuento,
                                ];
                                $infra_data_cypher = encrypt(json_encode($infraccion_data));
                            @endphp
                            <a href="{{ route('infraccion.mostrar',['data_infrac'=>$infra_data_cypher]) }}"
                            class="btn btn-info w-100">
                                SABER MÁS DE MI INFRACCIÓN...
                            </a>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>

    </body>
</html>




