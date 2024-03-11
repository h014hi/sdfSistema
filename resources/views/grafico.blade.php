<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('GENERAR REPORTES') }}
            </h2>
            <div class="ml-auto">
                <x-reportepdf :empresas="$empresas"></x-reportepdf>
            </div>
        </div>
    </x-slot>



    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-12 lg:px-10">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg" style="padding: 20px">
                <form class="form-inline" action="{{ route('grafico') }}" method="GET">
                    @csrf

                    <div class="d-flex align-items-center">
                        <div class="form-group mr-2 mb-2">
                            <label for="fecha_inicio" style="margin: 10px;"><b>Fecha Inicio:</b></label>
                            <input type="date" name="fecha_inicio" class="form-control" required>
                        </div>

                        <div class="form-group mr-2 mb-2">
                            <label for="fecha_fin"  style="margin: 10px;"><b>Fecha Fin:</b></label>
                            <input type="date" name="fecha_fin" class="form-control"  required>
                        </div>

                        <input type="hidden" name="tipo" value="{{$tipo}}">

                        <button type="submit" class="btn btn-danger" style="background-color: #EC4518; margin: 2px 10px 10px 10px;">Generar Gráfico</button>
                    </div>
                </form>

                <hr><br>

                <center>
                <div style="width: 50%;">
                    @php
                    $suma = 0;
                    for($i = 0; $i<sizeof($datos); $i++)
                    {
                        $suma+=$datos[$i];
                    }
                    @endphp
                    <p><b>GRAFICO GENERAL DE UN TOTAL DE {{$suma}} ACTAS</b></p>
                    <canvas id="myChart"></canvas>
                </div>
                </center>
                <div class="d-flex justify-content-center mt-4">
                    <div class="btn-group" role="group" aria-label="Cambiar Tipo">
                        <form action="{{ route('grafico') }}" method="GET">
                            <input type="hidden" name="tipo" value="infraccion">
                            <button type="submit" class="btn btn-primary hover-bg-white neg">Infracciones</button>
                        </form>
                        <form action="{{ route('grafico') }}" method="GET">
                            <input type="hidden" name="tipo" value="incumplimiento">
                            <button type="submit" class="btn btn-primary hover-bg-white neg">Incumplimientos</button>
                        </form>
                    </div>
                </div>



            </div>


        </div>
    </div>
</x-app-layout>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($label) !!},
            datasets: [{
                label: 'Cantidad de Actas',
                data: {!! json_encode($datos) !!},
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
<style>
    .neg{
        color: black;
    }
</style>
