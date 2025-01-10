<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Pagos</title>
    <style>
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
    </style>
</head>
<body>
    <h2>Reporte de Pagos</h2>
    <p>Fecha Inicio: {{ \Carbon\Carbon::parse($form_data['fecha_inicio'])->format('d/m/y') }}</p>
    <p>Fecha Inicio: {{ \Carbon\Carbon::parse($form_data['fecha_fin'])->format('d/m/y') }}</p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Cliente</th>
                <th>Membresía</th>
                <th>Fecha de Facturación</th>
                <th>Monto</th>
            </tr>
        </thead>
        <tbody>
            @foreach($clienteMembresias as $index => $membresia)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $membresia['cliente']['nombre'] }} {{ $membresia['cliente']['apellido'] }}</td>
                    <td>{{ $membresia['membresia']['tipomem'] }}</td>
                    <td>{{ \Carbon\Carbon::parse($membresia['fecha_inicio'])->format('d/m/y') }}</td>
                    {{-- <td>{{ $membresia['fecha_inicio'] }}</td> --}}
                    <td>{{ $membresia['total'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
