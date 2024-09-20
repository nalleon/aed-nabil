<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    
    /**function decompositionNum($num) {
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
    */

    function decompositionNum($num) {
        $actual = 0;
        $operator = 1;
        $result = "";

        for ($i = 1; $i <= $num; $num/=10) {
            $actual = $num % 10;
            $result .= $actual . " * " .  $operator;
            if ($num > 10) {
                $result .= " + ";
            }
            $operator*=10;
        }
        echo $result;

    }


    echo decompositionNum(3102);
    
    function decompositionNumRecursive($num) {
        if ($num < 10) {
            return $num;
        }
        
        $digit = $num % 10;
        $remainingDigits = (int) ($num / 10);

        return $digit. " * 10^". decompositionNumRecursive($remainingDigits);
    }

    echo "</br>";

    echo decompositionNumRecursive(3102);

    
   ?>
</body>
</html>