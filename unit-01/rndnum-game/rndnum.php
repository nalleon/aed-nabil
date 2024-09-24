<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Guess the number </h2>
    <form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?> method="post">
        <input type="text" id="num" name="num"/>
        <input type="submit" id="submit" name="submit" value="Send"/>
        <input type="submit" id="restart" name="restart" value="Restart"/>
    </form>
    <?php
    echo " user info: " . $_SESSION['username'];

        $username=$_SESSION['username'];

        // TODO: informacion session y cookies
        // cookies -> client

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

        function saveBets(){
            file_put_contents("bets.csv", $username . ", " . $userNum . "\n", FILE_APPEND);
        }

        function displayBets(){
            if (file_exists("bets.csv") && filesize("bets.csv") > 0) {
                $betsContent = file_get_contents("bets.csv");
                echo "<h2>Bets:</h2>";
                echo "<table border='1'>
                <tr>
                    <th>Username</th>
                    <th>Guess</th>
                </tr>
                $betsContent
                </table>";
            }
        }
      
?>

<!--
    TODO: explode, use clases historicos(datos y errores)
    PISTAS: userNum >< rndNum
    Input: login username
-->

</body>
</html>