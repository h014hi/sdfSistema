<!-- Agrega la referencia a Chart.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
<!-- Agrega la referencia al plugin chartjs-plugin-datalabels -->
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0/dist/chartjs-plugin-datalabels.min.js"></script>

<!-- Crea el contenedor del gráfico -->
<canvas id="myChart" width="400" height="200"></canvas>

<script>
    
    var labels = {!! json_encode($labels) !!}; // Aquí se pasarán los datos desde el controlador
    var data = {!! json_encode($datos) !!}; // Aquí se pasarán los datos desde el controlador
    var backgroundColors = ['#FF5733', '#3366FF', '#33FF33'];

    // Configuración del gráfico
    var config = {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Data',
                data: data,
                backgroundColor: backgroundColors
            }]
        },
        options: {
            plugins: {
                datalabels: {
                    anchor: 'end',
                    align: 'end',
                    offset: 2,
                    color: '#666',
                    font: {
                        weight: 'bold'
                    },
                    formatter: function(value) {
                        return value;
                    }
                }
            },
            scales: {
                x: {
                    ticks: {
                        display: false // Para ocultar las etiquetas del eje X (opcional)
                    }
                },
                y: {
                    ticks: {
                        beginAtZero: true
                    }
                }
            }
        }
    };

    // Crea el gráfico
    var myChart = new Chart(document.getElementById('myChart'), config);
</script>
