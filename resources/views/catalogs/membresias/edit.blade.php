@extends('layouts.base_master')

@section('title', 'Editar Membresía')

@section('content')
    <!-- Content Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><b>MODIFICACIÓN DE MEMBRESÍA: {{ $membresia->id }}</b></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('membresias.index') }}">Lista de Membresías</a></li>
                        <li class="breadcrumb-item active">Editar Membresía</li>
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
                        <b>Edición de Membresía</b>
                    </h2>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <i class="fas fa-exclamation-triangle"></i>
                            <strong>¡Oops! Algo salió mal...</strong>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('membresias.update', $membresia->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Datos de Membresía -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tipomem">Tipo de Membresía</label>
                                    <abbr title="Campo obligatorio" class="required-indicator">*</abbr>
                                    <input type="text" class="form-control" id="tipomem" name="tipomem" value="{{ $membresia->tipomem }}" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tiempo">Tiempo (en días)</label>
                                    <abbr title="Campo obligatorio" class="required-indicator">*</abbr>
                                    <input type="number" class="form-control" id="tiempo" name="tiempo" value="{{ $membresia->tiempo }}" required>
                                </div>
                            </div>
                        </div>

                        <!-- Descripción -->
                        <div class="form-group">
                            <label for="descripcion">Descripción</label>
                            <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required>{{ $membresia->descripcion }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="precio">Precio</label>
                            <input type="number" name="precio" class="form-control" step="0.01" value="{{ $membresia->precio }}" required>
                        </div>

                        <!-- Botón de Guardar Cambios -->
                        <button type="submit" class="btn btn-primary form-control"><i class="fas fa-save"></i> Guardar Cambios</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection