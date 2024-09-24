<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php
    $conUrlEncode = urlencode('Pasando datos diría.. que hay que usar urlencode');
    
    echo "<a href=practica33.php?prueba='Pasando datos diría.. que hay que usar urlencode'>pasando datos sin utlencode</a>";
    echo "</br>";
    echo "<a href=practica33.php?prueba2={$conUrlEncode}>pasando datos sin utlencode</a>";


    $recibidoSinUrlEncode = $_GET["prueba"] ?? "nadita";
    $recibidoConUrlEncode = $_GET["prueba2"] ?? "nadita";
    
    echo "<h3>se ha recibido:</h3>";
    echo "prueba: ". $recibidoUrlEncode . "<br>";
    echo "prueba2: ". $recibidoSinUrlEncode . "<br>";
?>
</body>
</html>