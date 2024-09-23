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
    for ($i = 0; $i < 10; $i++) {
        $arr[$i] = rand (20, 25);
    }

    print_r($arr);

    echo "</br>";

    $key = array_search(22, $arr);
    if( $key === FALSE) {
        echo "Value not found in array";
    } else {
        echo "Value found at index " . $key;
    }
?>
</body>
</html>