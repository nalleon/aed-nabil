<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
    <a href="index.php?saludo=hola&texto=Esto es una variable texto">Paso
        variables saludo y texto a la página destino.php</a>
    </br>
    <?php
        $saludo = $_GET["saludo"];
        $texto = $_GET["texto"];

        echo "Variable saludo: $saludo <br>";
        echo "Variable texto: $texto <br>";
    ?>
    </body>
</html>