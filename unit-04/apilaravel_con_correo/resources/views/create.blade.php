<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Documento</title>
</head>
<body>

<div class="container mt-5">
    <h1>Crear</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('documents.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="title">Título del Documento</label>
            <input type="text" id="title" name="title" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Crear Documento</button>
    </form>
</div>

</body>
</html>
