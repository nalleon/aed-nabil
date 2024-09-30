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

