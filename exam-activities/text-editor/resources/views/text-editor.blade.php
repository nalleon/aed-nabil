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
            $username = $user ? $user->getUsername(): 'Anonymous';
        @endphp

        <div class="main-container">
            <div class="action-container">
                <h2>Text editor</h2>
                <form action="{{ url('write-text') }}" method="POST">
                    @csrf
                    <input type="hidden" id="username" name="username" value="{{ $username }}"></input>
                    <input type="submit" id="startBtn" value="Send">
                </form>
            </div>
     

        </div>


    </body>
</html>
