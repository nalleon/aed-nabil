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
            <h3>Boards of {{session('username')}}</h3>
            @if (session('user') && count($files)>0)
                <ul>
                    @foreach ($files as $file)
                    <li><a href=""> {{basename($file)}}</a></li>  
                    @endforeach
                </ul>
            @else
                <p>You have not created any board yet!</p>
            @endif
            <br>
            <form action="{{ route('createBoard')}}">
                @csrf
                <label for="boardName">Board's name:</label>
                <input type="text" name="boardName" id="boardName" placeholder="Enter board name">
                <input type="submit" name="createBoard" value="Create">
            </form>

            <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <input type="submit" name="logout" value="Logout">
            </form>
    


                    
            <br>
        </div>
    </body>
</html>