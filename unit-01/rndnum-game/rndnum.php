<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?> method="post">
        <input type="text" id="num" name="num"/>
        <input type="submit" id="submit" name="submit" value="Send"/>
        <input type="submit" id="restart" name="restart" value="Restart"/>
    </form>
    <?php

        // TODO: informacion session y cookies
        //session_start();

        function startGame(){
            if(!file_exists("rndnumgame.txt") || filesize("rndnumgame.txt") == 0  ) {
                $rndNum = rand(1, 10);
                file_put_contents("rndnumgame.txt", $rndNum);
            }
        }

        startGame();

        if(isset($_POST['restart'])) {
            if (file_exists("history.txt")) {
                unlink("history.txt");
            }
            startGame();
        }

        if (!isset($_POST['num']) || empty($_POST['num'])) {
            exit();
        }

        if (!is_numeric($_POST['num'])){
            exit();
        }

        $userNum = $_POST['num'];
        $fileNum = file_get_contents("rndnumgame.txt");

        if ($userNum > $fileNum) {
            $message="$userNum is greater than the correct number\n";
            file_put_contents("history.txt","</br>" . $message, FILE_APPEND);
        } elseif ($userNum < $fileNum) {
            $message="$userNum is lower than the correct number\n";
            file_put_contents("history.txt", "</br>" . $message, FILE_APPEND);
        } elseif ($userNum == $fileNum) {
            $message="Congratulations! You guessed the correct number: $fileNum\n";
            file_put_contents("history.txt","</br>" . $message, FILE_APPEND);
            unlink("rndnumgame.txt");
        }


        /**
         * Function to display the game history of errors and correct guesses
         */

        function displayHistory() {
            if (file_exists("history.txt") && filesize("history.txt") > 0) {
                $historyContent = file_get_contents("history.txt");
                //echo "<h2>History:</h2>";
                echo "$historyContent";
            }
        }

        displayHistory();
?>

<!--
    TODO: explode, use clases historicos(datos y errores)
    PISTAS: userNum >< rndNum
    Input: login username
-->

</body>
</html>