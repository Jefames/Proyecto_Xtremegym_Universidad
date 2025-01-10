@extends('layouts.base_master')

@section('title', 'Lista de Membresías')


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
                    <h1 class="m-0"><b>Lista de Membresías</b></h1>
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

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <br>
            <div class="card card-default">
                <div class="card-header">
                    <h2 class="card-title">
                        <i class="fas fa-list-alt">  </i>
                        <b>Listado de Membresías</b>
                    </h2>
                </div>
                <div class="card-header">
                    <a href="{{ route('membresias.create') }}" class="btn btn-primary btn-flat btn-sm">
                        <i class="fas fa-file-medical"></i> Nueva Membresía
                    </a>
                </div>
                <div class="card-body">
                    <br>
                    <table class="table table-bordered" id="membresias">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tipo de Membresía</th>
                            <th>Tiempo (Días)</th>
                            <th>Descripción</th>
                            <th>Precio</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($membresias as $membresia)
                            <tr>
                                <td>{{ $membresia->id }}</td>
                                <td>{{ $membresia->tipomem }}</td>
                                <td>{{ $membresia->tiempo }}</td>
                                <td>{{ $membresia->descripcion }}</td>
                                <td>{{ $membresia->precio }}</td>
                                <td>
                                    <a href="{{ route('membresias.edit', $membresia->id) }}" class="btn btn-sm btn-warning btn-flat">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    {{-- <form action="{{ route('membresias.destroy', $membresia->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger btn-flat" onclick="return confirm('¿Estás seguro de que quieres eliminar esta membresía?');">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form> --}}
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

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.4.1/js/responsive.bootstrap4.min.js"></script>

    <script>
        $('#membresias').DataTable({
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
