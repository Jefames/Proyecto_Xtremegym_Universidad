@extends('layouts.base_master')

@section('title', 'Asistencia de Clientes')

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
                    <h1 class="m-0"><b>Asistencia de Clientes</b></h1>
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
                        <i class="fas fa-users"></i>
                        <b>Estado de Asistencia de Clientes</b>
                    </h2>
                </div>
                <div class="card-body">
                    <!-- Formulario para seleccionar la fecha -->
                    <form method="GET" action="{{ route('notificaciones.asist') }}">
                        <div class="form-group">
                            <label for="fecha">Seleccionar Fecha:</label>
                            <input type="date" id="fecha" name="fecha" class="form-control" value="{{ $fecha }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Ver Historial</button> 
                        <a href="{{ route('notificaciones.asist', ['fecha' => \Carbon\Carbon::parse($fecha)->subDay()->toDateString()]) }}" class="btn btn-secondary">← Día Anterior</a>
                        <a href="{{ route('notificaciones.asist', ['fecha' => \Carbon\Carbon::parse($fecha)->addDay()->toDateString()]) }}" class="btn btn-secondary">Día Siguiente →</a>
                    </form>
                    <br>

                    <!-- Pestañas para separar Activos e Inactivos -->
                    <ul class="nav nav-tabs" id="clientesTabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="activos-tab" data-toggle="tab" href="#activos" role="tab" aria-controls="activos" aria-selected="true">Clientes Activos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="inactivos-tab" data-toggle="tab" href="#inactivos" role="tab" aria-controls="inactivos" aria-selected="false">Clientes Inactivos</a>
                        </li>
                    </ul>

                    <div class="tab-content" id="clientesTabsContent">
                        <!-- Pestaña 1: Clientes Activos -->
                        <div class="tab-pane fade show active" id="activos" role="tabpanel" aria-labelledby="activos-tab">
                            <br>
                            <h4>Clientes Activos (Dentro del Gimnasio) - {{ \Carbon\Carbon::parse($fecha)->format('d/m/y') }}</h4>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Hora de Entrada</th>
                                        <th>Estado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($activos as $asistencia)
                                        <tr>
                                            <td>{{ $asistencia->cliente->nombre }} {{ $asistencia->cliente->apellido }}</td>
                                            <td>{{ \Carbon\Carbon::parse($asistencia->hora_entrada)->format('H:i:s') }}</td>
                                            <td><span class="badge badge-success">Activo</span></td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center">No hay clientes activos en esta fecha.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Pestaña 2: Clientes Inactivos -->
                        <div class="tab-pane fade" id="inactivos" role="tabpanel" aria-labelledby="inactivos-tab">
                            <br>
                            <h4>Clientes Inactivos (SALIDA) -{{ \Carbon\Carbon::parse($fecha)->format('d/m/y') }}</h4>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Hora de Entrada</th>
                                        <th>Hora de Salida</th>
                                        <th>Estado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($inactivos as $asistencia)
                                        <tr>
                                            <td>{{ $asistencia->cliente->nombre }} {{ $asistencia->cliente->apellido }}</td>
                                            <td>{{ \Carbon\Carbon::parse($asistencia->hora_entrada)->format('H:i:s') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($asistencia->hora_salida)->format('H:i:s') }}</td>
                                            <td><span class="badge badge-danger">Inactivo</span></td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center">No hay clientes inactivos en esta fecha.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
