<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

    </head>

    <body class="antialiased">
        <h2>Letter soup</h2>
        <div class="container">

        <form action="startgame" method="POST">
            @csrf
            <input type="submit" name="submit" value="Start"/>
        </form>
        <br>
        <form action="playgame" method="POST">
            @csrf
            @foreach ($soupLetters as $line)
                @foreach ( $line as $letter)
                <input type="checkbox" name="letter[]" value="{{$letter}}">{{$letter}}</input>
                @endforeach
            @endforeach
            <input type="submit" name="submit" value="Send"/>
        </form>
        </div>
        <br>
        <h3>History:</h3>
        <div class="selection">
            @if(isset($history))
                @foreach ($history as $selected)
                    <li>{{ $selected }}</li>
                @endforeach
            @endif
        </div>

    </body>
</html>
