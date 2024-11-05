<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Practice 06</title>
</head>
<body>
    <div>
        <ul>
            @foreach ($students as $student)
                <li>{{json_encode($student, JSON_UNESCAPED_UNICODE)}}</li>
            @endforeach
        </ul>
    </div>
</body>
</html>