<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Factura</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        h1, h2, h4 {
            text-align: center;
        }
        .logo {
            text-align: center;
            margin-bottom: 20px;
        }
        .logo img {
            width: 150px; /* Ajusta el tamaño del logo según sea necesario */
        }
    </style>
</head>
<body>

    <div class="logo">
        <img src="{{ public_path('assets/img/logo.png') }}" alt="Logo">
    </div>

    <h1>Comprobante de Pago</h1>
    <h2>Cliente: {{ $pago->cliente->nombre }} {{ $pago->cliente->apellido }}</h2>
    <p><b>Membresía:</b> {{ $pago->membresia->tipomem }}</p>
    <p><b>Fecha de Pago:</b> {{ \Carbon\Carbon::parse($pago->fecha_inicio)->format('d/m/y') }}</p>
    <p><b>Total:</b> {{ $pago->total }}</p>
    <p><b>Método de Pago:</b> {{ ucfirst($pago->metodo_pago) }}</p>

    <h3>Detalle de la Membresía</h3>
    <table>
        <thead>
            <tr>
                <th>Descripción</th>
                <th>Monto</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $pago->membresia->tipomem }}</td>
                <td>{{ $pago->total }}</td>
            </tr>
        </tbody>
    </table>

    <br>
    <h4>Gracias por su preferencia.<h4>
</body>
</html>
