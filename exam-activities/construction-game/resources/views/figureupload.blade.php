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
                <h2>Admin: {{ session('username') }}</h2>
                @if (session('message'))
                    <p>{{session('message')}}</p>
                @endif
                <form action="{{ route('figureuploadpost') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <label for="image">Select an image:</label>
                        <input type="file" id="image" name="image" accept="image/*" required>
                        <br>
                        <button type="submit">Upload</button>
                    </div>
                </form>
            <br>
            <div class="back">
                <form action="{{ route('adminhome') }}" method="GET">
                    <input type="submit" value="Back">
                </form>
            </div>
        </div>
    </body>
</html>