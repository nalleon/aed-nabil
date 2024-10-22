<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="Nabil L. A.">
        <title>Practice 16</title>
        <link rel="stylesheet" href="./style/login.css">
    </head>
    <body class="antialiased">
        <div class="main-container">

            <h3>Data of the csv:</h3>
            <ul>
                @foreach($data as $row)
                <li>
                    {{ $row['name'] }} -- {{ $row['email'] }} 
                </li>
            @endforeach
            </ul>
        </div>
    </body>
</html>