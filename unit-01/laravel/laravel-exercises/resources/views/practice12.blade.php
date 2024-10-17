<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        img {
            width: 5rem;
            height: auto;
        }
    </style>
</head>
<body class="antialiased">
    <p>CSRF Token: {{ csrf_token() }}</p>
    @foreach ($imgArray as $img)
        <img src="img/{{$img}}" alt="practice12">
    @endforeach
</body>
</html>
 