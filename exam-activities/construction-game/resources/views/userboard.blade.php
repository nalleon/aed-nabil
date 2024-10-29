<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="Nabil L. A.">
        <title>CG - Your boards </title>
        <link rel="stylesheet" href="./style/login.css">
    </head>
    <body class="antialiased">
        <div class="main-container">
            <div class="board">
               <h2>work in progress</h2>
               <h2>{{ $board->getName() }}</h2>

               <br>
               <form action="{{ route('updateBoard', ['id' => $board->getId()]) }}" method="POST">
                @csrf
                <ul>
                    @foreach ($figures as $figure)
                        <img src="data:{{$figure->getTypeImage()}}; base64,{{$figure->getImage()}}" />
                    @endforeach
                </ul>
                <input type="submit" value="Update">
            </form>
            </div>
            <!--
                3 foreach -> figurasMin, figuras, radio
            -->
        </div>
    </body>
</html>
