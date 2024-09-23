<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php   
    $arr = [];

    for($i=0; $i<10; $i++){
        $arr[] = $i;
        echo "Array unshift values $i: ";
        print_r($arr);
        echo "</br>";
    }
    
    echo "</br>";

    for($j=0; $j<5; $j++){
        $arrShift = array_shift($arr);
        echo "Shifted array value $j: ";
        print_r($arr);
        echo "</br>";
        echo "Value shifted: " . $arrShift;
        echo "</br>";
    }
?>
</body>
</html>