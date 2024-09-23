<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
    $arr= ["1","2","3","4"];
    $va = array_pop($arr);
    echo "el array ahora queda: <br>";
    print_r($arr);
    echo "<br>el valor extraido es: " . $va;
?>
</body>
</html>