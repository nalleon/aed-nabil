<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    
    function decompositionNum($num) {
       $numAux = $num;

       $units = (int) $numAux % 10;
       $numAux = (int) ($numAux / 10);
       $tens = (int) $numAux % 10;
       $numAux = (int) ($numAux / 10);
       $hundreds = (int) $numAux % 10;
       $numAux = (int) ($numAux / 10);
       $thousand = (int) $numAux % 10;

       return $units . " * 1 + " . $tens . " * 10 + " . $hundreds . " * 100 + " . $thousand . " * 1000";    
    }

    echo decompositionNum(3102);
    
   ?>
</body>
</html>