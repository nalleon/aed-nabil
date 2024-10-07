<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Practice17</title>
</head>
<body class="antialiased">
    <form method="POST" action="{{ url('/create-directory')}}">
        @csrf
        @if(isset($directory))
            <input type="hidden" name="id" value="{{ $color->id }}">
        @endif
        <label for="directory">Directory's name: </label>
        <input type="text" name="directory" id="directory">
        <br>
        <input type="submit" name="submit" id="submit" value="Send">
    </form>
    <br>
    <div class="history">
            
    </div>
</body>
</html>
