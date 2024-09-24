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
    </form>

<?php
    if(!isset($_POST["num"]) || empty($_POST["num"])) {
        exit();
    }

    $numsUser = $_POST["num"];
    $numArray = explode(" ", $numsUser); // same as java split

    foreach ($numArray as $num) {
        if (!is_numeric($num)) {
            echo "Error: All values must be numbers.";
            exit();
        }
    }

    usort($numArray, function($a, $b) {
        if (!($a % 2 == 0) && ($b % 2 == 0)) {
            return -1;
        } elseif (($a % 2 == 0) && !($b % 2 == 0)) {
            return 1;
        } else {
            return 0;
        }
    });

    echo "<p> Sorted array: </p>";  
    foreach($numArray as $num) {
        echo $num. "<br></br> ";
    }

?>
</body>
</html>