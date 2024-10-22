<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="Nabil L. A.">
        <title>Practice 15</title>
        <link rel="stylesheet" href="./style/login.css">
    </head>
    <body class="antialiased">
        <div class="main-container">

            @if(session('success'))
                <p> {{session('success')}}</p>
            @endif

            <p>DATA: {{session('name')}}, {{session('age')}}, {{session('likes')}}</p>
            <form action="{{ url('/practice15/update')}}" method="POST">
                @csrf
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" value="{{session('name')}}" />
                    <br>
                    <label for="age">Age</label>
                    <input type="text" name="age" id="age" value="{{session('age')}}" />
                    <br>
                    <label for="likes">Likes</label>
                    <input type="text" name="likes" id="likes" value="{{session('likes')}}" />
                    <br>
                    <input type="submit" name="submit" value="submit">
            </form>
            <br>
        </div>
    </body>
</html>