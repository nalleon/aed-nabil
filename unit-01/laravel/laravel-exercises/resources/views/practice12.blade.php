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
    @foreach ($imgArray as $img)
        <!-- start point of src is public directory -->
        <img src="img/{{$img}}" alt="practice12">
    @endforeach
</body>
</html>
 