<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Practice18</title>
</head>
<body class="antialiased">
    <form method="POST" action="{{ url('/read-file')}}" enctype='multipart/form-data' >
        @csrf
        <input type="file" name="myFile" id="myFile">
        <br>
        <input type="submit" name="submit" id="submit" value="Send">
    </form>
    <br>
    <div class="history">
        @if (session('content') && count(session('content')) > 0)
            <ul>
                @foreach (session('content') as $row)
                    <li>{{ implode(', ', $row) }}</li>
                @endforeach
            </ul>
        @endif
    </div>
</body>
</html>
