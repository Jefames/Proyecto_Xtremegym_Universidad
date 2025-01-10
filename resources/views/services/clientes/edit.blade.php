@extends('layouts.base_master')

@section('title', 'Editar expedienteCliente')

@section('content')
    <!-- Content Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><b>MODIFICACIÓN INFORMACION DE Cliente: {{$expedienteCliente->id}}</b></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('clientes.index')}}">Consulta Información del Cliente</a></li>
                        <li class="breadcrumb-item active">Editar Datos</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card card-default">
                <div class="card-header">
                    <h2 class="card-title">
                        <i class="fas fa-edit"></i>
                        <b>Edición de Datos</b>
                    </h2>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <i class="fas fa-exclamation-triangle"></i>
                            <strong>¡Oops! Algo salió mal...</strong>

                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li> {{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('clientes.update', $expedienteCliente->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Pestañas -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="pill" href="#custom-tabs-one-personales" role="tab" aria-controls="custom-tabs-one-personales" aria-selected="true">
                                    Datos Personales
                                </a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <!-- Contenido Pestaña 1: Datos Personales -->
                            <div class="tab-pane fade show active" id="custom-tabs-one-personales" role="tabpanel">
                                <br>
                                <div class="row">
                                    {{-- DATOS DE NOMBRES --}}
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="nombre">Primer Nombre</label>
                                            <abbr title="Campo obligatorio" class="required-indicator">*</abbr>
                                            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $expedienteCliente->nombre }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="seg_nombre">Segundo Nombre</label>
                                            <input type="text" class="form-control" id="seg_nombre" name="seg_nombre" value="{{ $expedienteCliente->seg_nombre }}">
                                        </div>
                                    </div>

                                    {{-- DATOS DE APELLIDOS --}}
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="apellido">Primer Apellido</label>
                                            <abbr title="Campo obligatorio" class="required-indicator">*</abbr>
                                            <input type="text" class="form-control" id="apellido" name="apellido" value="{{ $expedienteCliente->apellido }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="seg_apellido">Segundo Apellido</label>
                                            <input type="text" class="form-control" id="seg_apellido" name="seg_apellido" value="{{ $expedienteCliente->seg_apellido }}">
                                        </div>
                                    </div>

                                    {{-- OTROS DATOS --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="telefono">Teléfono</label>
                                            <input type="text" class="form-control" id="telefono" name="telefono" maxlength="8" value="{{ $expedienteCliente->telefono }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email">Correo Electrónico</label>
                                            <input type="email" class="form-control" id="email" name="email" value="{{ $expedienteCliente->email }}">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="direccion">Dirección</label>
                                            <input type="text" class="form-control" id="direccion" name="direccion" value="{{ $expedienteCliente->direccion }}">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            @if(is_null($expedienteCliente->biometrico))
                                                <button type="button" class="btn btn-secondary" id="enrolarHuellaBtn">
                                                    <i class="fas fa-fingerprint"></i> Enrolar Huella Digital
                                                </button>
                                            @else
                                                <button type="button" class="btn btn-secondary" disabled>
                                                    <i class="fas fa-fingerprint"></i> Huella ya registrada
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>

                            <!-- Botón de Guardar Cambios -->
                            <div class="text-center m-3">
                                <button type="submit" class="btn btn-primary form-control"><i class="fas fa-save"></i> Guardar Cambios</button>
                            </div>
                        </div>
                    </form>
                </div>  
            </div>
        </div>
    </section>
@endsection
@section('scripts')
<script>
    document.getElementById('enrolarHuellaBtn').addEventListener('click', function () {
        // Confirmación antes de proceder
        if (!confirm('¿Estás seguro de que deseas capturar la huella digital de este cliente?')) {
            return;
        }

        // ID del cliente
        var clienteId = '{{ $expedienteCliente->id }}';
        var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // Realizar la solicitud AJAX al servidor Laravel para capturar huella
        fetch(`/clientes/capturarHuella/${clienteId}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': token,
                'Content-Type': 'application/json',
            },
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Huella capturada y guardada con éxito.');

                // Recargar la página para actualizar el estado de la huella
                location.reload();
            } else {
                alert('Error al capturar la huella: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error al procesar la solicitud:', error);
            alert('Ocurrió un error al intentar capturar la huella.');
        });
    });
</script>

@endsection
