<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<!-- Unlerncode -->
<?php
    echo "<a href=index.php?prueba='Pasando datos diría.. que hay que usar urlencode'>p
    asando datos</a>";

    $conUrlEncode = urlencode('Pasando datos diría.. que hay que usar urlencode');
    $recibidoUrlEncode = $_GET["prueba"] ?? "nadita";

    
    echo "<h3>se ha recibido:</h3>";
    echo "prueba: ". $recibidoUrlEncode . "<br>";
?>
</body>
</html>