@extends('layouts.base_master')

@section('title', 'Detalles del Pago')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><b>Detalles del Pago</b></h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card card-default">
                <div class="card-header">
                    <h2><i class="fas fa-info-circle"></i> Información del Pago</h2>
                </div>

                <div class="card-body">
                    <p><b>Cliente:</b> {{ $pago->cliente->nombre }} {{ $pago->cliente->apellido }}</p>
                    <p><b>Membresía:</b> {{ $pago->membresia->tipomem }}</p>
                    <p><b>Fecha de Facturación:</b> {{ \Carbon\Carbon::parse($pago->fecha_inicio)->format('d/m/y') }}</p>
                    <p><b>Total:</b> {{ $pago->total }}</p>
                    <p><b>Método de Pago:</b> {{ ucfirst($pago->metodo_pago) }}</p>
                </div>
            </div>
        </div>
    </section>
@endsection
