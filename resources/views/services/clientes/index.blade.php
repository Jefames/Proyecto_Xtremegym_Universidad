@extends('layouts.base_master')

@section('title', 'Consultas de Clientes')

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
                    <h1 class="m-0"><b>Consultas de Datos del Cliente</b></h1>
                    <div class="dropdown-divider"></div>

                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
 {{-- Mostrar mensajes de éxito o error --}}
 @if(session('success'))
 <div class="alert alert-success alert-dismissible fade show" role="alert">
     {{ session('success') }}
     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
         <span aria-hidden="true">&times;</span>
     </button>
 </div>
@endif

@if(session('error'))
 <div class="alert alert-danger alert-dismissible fade show" role="alert">
     {{ session('error') }}
     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
         <span aria-hidden="true">&times;</span>
     </button>
 </div>
@endif
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <br>
            <div class="card card-default">
                <div class="card-header">
                    <h2 class="card-title">
                        <i class="fas fa-list-alt"></i>
                        <b>Informacion - Clientes SPORTGYM</b>
                    </h2>
                </div>
                <div class="card-header">
                    <a href="{{ route('clientes.create') }}" class="btn btn-primary btn-flat btn-sm">
                        <i class="fas fa-file-medical"></i> Nuevo Cliente
                    </a>
                </div>
                <div class="card-body">
                    <br>
                    <table class="table table-bordered" id="clientes">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre Completo</th>
                            <th>Teléfono</th>
                            <th>Dirección</th>
                            <th>Email</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($clientes as $cliente)
                            <tr>
                                <td>{{ $cliente->id }}</td>
                                <td>{{ $cliente->nombre }} {{ $cliente->seg_nombre }} {{ $cliente->apellido }} {{ $cliente->seg_apellido }}</td>
                                <td>{{ $cliente->telefono }}</td>
                                <td>{{ $cliente->direccion }}</td>
                                <td>{{ $cliente->email }}</td>
                                <td>{{ $cliente->estado ? 'Activo' : 'Inactivo' }}</td>
                                <td>
                                    <a href="{{ route('clientes.show', $cliente->id) }}" class="btn btn-success btn-flat btn-sm"><i class="fas fa-eye"></i></a>
                                    <a href="{{ route('clientes.edit', $cliente->id) }}" class="btn btn-sm btn-warning btn-flat "><i class="fas fa-edit"></i></a>
                                    @if ($cliente->estado)
                <!-- Si el cliente está activo, mostrar el botón "Desactivar" -->
                                        <form action="{{ route('clientes.inactivar', $cliente->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash"></i> Desactivar
                                            </button>
                                        </form>
                                        @else
                                        <!-- Si el cliente está inactivo, mostrar el botón "Reactivar" -->
                                        <form action="{{ route('clientes.reactivar', $cliente->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-success btn-sm">
                                                <i class="fas fa-check"></i> Reactivar
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                         
                         
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.4.1/js/responsive.bootstrap4.min.js"></script>

    <script>
        $('#clientes').DataTable({
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

