<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
    $array = array('perro', 'gato', 'avestruz');
    foreach ($array as $index => $animals) {
        print "array[ $index ] = $animals </br>";
    }
?>
</body>
</html>