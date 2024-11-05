<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Practice 11</title>
</head>
<body>
    <div>
        @if (count($data) > 0)
        <ul>
            @foreach ($data as $subjetcs)
                <li>{{json_encode($subjetcs, JSON_UNESCAPED_UNICODE)}}</li>
            @endforeach
        </ul>
        @else
            <p>No hay datos disponibles.</p>
        @endif
    </div>
</body>
</html>