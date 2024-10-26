<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="Nabil L. A.">
        <title>CG - Login </title>
        <link rel="stylesheet" href="./style/login.css">
    </head>
    <body class="antialiased">
        <div class="main-container">

            <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <label for="username">Username</label>
                    @if(session('message'))
                        <p>{{ session('message') }}</p>
                    @endif
                    <input type="text" name="username" id="username" placeholder="Enter your username" required/>
                    <br>
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" placeholder="Enter your password" required/>
                    <br>
                    <input type="submit" name="login" value="Login">
                    <p>Don't have an account? <a href="{{route('registerView')}}"> Click here</a></p>
            </form>

            <br>
        </div>
    </body>
</html>