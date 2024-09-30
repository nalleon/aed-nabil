<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <meta name="author" content="Nabil L.A.">
</head>
<body>
    <form action="practice35.php" method="post">
        <input type="text" id="num" name="num"> 
        <input type="submit" id="submitNum" name="submitNum" value="Send">
    </form>

    <?php

        if (empty($_POST["num"]) || !is_numeric($_POST["num"])){
            echo "Please enter a valid integer num.";
            exit();
        }   

        $numMulti = $_POST["num"]; 

        if ($numMulti < 1){
            echo "Num must be positive.";
            exit();  
        }

        echo "Recived last petition </br>";
        echo "Num send: ". $numMulti. "</br>";


        function multiplicationTables($num) {
            for ($i = 1; $i <= 10; $i++) {
                $result = $num * $i;	
                echo "$num *  $i  = ". $result. "</br>"; 
            }
        }

        echo "</br>";
        multiplicationTables($numMulti);
    ?>
</body>
</html>