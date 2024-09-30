<?php
$conUrlEncode = urlencode('Pasando datos diría.. que hay que usar urlencode');
echo "<a href=practice33.php?prueba='Pasando datos diría.. que hay que usar urlencode'>pasando datos</a>";
echo "<br></br>";
echo "<a href=practice33.php?prueba2={$conUrlEncode}>pasando datos</a>";

$recibido = $_GET["prueba"] ?? "nadita";
$recibidoConEncode = $_GET["prueba2"] ?? "nadita";
echo "<h3>se ha recibido:</h3>";
echo "prueba: ". $recibido . "<br>";
echo "prueba: ". $recibidoConEncode . "<br>";
?>
