<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Citas</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        .header { text-align: center; margin-bottom: 20px; }
        .empresa-info { text-align: center; margin-bottom: 10px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: left; }
        th { background-color: #e6e6e6; }
        .totales { margin-top: 20px; }
    </style>
</head>
<body>

    <div class="header">
        <h2>{{ $empresa->nombre }}</h2>
        <p>{{ $empresa->direccion }}</p>
        <p>Tel: {{ $empresa->telefono }} | Email: {{ $empresa->correo }}</p>
        <h3>Reporte de Citas</h3>
        <p>Desde: {{ $fecha_inicio }} — Hasta: {{ $fecha_fin }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Paciente</th>
                <th>Motivo</th>
                <th>Estado</th>
                <th>Fecha</th>
                <th>Hora</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($citas as $cita)
            <tr>
                <td>{{ $cita['id'] }}</td>
                <td>{{ $cita['paciente'] }}</td>
                <td>{{ $cita['motivo'] ?? '—' }}</td>
                <td>{{ $cita['estado'] }}</td>
                <td>{{ $cita['fecha'] }}</td>
                <td>{{ $cita['hora'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="totales">
        <p><strong>Total Citas:</strong> {{ count($citas) }}</p>
        <p><strong>Pendientes:</strong> {{ $citas->where('estado', 'Pendiente')->count() }}</p>
        <p><strong>Confirmadas:</strong> {{ $citas->where('estado', 'Confirmada')->count() }}</p>
        <p><strong>Canceladas:</strong> {{ $citas->where('estado', 'Cancelada')->count() }}</p>
    </div>

</body>
</html>
