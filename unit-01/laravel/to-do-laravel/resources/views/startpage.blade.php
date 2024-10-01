<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="Nabil L.A.">
        <title>To Do</title>
        <link rel="stylesheet" href="./style/startpage.css">

    </head>
    <body class="antialiased">
        <div class="main-container">

            

            <ul>
                @foreach ($todolist as $task)
                    <li>
                        <a href="./task?id={{$task->id}}">{{ $task->subject }}</a>
                        <a href="./task?id={{$task->id}}">{{ $task->description }}</a>
                        <a href="./task?id={{$task->id}}">{{ $task->finished ? 'Finished' : 'Not finished' }}</a>
                    </li>
                @endforeach
            </ul>     
        </div>   
    </body>
</html>
