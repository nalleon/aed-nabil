<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
    function cmp($a, $b) {
        return $a <=> $b;
    }

    $a = array(3, 2, 5, 6, 1);
    echo "Original array : ";
    print_r($a);
    echo "</br>";

    echo "Sorted array : ";
    usort($a, "cmp");
    foreach ($a as $valor) {
        echo " $valor, ";
    }
?>
</body>
</html>