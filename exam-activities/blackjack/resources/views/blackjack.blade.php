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
            $username = $user ? $user['username'] : 'Anonymous';

            $player = session('player');
            $playerName = $username;
            $hand = $player ? $player->getHand() : []; 
            $score = $player ? $player->getScore() : 0;
            $isStand = $player ? $player->getIsStand() : false;  
        @endphp

        <div class="main-container">
            <form action="{{ url('player-action') }}" method="POST">
                @csrf
                <p>Your score: {{ $score }}</p>
                <p>Your hand: {{ implode(', ', $hand) }} </p>

                <input type="hidden" id="username" name="playerName" value="{{ $playerName }}"></input>
                <input type="hidden" id="hand" name="hand" value="{{ json_encode($hand) }}"></input>
                <input type="hidden" id="score" name="score" value="{{ $score }}"></input>
                <input type="submit" name="action" value="hit"></input>
                <input type="submit" name="action" value="stand"></input>
            </form>
        </div>
    </body>
</html>
