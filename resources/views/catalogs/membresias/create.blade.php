@extends('layouts.base_master')

@section('title', 'Crear Tiempo de Membresía')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><b>CREAR TIEMPO DE MEMBRESÍA</b></h1>
                    <div class="dropdown-divider"></div>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item active">Membresía</li>
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
                        <i class="fas fa-calendar-alt"></i>
                        <b>Crear Tiempo de Membresía</b>
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

                        <form action="{{ route('membresias.store') }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label for="tipomem">Tipo de Membresía</label>
                                <input type="text" class="form-control" id="tipomem" name="tipomem" required>
                            </div>

                            <div class="form-group">
                                <label for="tiempo">Tiempo (en días)</label>
                                <input type="number" class="form-control" id="tiempo" name="tiempo" required>
                            </div>

                            <div class="form-group">
                                <label for="descripcion">Descripción</label>
                                <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
                            </div>

                            <div class="form-group">
                                <label for="precio">Precio</label>
                                <input type="number" name="precio" step="0.01" class="form-control" required>
                            </div>

                            <button type="submit" class="btn btn-primary form-control"><i class="fas fa-save"></i> Guardar Membresía</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
