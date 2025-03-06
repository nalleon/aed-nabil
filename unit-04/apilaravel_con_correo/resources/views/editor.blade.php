<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Security-Policy" content="default-src 'self'; frame-src 'self'
    https://localhost:9980;">

    <title>Editor de Documentos</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background-color: #f8f9fa;
        }

        .container {
            max-width: 100%;
            margin: 0 auto;
        }

        iframe {
            width: 100%;
            height: 80vh;
            border: none;
        }

        .header {
            margin-bottom: 20px;
        }

        .header h1 {
            font-size: 24px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <h1>Editor</h1>
    </div>
{{--
    {{dd($url)}} --}}
    <iframe src="{{ $url }}" title="Editor" width="100%" height="100%" frameborder="1"></iframe>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
