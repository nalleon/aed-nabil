<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $mivar = [];
        array_push($mivar, "uno");
        $arr1 = $mivar;
        $arr2 = &$mivar;

        $arr1[0] = "una variacion";
        $arr2 [0] = "variando array2";
        
        echo($mivar[0]);
        echo "</br>";
        echo($arr1[0]);

        echo "</br>";
        //var_dump solo debug
        var_dump($mivar);

    ?>
</body>
</html>