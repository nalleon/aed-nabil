<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
$foo = 1;
$bar = &$foo;
$bar = $bar;
echo $foo;
echo $bar;
?>
</body>
</html>