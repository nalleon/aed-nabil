<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <meta name="author" content="Nabil L.A.">
</head>
<body>
<?php
    $array = [];

    $array[2]="mensaje";
    var_dump($array);
    echo "</br>";


    $array[7]="lalala!";
    var_dump($array);
    echo "</br>";


    $array[]="yepa yepa!!";
    var_dump($array);
    echo "</br>";
/**
 * Using array() function instead of [] to create an array.
 */
    $array2 = array();
    $array2[2]="mensaje";
    var_dump($array2);
    echo "</br>";

    $array2[7]="lalala!";
    var_dump($array2);
    echo "</br>";

    $array2[]="yepa yepa!!";
    var_dump($array2);

?>

</body>
</html>