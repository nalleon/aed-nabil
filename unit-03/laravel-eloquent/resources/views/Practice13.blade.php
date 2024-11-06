<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Practice 12</title>
</head>
<body>
    <div>
        <p>Asignatura 1º: {{json_encode($asignatura1ro, JSON_UNESCAPED_UNICODE)}}</p>
        <br>
        <p>Asignatura 2º: {{json_encode($asignatura2do, JSON_UNESCAPED_UNICODE)}}</p>
    </div>
</body>
</html>