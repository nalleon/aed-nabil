<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body class="antialiased">
    <h2>Smaller than 50:</h2>
    <ul>
        @foreach ($array as $num )
            @if ($num < 50)
                <li>{{$num}}</li>
            
            @endif
        
        @endforeach
    </ul>

    <h2>Greater than 50:</h2>
    <ul>
        @foreach ($array as $num )
            @if ($num > 50)
                <li>{{$num}}</li>
            
            @endif
        
        @endforeach 
    </ul>
</body>
</html>
