<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Practice22</title>
</head>
<body>
    @auth
        <div>
            <p>Info: {{json_encode($alumnos, JSON_UNESCAPED_UNICODE)}}</p>
        </div>
    @endauth
</body>
</html>
