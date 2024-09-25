<?php 
    session_start();
    //$rnd = rand(1,10);
    //$_SESSION['rnd'] = $rnd;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

</head>
<body>
    <form action="login.php" method="post">
        <input type="text" id="username" name="username"/>
        <input type="submit" id="login" name="login" value="Login"/>
    </form>
</body>
</html>