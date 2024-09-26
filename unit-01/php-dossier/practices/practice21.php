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
    $arr = [];

    for($i=0; $i<10; $i++){
        $arr[] = $i;
        echo "Array value $i: ";
        print_r($arr);
        echo "</br>";
    }

    for($j=0; $j<5; $j++){
        $arrPop = array_pop($arr);
        echo "Popped array value $j: ";
        print_r($arr);
        echo "</br>";
        echo "Value popped: " . $arrPop;
        echo "</br>";
    }
?>
</body>
</html>