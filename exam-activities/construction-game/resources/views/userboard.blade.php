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

               <form action="{{ route('updateBoard', ['id' => $board->getId()]) }}" method="POST">
                    @csrf
                    <ul>
                        @foreach ($allFiguresOptions as $figureOption)
                            <div class="col-2 d-flex flex-column align-items-center">
                                <img src="data:{{$figureOption->getTypeImage()}}; base64,{{base64_encode($figureOption->getImage())}}" width="50px" height="50px" />
                                <input type="radio" id="figureChosen" name="figureChosen" value="{{$figureOption->getId()}}">
                            </div>
                        @endforeach
                    </ul>

                    <ul>
                        @foreach ($figures as $figure)
                            <div class="col-2 d-flex flex-column align-items-center">
                                <img src="data:{{$figure->getTypeImage()}}; base64,{{base64_encode($figure->getImage())}}" width="150px" height="150px" />
                                <input type="checkbox" id="figureEdit" name="figureEdit" value="{{$figure->getId()}}">
                            </div>
                        @endforeach
                    </ul>
                    <input type="submit" class="btn btn-primary mt-3" value="Update board">
                </form>
            </div>
        </div>
    </body>
</html>
