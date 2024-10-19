<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="Nabil L. A.">
        <title>BlackJack - Login </title>
        <link rel="stylesheet" href="./style/login.css">
    </head>
    <body class="antialiased">
        <div class="main-container">

            <form action="{{ url('/login')}}" method="POST">
                    @csrf
                    <label for="username">Username</label>
                    @if(session('message'))
                    <p>{{ session('message') }}</p>
                @endif
                    <input type="text" name="username" id="username" placeholder="Enter your username" />
                    <br>
                    <input type="submit" name="login" value="Login">
            </form>

            <br>
        </div>
    </body>
</html>
