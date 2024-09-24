
<?php
    session_start();

        /*if(!isset($_POST['username']) && !isset($_POST['login'])) {
            exit("Username field is required.");
        }*/

    $username= $_POST['username'];
    $_SESSION['username'] = $username;

        //file_put_contents("users.txt", $_SESSION['username']. "\n", FILE_APPEND);
        //echo "Welcome, ". $_SESSION['username'];

    header('Location: rndnum.php');
?>