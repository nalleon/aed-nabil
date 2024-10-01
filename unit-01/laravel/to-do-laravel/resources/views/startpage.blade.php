<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

    </head>
    <body class="antialiased">
        <h1>aa</h1>
        <ul>
            @foreach ($todolist as $task)
                <li>
                    <a href="./task?id={{$task->id}}">{{ $task->subject }}</a>
                    <a href="./task?id={{$task->id}}">{{ $task->description }}</a>
                    <a href="./task?id={{$task->id}}">{{ $task->finished ? 'Finished' : 'Not finished' }}</a>
                </li>
            @endforeach
        </ul>        
    </body>
</html>
