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


function exponentation(){
    $num = $_REQUEST["num"];
    for($i = 0; $i < 10; $i++){
        $str = $num;
        $str .= "^".$i;
        echo $str. " = ". ($num**$i). "<br>";
    }
}   

exponentation(); 
echo "<br>";
?>
</body>
</html>