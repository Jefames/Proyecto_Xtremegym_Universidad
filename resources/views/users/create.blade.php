@extends('layouts.base_master')

@section('title', 'Crear Usuario')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Creación de Usuarios</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('users.index')}}">Usuarios</a></li>
                        <li class="breadcrumb-item active">Creación</li>
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
                        <i class="fas fa-user-plus "> </i>
                        <b>Crear Nuevo Usuario</b>
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

                        <form action="{{ route('users.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nombre">Nombres</label>
                                        <abbr title="Campo obligatorio" class="required-indicator">*</abbr>
                                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="apellido">Apellidos</label>
                                        <abbr title="Campo obligatorio" class="required-indicator">*</abbr>
                                        <input type="text" class="form-control" id="apellido" name="apellido" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Correo Electronico</label>
                                        <input type="email" class="form-control" id="email" name="email">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="rol">Rol</label>
                                        <abbr title="Campo obligatorio" class="required-indicator">*</abbr>
                                        <select id="rol" name="rol" class="form-control" required>
                                            <option value="Normal">Normal</option>
                                            <option value="Administrador">Administrador</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password">Contraseña</label>
                                        <abbr title="Campo obligatorio" class="required-indicator">*</abbr>
                                        <div class="input-group">
                                        <input type="password" class="form-control" id="password" name="password" required>
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div id="mensaje-validacion"></div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="confirm_password">Confirmar Contraseña</label>
                                        <abbr title="Campo obligatorio" class="required-indicator">*</abbr>
                                        <div class="input-group">
                                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" disabled required>
{{--                                            <div class="input-group-append">--}}
{{--                                                <button class="btn btn-outline-secondary" type="button" id="togglePassword" disabled>--}}
{{--                                                    <i class="fas fa-eye"></i>--}}
{{--                                                </button>--}}
{{--                                            </div>--}}
                                        </div>
                                        <div id="mensaje-confirmacion"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="departamento_id">Barrio</label>
                                        <abbr title="Campo obligatorio" class="required-indicator">*</abbr>

                                        <select id="departamento_id" name="departamento_id" class="form-control"
                                                required>
                                            @foreach ($departamentos as $departamento)
                                                <option
                                                    value="{{ $departamento->id }}">{{ $departamento->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tipo_servicio_id">Tipo de Servicio</label>
                                        <abbr title="Campo obligatorio" class="required-indicator">*</abbr>
                                        <select id="tipo_servicio_id" name="tipo_servicio_id" class="form-control"
                                                required>
                                            @foreach ($tipos_servicio as $tipo_servicio)
                                                <option
                                                    value="{{ $tipo_servicio->id }}">{{ $tipo_servicio->nombre_servicio }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary form-control"><i class="fas fa-user-check"></i>
                                Crear Usuario
                            </button>
                        </form>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <!-- JS PROPIO -->
    <script src="{{asset('assets/js/users/create.js')}}"></script>
@endsection
