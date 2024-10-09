<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="Nabil L. A.">
        <title>BlackJack</title>
        <link rel="stylesheet" href="./style/blackjack.css">


    </head>
    <body class="antialiased">
        @php
            $user = session('user');
            $username = $user ? $user->getUsername(): 'Anonymous';

            $player = session('player');
            $playerName = $username;
            $hand = $player ? $player->getHand() : [];
            $score = $player ? $player->getScore() : 0;
            $isStand = $player ? $player->getIsStand() : false;

            $dealer = session('dealer');
            $dealerHand = $dealer ? $dealer->getHand() : [];
            $dealerScore = $dealer ? $dealer->getScore() : 0;
            $dealerIsStand = $dealer ? $dealer->getIsStand() : false;
        @endphp

        <div class="main-container">

            <form action="{{ url('start-game') }}" method="POST">
                @csrf
                <input type="hidden" id="playerName" name="playerName" value="{{ $playerName }}"></input>
                <input type="submit" value="Start Game">
            </form>
            <br></br>
            <div class="result">
                @if(session('message'))
                    <div class="message">
                        <b>{{ session('message') }}</b>
                    </div>
                    <p>{{$playerName}} score: {{ $score }}</p>
                    <p>Dealer's score: {{ $dealerScore }}</p>
                @endif


            </div>


            <div class="players-container">
                <p>Player: {{$playerName}}</p>
                <p>Your hand:</p>
                <ul>
                    @foreach ($hand as $index => $card)
                        <li>{{ $card->getRank() }} of {{ $card->getSuit() }}</li>
                    @endforeach
                </ul>


                @if (session('dealer') !== null)
                    <p>Dealer's hand:</p>
                    <ul>
                        @foreach ($dealerHand as $index => $card)
                            @if($index != 0 && !$dealerIsStand)
                                <li>??</li>
                            @else
                                <li>{{ $card->getRank() }} of {{ $card->getSuit() }}</li>
                            @endif
                        @endforeach
                    </ul>
                @endif



                </div>
            </div>


            <form action="{{ url('player-action') }}" method="POST">
                @csrf

                <input type="hidden" id="playerName" name="playerName" value="{{ $playerName }}"></input>
                <input type="hidden" id="hand" name="hand" value="{{ json_encode($hand) }}"></input>
                <input type="hidden" id="score" name="score" value="{{ $score }}"></input>
                <input type="submit" name="action" value="hit"
                    @if($player->getIsStand())
                        disabled
                    @endif
                ></input>
                <input type="submit" name="action" value="stand"></input>
            </form>
        </div>
    </body>
</html>
