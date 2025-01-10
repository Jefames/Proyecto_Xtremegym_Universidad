@extends('layouts.base_master')

@section('title', 'Listado de Suscripciones')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.bootstrap4.min.css">
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><b>Listado de Suscripciones de Clientes</b></h1>
                    <div class="dropdown-divider"></div>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item active">Listado de Suscripciones</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <br>
            <div class="card card-default">
                <div class="card-header">
                    <h2 class="card-title">
                        <i class="fas fa-list-alt"></i>
                        <b>Información de Suscripciones</b>
                    </h2>
                </div>
                <div class="card-body">
                    <div class="container">
                        <br>        

                        <table class="table table-bordered" id="clienteMembresias">
                            <thead>
                                <tr>
                                    <th>Cliente</th>
                                    <th>Membresía</th>
                                    <th>Fecha Inicio</th>
                                    <th>Fecha Finalización</th>
                                    <th>Total</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($clienteMembresias as $suscripcion)
                                <tr>
                                    <td>{{ $suscripcion->cliente->nombre }} {{ $suscripcion->cliente->apellido }}</td>
                                    <td>{{ $suscripcion->membresia->tipomem }}</td>
                                    <td>{{ \Carbon\Carbon::parse($suscripcion->fecha_inicio)->format('d/m/y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($suscripcion->fecha_finalizacion)->format('d/m/y') }}</td>
                                    <td>{{ $suscripcion->total }}</td>
                                    <td>
                                        @if($suscripcion->estado == 'activa')
                                        <span class="badge badge-success">Activo</span>
                                            <form action="{{ route('suscripciones.suspender', $suscripcion->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-warning btn-sm">
                                                    <i class="fas fa-ban"></i> Suspender
                                                </button>
                                            </form>
                                        @else
                                            <span class="badge badge-secondary">Suspendida</span>
                                        @endif
                                    </td>
                                    
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.4.1/js/responsive.bootstrap4.min.js"></script>

    <script>
        $('#clienteMembresias').DataTable({
            responsive: true,
            autoWidth: false,
            "language": {
                "lengthMenu": "Mostrar " + "<select class='custom-select custom-select-sm form-control form-control-sm'><option value='10'>10</option><option value='25'>25</option><option value='50'>50</option><option value='100'>100</option> <option value='-1'>Todos</option></select> registros por página",
                "zeroRecords": "No se encontró ningún registro",
                "info": "Mostrando página _PAGE_ de _PAGES_",
                "infoEmpty": "No hay registros disponibles",
                "infoFiltered": "(filtrado de _MAX_ registros totales)",
                "search": "Buscar",
                "paginate": {
                    'next': 'Siguiente',
                    'previous': 'Anterior'
                }
            }
        });
    </script>

@endsection
