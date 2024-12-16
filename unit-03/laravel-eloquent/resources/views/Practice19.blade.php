<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Practice19</title>
</head>
<body>
    <form action="/practice19/create" method="POST">
        @csrf

        <label for="pais">País:</label>
        <input type="text" id="pais" name="pais" required>
        <br><br>

        <label for="nombre">Nombre de la moneda:</label>
        <input type="text" id="nombre" name="nombre" required>
        <br><br>

        <label for="fecha">Fecha:</label>
        <input type="date" id="fecha" name="fecha" required>
        <br><br>

        <label for="equivalenteeuro">Equivalente en Euro:</label>
        <input type="text" id="equivalenteeuro" name="equivalenteeuro" required>
        <br><br>

        <button type="submit">Guardar</button>
    </form>
</body>
</html>
