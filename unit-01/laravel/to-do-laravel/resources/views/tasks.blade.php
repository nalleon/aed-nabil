<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>


    </head>
    <body class="antialiased">
        <form action="form" method="POST" id="formTasks">
            <label for="subject">Task ID: {{$auxTask->id}}</label>
            <input type="text" name="subject" id="subject" value="{{$auxTask->subject}}" />
            <textarea cols="200" rows="5" name="description" id="description">{{$auxTask->description}}</textarea>
        
            @if ($auxTask->finished)
                <input type="radio" value="Closed" name="finished" id="finishedClosed" checked>Close<br>
                <input type="radio" value="Open" name="finished" id="finishedOpen">Open<br>
            @else
                <input type="radio" value="Open" name="finished" id="finishedOpen" checked>Open<br>
                <input type="radio" value="Closed" name="finished" id="finishedClosed">Close<br>
            @endif
        
            <input type="submit" name="submit" id="submit" value="Send">
        </form>
        
    </body>
</html>
