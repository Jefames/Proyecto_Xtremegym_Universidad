@extends('layouts.base_master')

@section('title', 'Consulta de Cliente')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><b>Datos del Cliente, Número: {{$cliente->id}}</b></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('clientes.index')}}">Consultas</a></li>
                        <li class="breadcrumb-item active">Cliente</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <!-- Columna Principal -->
                <div class="col-lg-8">
                    <!-- Información General del Cliente -->
                    <div class="card card-outline card-primary m-2">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-user"></i><b> INFORMACIÓN GENERAL DEL CLIENTE</b></h3>
                        </div>
                        <div class="card-body">
                            <p><strong>Nombre Completo:</strong> {{ $cliente->nombre }} {{ $cliente->seg_nombre }} {{ $cliente->apellido }} {{ $cliente->seg_apellido }}</p>
                            <p><strong>Teléfono:</strong> {{ $cliente->telefono ?? 'N/A' }}</p>
                            <p><strong>Email:</strong> {{ $cliente->email ?? 'N/A' }}</p>
                            <p><strong>Dirección:</strong> {{ $cliente->direccion ?? 'N/A' }}</p>
                            <p><strong>Estado:</strong> {{ $cliente->estado ?  'Activo' : 'Inactivo' }}</p>
                        </div>
                    </div>

                    <!-- Botón de Acción en el Pie de Página -->
                    <div class="text-center m-3">
                        <a href="{{route('clientes.edit',$cliente->id)}}" class="btn btn-secondary"><i class="fas fa-edit"></i> Editar Cliente</a>
                        <!-- Otros botones si se requieren -->
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

