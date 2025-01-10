@extends('layouts.base_master')

@section('title', 'Notificaciones de Acceso')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.bootstrap4.min.css">
@endsection

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><b>Notificaciones de Acceso</b></h1>
                    <div class="dropdown-divider"></div>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card card-default">
                <div class="card-header">
                    <h2 class="card-title">
                        <i class="fas fa-list-alt"></i>
                        <b>Registro de Notificaciones</b>
                    </h2>
                </div>
                <div class="card-body">
                    <!-- Formulario para seleccionar la fecha -->
                    <form method="GET" action="{{ route('notificaciones.index') }}">
                        <div class="form-group">
                            <div class="input-group">
                                <!-- Botón para el día anterior -->
                                <div class="input-group-prepend">
                                    <a href="{{ route('notificaciones.index', ['fecha' => \Carbon\Carbon::parse($fecha)->subDay()->toDateString()]) }}" class="btn btn-secondary">← Día Anterior</a>
                                </div>
                                
                                <!-- Selector de fecha -->
                                <input type="date" id="fecha" name="fecha" class="form-control" value="{{ $fecha }}">

                                <!-- Botón para el día siguiente -->
                                <div class="input-group-append">
                                    <a href="{{ route('notificaciones.index', ['fecha' => \Carbon\Carbon::parse($fecha)->addDay()->toDateString()]) }}" class="btn btn-secondary">Día Siguiente →</a>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Ver Historial</button>
                    </form>
                    <br>

                    <!-- Tabla de notificaciones -->
                    <table class="table table-bordered" id="notificaciones">
                        <thead>
                            <tr>
                                <th>Cliente</th>
                                <th>Mensaje</th>
                                <th>Fecha</th>
                            </tr>
                        </thead>
                        <tbody id="notificaciones-body">
                            @forelse($notificaciones as $notificacion)
                                <tr>
                                    <td>{{ $notificacion->cliente ? $notificacion->cliente->nombre : 'Desconocido' }}</td>
                                    <td>{{ $notificacion->mensaje }}</td>
                                    <td>{{ \Carbon\Carbon::parse($notificacion->created_at)->format('H:i:s') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center">No hay notificaciones para esta fecha.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            // Cargar las notificaciones usando AJAX
            function cargarNotificaciones() {
                $.ajax({
                    url: '{{ route('notificaciones.get') }}',
                    method: 'GET',
                    success: function(data) {
                        let notificacionesHtml = '';
                        data.forEach(function(notificacion) {
                            notificacionesHtml += `
                                <tr>
                                    <td>${notificacion.cliente ? notificacion.cliente.nombre : 'Desconocido'}</td>
                                    <td>${notificacion.mensaje}</td>
                                    <td>${notificacion.created_at}</td>
                                </tr>`;
                        });
                        $('#notificaciones-body').html(notificacionesHtml);
                    }
                });
            }

            // Cargar notificaciones al cargar la página
            cargarNotificaciones();

            // Refrescar notificaciones cada 10 segundos
            setInterval(cargarNotificaciones, 10000);
        });
    </script>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            // Función para cargar las notificaciones usando AJAX
            function cargarNotificaciones() {
                $.ajax({
                    url: '{{ route('notificaciones.get') }}',
                    method: 'GET',
                    success: function(data) {
                        let notificacionesHtml = '';
                        data.forEach(function(notificacion) {
                            notificacionesHtml += `
                                <tr>
                                    <td>${notificacion.cliente ? notificacion.cliente.nombre : 'Desconocido'}</td>
                                    <td>${notificacion.mensaje}</td>
                                    <td>${notificacion.created_at}</td>
                                </tr>`;
                        });
                        $('#notificaciones-body').html(notificacionesHtml);
                    }
                });
            }

            // Cargar las notificaciones al cargar la página
            cargarNotificaciones();

            // Refrescar las notificaciones cada 10 segundos
            setInterval(cargarNotificaciones, 10000);
        });
    </script>
@endsection
