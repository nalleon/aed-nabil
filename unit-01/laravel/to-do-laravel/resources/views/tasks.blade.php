<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="Nabil L.A.">
        <title>Tasks</title>

    </head>
    <body class="antialiased">
        <!-- For update -->
        <form action="updateForm" method="POST" id="formTasks">
            <label for="subject">Task ID: {{$auxTask->id}}</label>
            <br>
            <input type="text" name="subject" id="subject" placeholder="Task subject" value="{{$auxTask->subject}}" />
            <textarea cols="200" rows="5" name="description" placeholder="Task description" id="description" >{{$auxTask->description}}</textarea>
        
            @if ($auxTask->finished)
                <input type="radio" value="Open" name="finished" id="finishedOpen">Open<br>
                <input type="radio" value="Closed" name="finished" id="finishedClosed" checked>Close<br>
            @else
                <input type="radio" value="Open" name="finished" id="finishedOpen" checked>Open<br>
                <input type="radio" value="Closed" name="finished" id="finishedClosed">Close<br>
            @endif
            <input type="submit" name="submit" id="submit" value="Update">
        </form>
    </body>
</html>
