<?php
declare( strict_types=1);
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title></title>
</head>
<script defer src="./scripts/practica03.js"></script>
<!--
 Examen -> Test parte teorica (Tipado de PHP importante)
-->
<body>
<?php
function sum($a, $b) : float {
    echo $a + $b;
return $a + $b;
}
echo "<p> la suma de uno más dos es: ";
$resultado = sum(1.2,2);
print sum(1,2);
echo "</p>"
?>
</body>
</html>

