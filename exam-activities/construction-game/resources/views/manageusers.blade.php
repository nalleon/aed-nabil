<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="Nabil L. A.">
        <title>CG - Home </title>
        <link rel="stylesheet" href="./style/login.css">
    </head>
    <body class="antialiased">
        <div class="main-container">
                <h2>Admin: {{session('username')}}</h2>

                <ul>
                    @foreach ($usersArray as $user)
                        <li><a href=""> {{ $user->getName() }}</a></li>
                    @endforeach
                </ul>
                
            <br>
        </div>
    </body>
</html>