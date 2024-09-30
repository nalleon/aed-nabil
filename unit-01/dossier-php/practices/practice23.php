<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <meta name="author" content="Nabil L.A.">
</head>
<body>
<?php
    echo "<table>";
    echo "<tr>";
    echo "<th>Var</th>";
    echo "<th>Value</th>";
    echo "</tr>";

    foreach ($_SERVER as $key => $value) {
            echo "<tr>";
            echo "<td>$key</td>";
            echo "<td>$value</td>";
            echo "<tr>";
    }

    echo "</table>";
?>
</body>
</html>