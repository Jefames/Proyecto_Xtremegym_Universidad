@extends('layouts.base_master')

@section('title', 'Nueva Suscripción')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><b>ASIGNAR MEMBRESÍA A CLIENTE</b></h1>
                    <div class="dropdown-divider"></div>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item active">Nueva Suscripción</li>
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
                        <i class="fas fa-calendar-plus"></i>
                        <b>Asignar Membresía</b>
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
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('suscripciones.store') }}" method="POST">
                            @csrf
                            <ul class="nav nav-tabs" role="tablist">
                                {{-- Pestaña 1: Seleccionar Cliente --}}
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="pill" href="#cliente" role="tab" aria-controls="cliente" aria-selected="true">Cliente</a>
                                </li>
                                {{-- Pestaña 2: Seleccionar Membresía --}}
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="pill" href="#membresia" role="tab" aria-controls="membresia" aria-selected="false">Membresía</a>
                                </li>
                                {{-- Pestaña 3: Pago --}}
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="pill" href="#pago" role="tab" aria-controls="pago" aria-selected="false">Pago</a>
                                </li>
                            </ul>

                            <div class="tab-content">
                                {{-- Contenido de la Pestaña 1: Selección del Cliente --}}
                                <div class="tab-pane fade show active" id="cliente" role="tabpanel">
                                    <br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="cliente_id">Seleccionar Cliente</label>
                                                <select name="cliente_id" class="form-control" required>
                                                    @foreach($clientes as $cliente)
                                                        <option value="{{ $cliente->id }}">{{ $cliente->nombre }} {{ $cliente->apellido }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Contenido de la Pestaña 2: Selección de Membresía --}}
                                <div class="tab-pane fade" id="membresia" role="tabpanel">
                                    <br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="membresia_id">Seleccionar Membresía</label>
                                                <select name="membresia_id" class="form-control" required>
                                                    <option value="" disabled selected>Elegir membresía</option>
                                                    @foreach($membresias as $membresia)
                                                        <option value="{{ $membresia->id }}" data-dias="{{ $membresia->tiempo }}" data-precio="{{ $membresia->precio }}">
                                                            {{ $membresia->tipomem }} - Q{{ $membresia->precio }}
                                                        </option>
                                                    @endforeach
                                                </select>                                                
                                            </div>
                                        </div>

                                        {{-- Fechas --}}
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="fecha_inicio">Fecha de Inicio</label>
                                                <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" value="{{ date('Y-m-d') }}" readonly>
                                            </div>

                                            <div class="form-group">
                                                <label for="fecha_finalizacion_display">Fecha de Finalización</label>
                                                <input type="text" class="form-control" id="fecha_finalizacion_Display" readonly>
                                            </div>
                                            
                                            <!-- Campo oculto para enviar la fecha en el formato correcto -->
                                            <input type="hidden" id="fecha_finalizacion" name="fecha_finalizacion">
                                            
                                        </div>
                                    </div>
                                </div>

                                {{-- Contenido de la Pestaña 3: Pago --}}
                                <div class="tab-pane fade" id="pago" role="tabpanel">
                                    <br>
                                    <h3>Resumen de Pago</h3>
                                    <p>Subtotal: Q <span id="subtotal_text" ></span></p>
                                    <p>Total: Q <span id="total_text" ></span></p>
                                    
                                    <input type="hidden" id="subtotal" name="subtotal" value="">
                                    <input type="hidden" id="total" name="total" value="">

                                    <div class="form-group">
                                        <placeholder for="metodo_pago">Método de Pago</label>
                                        <select name="metodo_pago" class="form-control" required>
                                            <option value="efectivo">Efectivo</option>
                                        </select>
                                    </div>

                                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Pagar Suscripción</button>
                                </div>
                            </div>
                        </form>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        // Script para calcular la fecha de finalización y los totales
        document.querySelector('select[name="membresia_id"]').addEventListener('change', function() {
            var selectedOption = this.options[this.selectedIndex];
            var dias = selectedOption.getAttribute('data-dias');
            var precio = selectedOption.getAttribute('data-precio');

            var fechaInicio = new Date(document.getElementById('fecha_inicio').value);
            fechaInicio.setDate(fechaInicio.getDate() + parseInt(dias));

            var dia = fechaInicio.getDate() +1;
            var mes = fechaInicio.getMonth() + 1;
            var anio = fechaInicio.getFullYear();
            

                        // Fecha en formato DD-MM-YYYY para mostrar en el campo
            var fechaFinalizacionDisplay = `${('0' + dia).slice(-2)}/${('0' + mes).slice(-2)}/${anio}`;
            document.getElementById('fecha_finalizacion_Display').placeholder = fechaFinalizacionDisplay;

            // Fecha en formato YYYY-MM-DD para la base de datos
            var fechaFinalizacionDB = `${anio}-${('0' + mes).slice(-2)}-${('0' + dia).slice(-2)}`;
            document.getElementById('fecha_finalizacion').value = fechaFinalizacionDB;



            document.getElementById('subtotal').textContent = precio;
            document.getElementById('total').textContent = precio;

            var selectedOption = this.options[this.selectedIndex];
            var precioMembresia = parseFloat(selectedOption.getAttribute('data-precio'));

            var subtotal = precioMembresia;
            var total = subtotal;

            // Mostrar los valores en la interfaz
            document.getElementById('subtotal_text').textContent = subtotal.toFixed(2);
            document.getElementById('total_text').textContent = total.toFixed(2);

            // Asegúrate de asignar los valores como números
            document.getElementById('subtotal').value = subtotal.toFixed(2);
            document.getElementById('total').value = total.toFixed(2);
        });
    </script>
@endsection
