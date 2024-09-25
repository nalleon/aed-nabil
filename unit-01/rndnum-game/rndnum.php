<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <meta http-equiv="refresh" content="30">
</head>
<body>
    <h2>Guess the number </h2>
    <form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?> method="post">
        <input type="text" id="num" name="num"/>
        <input type="submit" id="submit" name="submit" value="Send"/>
        <input type="submit" id="restart" name="restart" value="Restart"/>
    </form>
    <?php
   // echo " user info: " . $_SESSION['username'];

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

            if (file_exists("bets.csv")) {
                unlink("bets.csv");
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
            $message="$userNum > hidden number\n";
            file_put_contents("history.txt","</br>" . $message, FILE_APPEND);
            saveBets();
        } elseif ($userNum < $fileNum) {
            $message="$userNum < hidden number\n";
            file_put_contents("history.txt", "</br>" . $message, FILE_APPEND);
            saveBets();
        } elseif ($userNum == $fileNum) {
            $message="Congratulations $username! You guessed the hidden number: $fileNum\n";
            file_put_contents("history.txt","</br>" . $message, FILE_APPEND);
            saveBets();
            unlink("rndnumgame.txt");
        }


        /**
         * Function to display the game history of errors and correct guesses
         */

        function displayHistory() {
            if (file_exists("history.txt") && filesize("history.txt") > 0) {
                $historyContent = file_get_contents("history.txt");
                echo "$historyContent";
            }
        }

        displayHistory();

        function saveBets(){
            $sessionId = session_id();
            file_put_contents("bets.csv", $sessionId . ", " . $_SESSION['username'] . ", " . $_POST['num'] . "\n", FILE_APPEND);
        }

        

        function displayBets(){
            if (file_exists("bets.csv") && filesize("bets.csv") > 0) {
                $betsContent = file_get_contents("bets.csv");
                $betsArray = explode("\n", $betsContent);
                echo "<h2>Bets:</h2>";
                echo "<table border='1'>
                        <tr>
                            <th>User</th>
                            <th>Guess</th>
                        </tr>";
                   
                foreach ($betsArray as $bet) {
                        if (!empty($bet)) {
                            $betData = explode(", ", $bet);
                            $username = $betData[1];
                            $guess = $betData[2];
                            echo "<tr>
                                <td>$username</td>
                                <td>$guess</td>
                            </tr>";
                        }
                }
                echo "</table>";
            }
        }

        displayBets();
      
?>

<!--
    TODO: explode, use clases historicos(datos y errores)
    PISTAS: userNum >< rndNum
    Input: login username
-->

</body>
</html>