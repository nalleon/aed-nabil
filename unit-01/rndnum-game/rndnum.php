<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?> method="post">
        <input type="text" id="num" name="num"/>
        <input type="submit" id="submit" name="submit" value="Send"/>
    </form>
    <?php

        // TODO: informacion session y cookies
        session_start();

        echo "Try to guess the number between 1 and 10: </br>";
            
        $fileName = "rndnumgame.txt";

        if($file_exists('$fileName') || filesize('$fileName') == 0){
            $rndNum = rand(1, 10);
            file_put_contents($fileName, $rndNum) . "\n";
        }


        if (!isset($_POST['num']) || empty($_POST['num'])) {
            exit();
        }

        $userNum = $_POST['num'];

        $fileNum = file_get_contents("rndnumgame.txt");
        
        if ($userNum == $fileNum) {
            echo "<p> Congratulations! You guessed the correct number.</p>";
        } elseif ($userNum < $fileNum) {
            echo "<p> $userNum is lower than the correct number.</p>";
        } elseif ($userNum > $fileNum) {
            echo "<p> $userNum is greater than the correct number</p>";
        }
    

    echo "</br>Attempts: ";
?>

<!-- TODO: explode, use clases hsitoricos(datos y errores)
     PISTAS: userNum >< rndNum
    Input login username-->

</body>
</html>