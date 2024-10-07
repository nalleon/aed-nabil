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
            <div class="messages">
                @if(!empty($filteredMessages))
                    <ul>
                        @foreach($filteredMessages as $message)
                            <li>
                                <strong>{{ $message->getUser() }}:</strong> {{ $message->getMessage() }}
                            </li>
                        @endforeach
                    </ul>
                @else
                    <li>There aren't any messages by this user yet.</li>
                @endif
            </div>
        </div>
    </body>
</html>
