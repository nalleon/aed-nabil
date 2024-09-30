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
    $array = ["a","a","a","a","a"];
    $j=count($array);
    foreach( $array as $key => &$val){
        $j--;
        $array[$j] .= $j;
        echo "<br>";
        var_dump($array);
        echo "<br> $key => $val";
        echo "<br> $key => $array[$key]";
        echo "<br>";
    }


    $arr = array(1, 2, 3, 4);
    foreach ($arr as &$val) {
        $val = $val * 2;
        print_r($arr);
        echo "<br><br>";
    }

    foreach ($arr as $key => $val2) {
        echo "{$key} => {$val2} <br>";
        print_r($arr);
        echo "<br><br>";
    }
?>
</body>
</html>