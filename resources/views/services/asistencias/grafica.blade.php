@extends('layouts.base_master')

@section('title', 'Afluencia de Personas')

@section('content')
<div class="container">
    <h1>Afluencia de Personas por Hora ({{ \Carbon\Carbon::parse($fecha)->format('d/m/y') }})</h1>
    
    <!-- Formulario para seleccionar la fecha -->
    <form method="GET" action="{{ route('asistencias.grafica') }}">
        <div class="form-group">
            <label for="fecha">Seleccionar Fecha:</label>
            <input type="date" id="fecha" name="fecha" class="form-control" value="{{ $fecha }}">
        </div>
        <button type="submit" class="btn btn-primary">Ver Historial</button>
        <a href="{{ route('asistencias.grafica', ['fecha' => \Carbon\Carbon::parse($fecha)->subDay()->toDateString()]) }}" class="btn btn-secondary">← Ver Día Anterior</a>
    </form>

    <!-- Gráfica de afluencia -->
    <div class="chart-container" style="position: relative; height:400px; width:800px">
        <canvas id="afluenciaChart"></canvas>
    </div>

    <!-- Gráfica de duración promedio -->
    <div class="chart-container" style="position: relative; height:400px; width:800px; margin-top: 50px;">
        <canvas id="duracionPromedioChart"></canvas>
    </div>
</div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // Gráfica de Afluencia
        var ctxAfluencia = document.getElementById('afluenciaChart').getContext('2d');
        var afluenciaData = {
            labels: [
                @foreach($afluenciaPorHora as $registro)
                    "{{ $registro->hora }}:00",
                @endforeach
            ],
            datasets: [{
                label: 'Personas Logueadas',
                data: [
                    @foreach($afluenciaPorHora as $registro)
                        {{ $registro->total }},
                    @endforeach
                ],
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        };

            var afluenciaChart = new Chart(ctxAfluencia, {
                type: 'bar',
                data: afluenciaData,
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1, // Hace que el eje Y aumente en pasos de 1
                                callback: function(value) { 
                                    if (Number.isInteger(value)) { 
                                        return value; 
                                    }
                                }
                            }
                        }
                    }
                }
        });

        // Gráfica de Duración Promedio
        var ctxDuracion = document.getElementById('duracionPromedioChart').getContext('2d');
        var duracionData = {
            labels: ["Duración Promedio"],
            datasets: [{
                label: 'Minutos en el Gimnasio',
                data: [{{ $duracionPromedio }}], // Duración promedio en minutos
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }]
        };

        var duracionChart = new Chart(ctxDuracion, {
            type: 'bar',
            data: duracionData,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endsection

