<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="Nabil León Álavarez">
        <title>Class exercise</title>
        <link rel="stylesheet" href="./style/startpage.css">

    </head>
    <body class="antialiased">
        <div class="main-container">
            <h2>Startpage</h2>
        
            @php
                $user = session('user');
                $userId = $user ? $user->getId() : null;
                $username = $user ? $user->getUsername() : 'anonymous';
            @endphp
       
            <p>User: <b>{{ $username }}</b></p>
          
            <form action="{{ url('/filterMessages') }}" method="GET">
                <input type="text" id="usernameFilter" name="usernameFilter" placeholder="Enter username to filter " required>
                <input type="submit" value="Filter Messages">
            </form>
            <br>
            <form action="{{ url('/writeMessage') }}" method="POST">
                @csrf
                <input type="hidden" id="userId" name="userId" value="{{ $userId }}">
                <input type="hidden" id="username" name="username" value="{{ $username }}">
                <input type="text" id="message" name="message" placeholder="Message"/>
                <input type="submit" id="submit" name="submit" value="Send" />
            </form>
        
            <div class="messages">
                @if(!empty($allUserMessages))
                    <ul>
                        @foreach($allUserMessages as $message)
                            <li>
                                <strong>{{ $message->getUser() }}:</strong> {{ $message->getMessage() }}
                            </li>
                        @endforeach
                    </ul>
                @else
                    <li>There aren't any messages yet.</li>
                @endif
            </div>
        </div>        
    </body>

</html>
