@extends('layouts.base_master')

@section('title', 'Generación de Reportes de Pagos')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css">
@endsection

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><b>Generación de Reportes de Pagos</b></h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card card-default">
                <div class="card-header">
                    <h2><i class="fas fa-list-alt"></i> Reportes de Pagos</h2>
                </div>

                <div class="card-body">
                    <form action="{{ route('pagos.reporte.export') }}" method="POST" target="_blank">
                        @csrf
                        <div class="row">
                            <div class="col-md-3">
                                <label for="fecha_inicio">Fecha de Inicio:</label>
                                <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" required>
                            </div>
                            <div class="col-md-3">
                                <label for="fecha_fin">Fecha de Fin:</label>
                                <input type="date" class="form-control" id="fecha_fin" name="fecha_fin" required>
                            </div>
                            <div class="col-md-6 align-self-end">
                                <button type="submit" name="tipo_reporte" value="pdf" class="btn btn-danger">
                                    <i class="fas fa-file-pdf"></i> Generar PDF
                                </button>
                                <button type="submit" name="tipo_reporte" value="excel" class="btn btn-success">
                                    <i class="fas fa-file-excel"></i> Generar Excel
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
