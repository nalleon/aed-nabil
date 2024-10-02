<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="Nabil L.A.">
        <title>Tasks</title>
        <link rel="stylesheet" href="./style/tasks.css">

    </head>
    <body class="antialiased">
        <div class="main-container">
            <h2>TASK TO UPDATE</h2>
            <form action="{{ url('task/update')}}" method="POST" id="formTasks">
                @csrf
                <label for="subject">Task ID: {{$auxTask->id}}</label>
                <br>
                <input type="hidden" name="id" value="{{ $auxTask->id }}">
                <input type="text" name="subject" id="subject" placeholder="Task subject" value="{{$auxTask->subject}}" />
                <textarea cols="200" rows="5" name="description" placeholder="Task description" id="description">{{$auxTask->description}}</textarea>
            
                <label for="finished">Status:</label><br>
                <div class="status-container">
                    @if ($auxTask->finished)
                        <input type="radio" value="Open" name="finished" id="finishedOpen"> 
                        <label for="finishedOpen">Open</label>
                        <input type="radio" value="Closed" name="finished" id="finishedClosed" checked> 
                        <label for="finishedClosed">Close</label>
                    @else
                        <input type="radio" value="Open" name="finished" id="finishedOpen" checked> 
                        <label for="finishedOpen">Open</label>
                        <input type="radio" value="Closed" name="finished" id="finishedClosed"> 
                        <label for="finishedClosed">Close</label>
                    @endif
                </div>
            
                <input type="submit" name="submit" id="submit" value="Update">
            </form>
        </div>
    </body>
</html>
