<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Nabil L. A.">
    <title>Practice 20</title>
</head>
<body class="antialiased">
    <div class="main-container">
        <h1>Files in directory</h1>
        <ul>
            @foreach ($files as $file)
                <li>
                    <a href="{{ url('practice20/download/' . basename($file)) }}">{{ basename($file) }}</a>
                    <form action="{{ url('practice20/delete', basename($file)) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit">Delete</button>
                    </form>
                </li>
            @endforeach
        </ul>

        @if ($files === null)
            <p>There are no files in this directory.</p>
        @endif
    </div>
</body>
</html>
