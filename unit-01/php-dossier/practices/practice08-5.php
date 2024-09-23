<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
    const PULGADA = 2.53;
    var_dump(PULGADA);
    echo "</br>";
    const PULGADA = 8;
    var_dump(PULGADA);
    echo "</br>";
    $PULGADA = 9;
    var_dump(PULGADA);

    function testConstants(){
        const PULGADA_LOCAL = 10;
        return PULGADA;
    }

?>
</body>
</html>


