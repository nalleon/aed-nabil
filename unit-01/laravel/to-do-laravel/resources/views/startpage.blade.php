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

            <h2>ALL TASKS</h2>
            <ul>
                @foreach ($todolist as $task)
                    <li>
                        <a href="./task?id={{$task->id}}">{{ $task->subject }}</a>
                        <a href="./task?id={{$task->id}}">{{ $task->description }}</a>
                        <a href="./task?id={{$task->id}}">{{ $task->finished ? 'Finished' : 'Not finished' }}</a>
                    </li>
                @endforeach
            </ul>     

                    
            <form action="{{ url('task/create') }}" method="POST">
                @csrf
                <label for="subject">Task Subject:</label>
                <input type="text" name="subject" id="subject" placeholder="Task subject" required />
                <br>
                <label for="description">Task Description:</label>
                <textarea cols="50" rows="5" name="description" id="description" placeholder="Task description" required></textarea>
                <br>
                <label for="finished">Status:</label><br>
                <input type="radio" value="Open" name="finished" id="finishedOpen" checked> Open<br>
                <input type="radio" value="Closed" name="finished" id="finishedClosed"> Closed<br>
                <br>
                <input type="submit" name="submit" value="Create">
            </form>
            
        </div>   
    </body>
</html>
