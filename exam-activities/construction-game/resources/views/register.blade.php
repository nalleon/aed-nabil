<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="Nabil L. A.">
        <title>CG - Register </title>
        <link rel="stylesheet" href="./style/login.css">
    </head>
    <body class="antialiased">
        <div class="main-container">

            <form action="{{ route('register') }}" method="POST">
                    @csrf
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" placeholder="Enter your username" required/>
                    <br>
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" placeholder="Enter your password" required/>
                    <br>
                    <label for="password_confirmation">Confirm password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm your password" required />
                    <br>
                    <input type="submit" name="register" value="Register">
                    <p>Have an account? <a href="{{route('loginView')}}"> Click here</a></p>
            </form>

            <br>
        </div>
    </body>
</html>