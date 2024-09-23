<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php 
    echo "in_array code:";
    echo "</br>";

    $os = array("Mac", "NT", "Irix", "Linux");
    if (in_array("Irix", $os)) {
        echo "Existe Irix";
    }
    if (in_array("mac", $os)) {
        echo "Existe mac";
    }

    echo "</br>";

    $a = array('1.10', 12.4, 1.13);
    if (in_array('12.4', $a, true)) {
        echo "Se encontró '12.4' con comprobación estricta\n";
    }
    if (in_array(1.13, $a, true)) {
        echo "Se encontró 1.13 con comprobación estricta\n";
    }

    echo "</br>";
    echo "array_search code:";
    echo "</br>";

    $array = array(0 => 'azul', 1 => 'rojo', 2 => 'verde', 3 => 'rojo');
    $clave = array_search('verde', $array);
    echo $clave . "<br>";
    $clave = array_search('marrón', $array);
    if( $clave === FALSE) {
        echo "no se ha localizado el valor";
    } else {
        echo $clave;
    }

    echo "</br>";
    echo "array_values code:";
    echo "</br>";

    $array = array('azul', 'rojo', 'verde', 'amarillo', "blanco");
    unset($array[2]);
    unset($array[3]);
    print_r($array);
    $array = array_values($array);
    echo "</br>";
    print_r($array);
?>
</body>
</html>