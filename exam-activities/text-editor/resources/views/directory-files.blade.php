<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Nabil L. A.">
    <title>Files in Directory: {{ $directory }}</title>
    <link rel="stylesheet" href="./style/directory-files.css">
</head>
<body>
    @php
        $user = session('user');
        if(!$user){
            return redirect('/');
        }

        $username = $user->getUsername();
    @endphp

    <h2>Files in: {{ $directory }}</h2>
    <h3>Versions:</h3>
    @if(count($files) > 0)
        <ul>
            @foreach ($files as $file)
                <li>
                    <form action="{{ url('/edit-file') }}" method="POST">
                        @csrf
                        <input type="hidden" name="filename" value="{{ $file }}">
                        <input type="hidden" name="username" value="{{ $username }}">
                        <input type="submit" value="{{ basename($file) }}">
                    </form>
                </li>
            @endforeach
        </ul>
    @else
        <p>No files found in this directory.</p>
    @endif
    <br>
    <a href="{{ url('/text-editor') }}">Back to main page</a>
    </br>
</body>
</html>
