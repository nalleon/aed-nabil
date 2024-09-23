<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
    $array = [];
    $array[2]="mensaje";
    $array[7]="lalala!";
    $array[]="yepa yepa!!";

    echo "<br>";

    /**
     * Use isset() to check if the current index has a value.
     */
    for($i = 0; $i < 9; $i++){
        if(isset($array[$i])){
            var_dump($array[$i]);
        } 
    }
?>
</body>
</html>