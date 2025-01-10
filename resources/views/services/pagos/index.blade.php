@extends('layouts.base_master')

@section('title', 'Listado de Pagos')

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
                    <h1 class="m-0"><b>Listado de Pagos de Clientes</b></h1>
                    <div class="dropdown-divider"></div>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item active">Listado de Pagos</li>
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
                        <b>Información de Pagos</b>
                    </h2>
                </div>
                <div class="card-body">
                    <div class="container">

                        <div class="text-right mb-3">
                            <a href="{{ route('pagos.reportes') }}" class="btn btn-primary">
                                <i class="fas fa-chart-bar"></i> Generar Reportes
                            </a>
                        </div>

                        <br>
                        <table class="table table-bordered" id="pagos">
                            <thead>
                                <tr>
                                    <th>Cliente</th>
                                    <th>Membresía</th>
                                    <th>Fecha de Pago</th>
                                    <th>Monto</th>
                                    <th>Método de Pago</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pagos as $pago)
                                <tr>
                                    <td>{{ $pago->cliente->nombre }} {{ $pago->cliente->apellido }}</td>
                                    <td>{{ $pago->membresia->tipomem }}</td> <!-- Mostrar la membresía -->
                                    <td>{{ \Carbon\Carbon::parse($pago->fecha_inicio)->format('d/m/y') }}</td>
                                    <td>{{ $pago->total }}</td>
                                    <td>
                                        @if($pago->metodo_pago == 'efectivo')
                                            <span class="badge badge-success">Efectivo</span>
                                        @else
                                            <span class="badge badge-secondary">{{ ucfirst($pago->metodo_pago) }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <!-- Botón para ver detalles del pago -->
                                        <a href="{{ route('pagos.show', $pago->id) }}" class="btn btn-info btn-sm">
                                            <i class="fas fa-eye"></i> Ver Pago
                                        </a>

                                        <!-- Botón para generar la factura en PDF -->
                                        <a href="{{ route('pagos.factura', $pago->id) }}" class="btn btn-primary btn-sm">
                                            <i class="fas fa-file-pdf"></i> Generar Comprobante
                                        </a>

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
        $('#pagos').DataTable({
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
