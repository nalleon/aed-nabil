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
    $arr = array(1, 2, 3, 4);
    foreach ($arr as &$val) {
        $val = $val * 2;
    }
    foreach ($arr as $key => $val) {
        echo "{$key} => {$val} <br>";
        print_r($arr);
        echo "<br><br>";
    }
    ?><?php
        $arr = array(1, 2, 3, 4);
        foreach ($arr as &$val) {
        $val = $val * 2;
    }
    foreach ($arr as $key => $val) {
        echo "{$key} => {$val} <br>";
        print_r($arr);
        echo "<br><br>";
    }
?>
</body>
</html>