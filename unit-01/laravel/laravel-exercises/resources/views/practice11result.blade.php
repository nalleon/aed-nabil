<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body class="antialiased">
    @php
    $length = count($words);
    @endphp

    <ul>
        @for ($i=0; $i<$length; $i++)
            <li>{{$words[$i]}}</li>
        @endfor
    </ul>
</body>
</html>
