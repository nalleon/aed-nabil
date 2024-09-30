<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<br>
    <form action="formNum.php" method="post">
        <input type="text" id="num" name="num"> 
        <input type="submit" id="submitNum" name="submitNum" value="Send"> <!-- id client, js || name server--> 
    </form>
 <?php
    if (!isset($_POST["num"])){
        exit();
    }
    echo "recived last petition";
    echo "</br>";
    echo "Num send: ". $_POST["num"]. "</br>";


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
    echo "</br>";
    decompositionNum($_POST["num"]);
 ?>
</body>
</html>