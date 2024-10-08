<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="Nabil L. A.">
        <title>BlackJack</title>


    </head>
    <body class="antialiased">
        @php
            $user = session('user');
            $player = session('player');

            $username = $user ? $user['username'] : 'Anonymous';
            $hand = $player ? $player['hand'] : [];
            $score = $player ? $player['score'] : 0;
        @endphp

        <div class="main-container">
            <form action="{{ url('player-action') }}" method="POST">
                @csrf
                <p>Your score: {{ $score }}</p>
                <p>Your hand: {{ $hand }}</p>


                <input type="hidden" id="username" name="playerName" value="{{ $username }}"></input>
                <input type="submit" name="action" value="hit"></input>
                <input type="submit" name="action" value="stand"></input>
            </form>
        </div>
    </body>
</html>
