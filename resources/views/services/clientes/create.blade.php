@extends('layouts.base_master')

@section('title', 'Nuevo Cliente')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><b>DATOS DE CLIENTE</b></h1>
                    <div class="dropdown-divider"></div>

                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item active">Nuevo Cliente</li>
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
                        <i class="fas fa-user"></i>
                        <b>Registro de Cliente</b>
                    </h2>
                </div>
                <div class="card-body">
                    <div class="container">
                        <br>
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

                        <form action="{{ route('clientes.store') }}" method="POST">
                            @csrf

                            <ul class="nav nav-tabs" role="tablist">
                                {{-- Pestaña 1 = Datos Personales --}}
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="pill" href="#custom-tabs-one-personales" role="tab" aria-controls="custom-tabs-one-personales" aria-selected="true">
                                        Datos Personales
                                    </a>
                                </li>
                            </ul>

                            <div class="tab-content">
                                {{-- Contenido de la Pestaña 1 --}}
                                <div class="tab-pane fade show active" id="custom-tabs-one-personales" role="tabpanel" aria-labelledby="custom-tabs-one-personales-tab">
                                    <br>
                                    <div class="row">
                                        {{-- DATOS DE NOMBRES --}}
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="nombre">Primer Nombre</label>
                                                <abbr title="Campo obligatorio" class="required-indicator">*</abbr>
                                                <input type="text" class="form-control" id="nombre" name="nombre" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="seg_nombre">Segundo Nombre</label>
                                                <input type="text" class="form-control" id="seg_nombre" name="seg_nombre">
                                            </div>
                                        </div>

                                        {{-- DATOS DE APELLIDOS --}}
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="apellido">Primer Apellido</label>
                                                <abbr title="Campo obligatorio" class="required-indicator">*</abbr>
                                                <input type="text" class="form-control" id="apellido" name="apellido" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="seg_apellido">Segundo Apellido</label>
                                                <input type="text" class="form-control" id="seg_apellido" name="seg_apellido">
                                            </div>
                                        </div>

                                        {{-- OTROS DATOS --}}
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="telefono">Teléfono</label>
                                                <input type="text" class="form-control" id="telefono" name="telefono" maxlength="8">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="direccion">Dirección</label>
                                                <input type="text" class="form-control" id="direccion" name="direccion">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="email">Correo Electrónico</label>
                                                <input type="email" class="form-control" id="email" name="email" >
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="estado">Estado</label>
                                            <select id="estado" name="estado" class="form-control">
                                                <option value="1" selected>Activo</option>
                                                <option value="0">Inactivo</option>
                                            </select>
                                        </div>
                                        </div>

                                            <!-- Botón para enrolar huella -->
                                            {{-- <div class="col-md-6">
                                                <div class="form-group">
                                                    <button type="button" class="btn btn-secondary" id="enrolarHuellaBtn">
                                                        <i class="fas fa-fingerprint"></i> Registrar Huella Digital
                                                    </button>
                                                </div>
                                            </div> --}}
                                            
                                        
                                         </div>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary form-control "><i class="fas fa-save"></i> Registrar Cliente</button>
                        </form> <br>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

 @section('scripts')
 {{--
    <script src="{{asset('assets/js/informes/clientes/create_validation.js')}}"></script>
  
    <script>
        document.getElementById('enrolarHuellaBtn').addEventListener('click', function () {
            var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    
            fetch(`/enrolar-huella-temp`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': token,
                    'Content-Type': 'application/json',
                },
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Huella capturada y almacenada temporalmente.');
                } else {
                    alert('Error al capturar la huella: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error al procesar la solicitud:', error);
                alert('Ocurrió un error al intentar capturar la huella.');
            });
        });
    </script> --}}
    
@endsection
