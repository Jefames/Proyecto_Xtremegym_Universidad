@extends('layouts.base_master')

@section('title', 'Captura de Huella Digital')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><b>Captura de Huella para Cliente: {{$cliente->id}}</b></h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card card-default">
                <div class="card-header">
                    <h2 class="card-title">
                        <i class="fas fa-fingerprint"></i>
                        Captura de Huella Digital
                    </h2>
                </div>
                <div class="card-body">
                    <!-- Mostrar los datos del cliente en modo de solo lectura -->
                    <div class="row">
                        <div class="col-md-4">
                            <label>Primer Nombre</label>
                            <input type="text" class="form-control" value="{{ $cliente->nombre }}" readonly>
                        </div>
                        <div class="col-md-4">
                            <label>Segundo Nombre</label>
                            <input type="text" class="form-control" value="{{ $cliente->seg_nombre }}" readonly>
                        </div>
                        <div class="col-md-4">
                            <label>Primer Apellido</label>
                            <input type="text" class="form-control" value="{{ $cliente->apellido }}" readonly>
                        </div>
                        <div class="col-md-4">
                            <label>Segundo Apellido</label>
                            <input type="text" class="form-control" value="{{ $cliente->seg_apellido }}" readonly>
                        </div>
                        <div class="col-md-4">
                            <label>Teléfono</label>
                            <input type="text" class="form-control" value="{{ $cliente->telefono }}" readonly>
                        </div>
                        <div class="col-md-4">
                            <label>Correo Electrónico</label>
                            <input type="text" class="form-control" value="{{ $cliente->email }}" readonly>
                        </div>
                        <div class="col-md-4">
                            <label>Dirección</label>
                            <input type="text" class="form-control" value="{{ $cliente->direccion }}" readonly>
                        </div>
                        <div class="col-md-4">
                            <label>Estado</label>
                            <input type="text" class="form-control" value="{{ $cliente->estado == 1 ? 'Activo' : 'Inactivo' }}" readonly>
                        </div>
                    </div>

                    <!-- Botón para capturar huella -->
                    <br>
                    <div class="form-group">
                        <button type="button" class="btn btn-secondary" id="capturarHuellaBtn">
                            <i class="fas fa-fingerprint"></i> Capturar Huella Digital
                        </button>
                    </div>

                    <!-- Botón para guardar cliente (aparece después de capturar la huella) -->
                    <br>
                    <div class="form-group" id="guardarClienteContainer" style="display: none;">
                        <button type="button" class="btn btn-success" id="guardarClienteBtn">
                            <i class="fas fa-save"></i> Guardar Cliente
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('scripts')
<script>
    document.getElementById('capturarHuellaBtn').addEventListener('click', function () {
        var clienteId = '{{ $cliente->id }}';
        var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // Realizar la solicitud AJAX para capturar la huella
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
                
                // Mostrar el botón para guardar cliente
                document.getElementById('guardarClienteContainer').style.display = 'block';
            } else {
                alert('Error al capturar la huella: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error al procesar la solicitud:', error);
            alert('Ocurrió un error al intentar capturar la huella.');
        });
    });

    // Al hacer clic en el botón de guardar cliente
    document.getElementById('guardarClienteBtn').addEventListener('click', function () {
        window.location.href = "{{ route('clientes.index') }}";
    });
</script>
@endsection