<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cita Registrada</title>
</head>
<body>
    <h1>Hola, {{ $usuario->nombre }}</h1>
    <p>Su cita ha sido registrada exitosamente. A continuación podrá encontrar los detalles de la cita:</p>
    <ul>
        <li><strong>Fecha:</strong> {{ $cita->fecha }}</li>
        <li><strong>Hora:</strong> {{ $cita->hora }}</li>
        <li><strong>Descripción:</strong> {{ $cita->descripcion }}</li>
    </ul>
    <p>Gracias</p>
</body>
</html>
