<?php
$un_bool = TRUE; 
$un_str = "foo"; 
$un_str2 = 'foo'; 
$un_int = 12; 

/**
* Esta operacion no se puede realizar al ser cada variable de tipos distintos.
*/

//$sum = $un_str+$un_int;
//echo "$sum";


/**
 * Al contrario que en Java, no se nos permite concatenar dos strings utilizando el operador '+'
 */

//$sumStr = $un_str+$un_str2;
//echo "$sumStr";

/**
 * Utilizando '.' podemos concatenar cadenas independientemente de si son de comillas dobles o simples.
 */

echo ($un_str.$un_str2)

?>