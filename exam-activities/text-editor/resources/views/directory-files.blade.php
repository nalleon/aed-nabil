<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Nabil L. A.">
    <title>Files in Directory: {{ $directory }}</title>
</head>
<body>

    <h1>Files in: {{ $directory }}</h1>

    @if(count($files) > 0)
        <ul>
            @foreach ($files as $file)
                <li>
                    <a href="{{ url('file-content/' . $file) }}">
                        {{ basename($file) }}
                    </a>
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
