<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
 <?php
    if (empty($_REQUEST["num"])) {
        echo "Num was not submitted.";
        exit();
    } 

    $numDesc = $_REQUEST["num"]; 

    echo "Num send: ". $numDesc. "</br>";
    
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

    decompositionNum($numDesc);
 ?>
</body>
</html>