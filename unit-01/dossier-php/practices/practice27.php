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
    $arr = [7,2,8,1,9,4];

    print_r($arr);
    echo "</br>";

    $key = array_search(4, $arr);
    found($key);

    function found($key) {
        if( $key === FALSE) {
            echo "Value not found in array";
        } else {
            echo "Value found at index " . $key;
        }
    }

    echo "</br>";

    function compare($val1, $val2) {
        return $val1 <=> $val2;
    }

    echo "</br>";
    usort($arr, "compare");
    $sortArr = [];

    foreach ($arr as $value) {
        $sortArr[] = $value;
    }

    print_r($sortArr);
    echo "</br>";

    $key = array_search(4, $sortArr);
    found($key);
?>
</body>
</html>