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
            $username = $user ? $user->getUsername(): 'Anonymous';

            $player = session('player');
            $playerName = $username;
            $hand = $player ? $player->getHand() : []; 
            $score = $player ? $player->getScore() : 0;
            $isStand = $player ? $player->getIsStand() : false;  
        @endphp

        <div class="main-container">
            <div class="players-container">
                <p>Player: {{$playerName}}</p>
                @if(session('message'))
                    <div class="message">
                        {{ session('message') }}
                    </div>
                @endif

                <p>Your score: {{ $score }}</p>
                <p>Your hand:</p>
                <ul>
                    @foreach ($hand as $card)
                        <li>{{ $card->getRank() }} of {{ $card->getSuit() }}</li>
                    @endforeach
                </ul>

                <!-- For test only-->
                @if (session('dealer'))
                    @php
                        $dealer = session('dealer');
                        $dealerHand = $dealer->getHand(); 
                        $dealerScore = $dealer->getScore(); 
                    @endphp
            
                    <p>Dealer's score: {{ $dealerScore }}</p>
                    <p>Dealer's hand:</p>
                    <ul>
                        @foreach ($dealerHand as $card)
                             <li>{{ $card->getRank() }} of {{ $card->getSuit() }}</li>
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
