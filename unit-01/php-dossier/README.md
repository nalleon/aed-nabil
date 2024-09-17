<div align="justify">

## PHP Dossier 

- [Práctica 01](./php-dossier/practice01.php)
- [Práctica 02](./php-dossier/practice02.php)
- [Práctica 03](./php-dossier/practice03.php)
- [Práctica 04](./php-dossier/practice04.php)
- [Práctica 05](./php-dossier/practice05.php)
- [Práctica 06](./php-dossier/practice06.php)
- [Práctica 07](./php-dossier/practice07.php)
- [Práctica 08](./php-dossier/practice08.php)
- [Práctica 09](./php-dossier/practice09.php)
- [Práctica 10](./php-dossier/practice10.php)
- [Práctica 11](./php-dossier/practice11.php)
- [Práctica 12](./php-dossier/practice12.php)


***

### Práctica 01

> 📂 
> Crear el script como se ha comentado sustituyendo “alumno” por nuestro
nombre completo. Tomar captura de pantalla del resultado
>

- Captura:
<div align="center">
<img src="./img/p1.png"/>
</div>

***
</br>

### Práctica 02

> 📂 
> Crear el script anterior. Modificarlo para sumar a $un_str el valor de $un_int y mostrarlo en pantalla ¿ qué ocurre ?
>

Podemos observar como la operación no se puede realizar porque los dos variables que estamos sumando son de distintos tipos.

- Captura:

<div align="center">
<img src="./img/p2-1.png"/>
</div>



</br>

> 📂 
> Sumar $un_str con $un_str2 ¿ qué ocurre ?
>

No se nos permite concatener cadenas de texto utilizando operadores como '+' al contrario que en Java.

- Captura:
<div align="center">
<img src="./img/p2-2.png"/>
</div>

</br>

> 📂 
> ¿ Se puede concatenar una cadena con comillas
simples con una con comillas dobles ?
>

Gracias al operador '.' nos es posible concatener cadenas de texto sin importar si estas son de comillas simples o dobles.

- Captura:

<div align="center">
<img src="./img/p2-3.png"/>
</div>

***

</br>

## Práctica 03

> 📂 
> Realizar el código anterior y tomar captura de pantalla del resultado. ¿ qué es lo
que ha ocurrido ?
>

Se nos muestra el parrafo del echo. La suma se visualiza gracias al uso del print en vez de a la declaración de la variable resultado.

- Captura:

<div align="center">
<img src="./img/p3-1.png"/>
</div>

</br>

> 📂 
> Poner código html antes de la declaración de strict_types y probar de
nuevo ¿ qué ocurre ahora ?
>

Tenemos un error, ya que las declaraciones de strict_types deben ser lo primero en nuestro fichero php.

- Captura:

<div align="center">
<img src="./img/p3-2.png"/>
</div>

***
</br>

## Práctica 04

> 📂 
> ¿ Da error ? ¿ Por qué ?
>

Al probar el código proporcionado, observamos que no hay error y en efecto la función funciona correctamente. Esto es debido a que estamos devolviendo un resultado que tiene el tipo de variable que se espera.

- Captura:

<div align="center">
<img src="./img/p4-1.png"/>
</div>

</br>

> 📂 
> Quitar el comentario a: return $a; ¿ Da error ahora ? ¿ Por qué ?
>

Al realizar el cambio, nos encontramos con un error puesto que en la función igualamos '$a' a una cadena de texto y al ahora retornar este argumento en vez de '$b' tenemos un error, ya que la propia función especifica que devuleve un valor entero.

- Captura:

<div align="center">
<img src="./img/p4-2.png"/>
</div>

</br>

> 📂 
> Quitar comentario a: print fun(“e”,3); ¿ Da error ?
>

Tras realizar este cambio, también tenemos un error. En este caso es por pasarle por parametros a la función un tipo de dato distinto al esperado.

- Captura:

<div align="center">
<img src="./img/p4-3.png"/>
</div>

***
</br>

## Práctica 05

> 📂 
> Probar el código anterior. Probar ahora con números ¿ también funcionan las referencias ?
>

Originalmente funciona de esta manera.
- Captura:

<div align="center">
<img src="./img/p5-1.png"/>
</div>


Al realizar el cambio a valores númericos se muestra de la siguiente forma, donde podemos apreciar que sigue funcionando;

- Captura:

<div align="center">
<img src="./img/p5-1-1.png"/>
<img src="./img/p5-1-2.png"/>
</div>

***
</br>

## Práctica 05.5

> 📂 
> Crear un array: $mivar = []; Introducir datos: array_push($mivar,”uno”); y hacer una asignación a otras variables. Una por referencia y la otra por valor: $arr1 = $mivar; $arr2 = &$mivar; modificar la posición cero de esas variable : $arr1[0] = “una variación”; $arr2[0] = “variando array2 ”; y mostrar el contenido de $mivar[0] y $arr1[0] ¿ qué es lo que ha ocurrido ? ( tomar captura de pantalla y explicarlo )
>


- Captura:

<div align="center">
<img src="./img/p5-1-3.png"/>
</div>

***
</br>

## Práctica 06

> 📂 
> Hacer un script php que haga echo de $_SERVER y de $_SERVER
[PHP_SELF] tomar captura de pantalla de los resultados
>

- Código:
```

```

- Captura:
<div align="center">
<img src="./img/p6.png"/>
</div>


***

</div>