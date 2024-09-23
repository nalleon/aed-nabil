<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
    function modify(int &$a): void {
        $a = 3;
    }
    $a = 2;
    modify($a);
    print_r($a);
?>
</body>
</html>