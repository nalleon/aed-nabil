<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        function exponentation(){
            $num = 2;
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