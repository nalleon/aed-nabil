<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
    function sumar($a, $b, $print): float{
        $suma = $a + $b;
        if ($print) {
            echo "resultado suma: $suma <br>";
        }
        return $suma;
    }

    $sum1=sumar(1,2);
    $sum2=sumar(4,5,true);
    echo "las operaciones para sum1 y sum2 dan: $sum1 , $sum2";
?>
</body>
</html>