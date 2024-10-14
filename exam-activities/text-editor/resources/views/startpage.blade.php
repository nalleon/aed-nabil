<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="Nabil L. A.">
        <title>Text-Editor</title>

    </head>
    <body class="antialiased">
        @php
            $user = session('user');
            $username = $user ? $user->getUsername();
        @endphp

        <div class="main-container">
            <div class="action-container">
                <h2>{{$username}}'s page</h2>

                <ul>
                    @foreach ($collection as $item)
                        <li> <a href=""> </a></li>
                    @endforeach
                </ul>
            </div>


        </div>


    </body>
</html>
