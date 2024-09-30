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
    $var = 'dato';
    for($i=0; $i<10; $i++){
        ${$var.$i} = $i;
    }
    
    echo "<br> ${'dato0'} ";
    echo "<br> ${'dato1'} ";
    echo "<br> ${'dato2'} ";
    echo "<br> ${'dato3'} ";
    echo "<br> ${'dato4'} ";
    echo "<br> ${'dato5'} ";
    echo "<br> ${'dato6'} ";
    echo "<br> ${'dato7'} ";
    echo "<br> ${'dato8'} ";
    echo "<br> ${'dato9'} ";
?>
</body>
</html>