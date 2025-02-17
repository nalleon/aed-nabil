<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Verifica tu Email</title>
</head>
<body>
<h2>Hola, {{ $user->name }}!</h2>
<p>Confirmar registro pulsando en el siguiente enlace:</p>
<p>
<a href="{{ $verificationUrl }}" >
Verificar Email
</a>
</p>
</body>
</html>
