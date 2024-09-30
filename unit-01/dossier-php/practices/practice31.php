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
    function modify(array &$arr): void {
        $arr[] = 4;
    }
    $a = [1];
    modify($a);
    print_r($a);
?>
</body>
</html>