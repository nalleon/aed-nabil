<?php
$conUrlEncode = urlencode('Pasando datos diría.. que hay que usar urlencode');
echo "<a href=practice34.php?prueba='Pasando datos diría.. que hay que usar urlencode'>pasando datos</a>";
echo "<br></br>";
echo "<a href=practice34.php?prueba2={$conUrlEncode}>pasando datos</a>";

$recibido = $_GET["prueba"] ?? "nadita";
$recibidoConEncode = $_GET["prueba2"] ?? "nadita";


foreach ($_GET as $key => $value) {
    echo "<br></br>";
    echo $key. ": ". $value;
    echo "<br></br>";
}
?>
