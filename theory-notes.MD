<div align="justify">

# aed

Languages: Spanish 🇪🇸

## Index

- [PHP básico](#php-básico)
- [Laravel](#laravel)

___


### PHP básico

1. Una variable como cualquier etiqueta en php empieza por una letra o guion
bajo, seguido por cualquier número de letras, números o guiones bajos. Usando una expresión regular, se representaría de la siguiente maneras: [a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]

2. Una misma variable puede contener un número y luego puede contener caracteres. El intérprete
establecerá el tipo de dato internamente al hacer la inicialización de la variable ( tipado dinámico )

3. Para saber si es de un tipo de datos en concreto: is_array, is_bool, is_float, is_int, is_string, is_null, is_object, is_resource

4. declare(strict_types=n) DEBE SER LO PRIMERO QUE ESTABLECEMOS EN EL FICHERO. Con strict_types una variable no puede pasar un valor distinto a una función o retornar un
valor distinto del tipo que se haya definido

5. $_REQUEST matriz asociativa que contiene los datos enviados por los formularios y las
cookies

6. $_SERVER matriz asociativa con información sobre cabeceras, rutas, etc suministrada
por el servidores

7. $GLOBALS matriz asociativa con todas las variables disponibles en el ámbito global

8. <=> Comparador de orden. (PHP 7, Spaceship operator) Este operador sirve para comparar dos variables ($a y $b) y devolverá -1 si $a es < $b, 0 cuando sean iguales y 1 cuando $a sea mayor que $b.

9. isset() devuelve su primer operando si existe y no es NULL. Observamos que isset() es equivalente a !empty() salvo en el caso de una variable que es comillas vacías. En ese caso isset() devolverá false mientras que !empty() devolverá true

10. Los arrays se copian por valor no por referencia. Para tomar referencia usamos: &$miarray

11. Un foreach hace una copia del array original para hacer las iteraciones

12. Cuando encadenamos 2 foreach es una buena práctica ejecutar unset() respecto a esa referencia y evitar así problemas al entrar al segundo foreach

13. Se suele considerar óptimo el uso de foreach para recorrer un array y se suele
recomendar este método respecto a otras opciones. Pero eso nos lleva en ocasiones a tener que introducir: break o return, ya que foreach únicamente tiene la condición de parada de finalización del array

14. array_pop() devuelve el último elemento de un array. Si el array está vacío devuelve null

15. Para agregar a la pila podemos hacer uso de:
$arr[] = valordeseado; o array_push($arr, valordeseado) Se recomienda hacer uso de la primera expresión cuando es un único valor el que se quiere agregar.Cuando queremos agregar varios con push: array_push($arr, “dato1”, “dato2” )

16. array_shift() quita un elemento del principio del array y lo devuelve acortando el array un elemento (quedando en el array los restantes al quitado)

17. array_unshift() Añade elementos al inicio de un array

18. in_array() comprueba si un valor existe en un array. Devuelve boolean

19. array_search() busca un valor determinado en un array y devuelve la primera clave correspondiente en caso de éxito o FALSE si no.

20. array_values() devuelve un array indexado con los valores del array que se le pase como parámetro. Observar que mediantes esta función podríamos eliminar los huecos generados en un array por unset()

21. array array_keys ( array $array [, mixed $search_value = NULL [, bool $strict = FALSE ]] ) devuelve todas las claves de un array o un subconjunto de claves

22. usort() ordena un array según sus valores usando una función de comparación definida por


23. Establecer tipo de parámetros primitivos y tipo de datos de devolución primitivo es a partir de php 7 así pues en general, podemos no definir el tipo de parámetro, como se puede observar en el ejemplo. Siendo así no es posible una sobrecarga de funciones como podemos ver en otros lenguajes como Java Si enviamos más parámetros que los que corresponde a una función, esta seguirá funcionando igualmente

24. urlencode() codifica como URL una cadena. Esta función es conveniente como método práctico para pasar variables a la siguiente página

25. Si a algo que le aplicamos urlencode() y luego recogermos con $_GET luego no tenemos que pasarle un decode. Y por la forma de trabajo de $_POST ( sabemos que por defecto los formularios se envían como application/x-www-form-urlencoded ) tampoco es necesario
decode

24. Después de la dirección web URL ha terminado, se incluye un signo de interrogación ( ?) seguido de los pares de
nombre / valor, cada uno separado por un signo ( &). En este caso estamos pasando dos piezas de
datos en el servidor:

25. En $_REQUEST se almacenan los valores de $_POST, $_GET, $_COOKIES

26. _REQUEST podremos acceder al valor de la variable recibida
indistintamente de que se cambie el método get a post o vicerversa.

27. Un inconveniente que tiene hacer uso de $_REQUEST es que no sabes el
método de procedencia de la variable ( si fue post o get )

28. $_SERVER['PHP_SELF'] puede tener problemas de seguridad: Cross-site scripting (XSS) es un tipo de vulnerabilidad en seguridad computacional
encontrado usualmente en aplicaciones Web. XSS les permite a los atacantes inyectar scripts del
lado del cliente en páginas Web que son vistas por otros usuarios.


29. preg_match() para expresiones regulares

30. filter_var() con FILTER_VALIDATE_EMAIL para validar correo electrónico

31. El Operador de Resolución de Ámbito o en términos simples, el doble dos-puntos (::), es un token que permite acceder a elementos estáticos, constantes, y sobrescribir propiedades o métodos
de una clase.

32. Se usa $this para hacer referencia al objeto (instancia) actual, y se utiliza self:: para referenciar a la clase actual. 

33. Si utilizas el operador de comparación ==, comparas los valores de los atributos de los
objetos. Por tanto dos objetos serán iguales si son instancias de la misma clase y, además, sus
atributos tienen los mismos valores.

34. Si utilizas el operador ===, el resultado de la comparación será true sólo
cuando las dos variables sean referencias al mismo objeto.

35. Nosotros podemos establecer el comportamiento de clone si creamos la función: __clone() Tal función se llama automáticamente al usar la palabra clave clone

36. get_object_vars() Tal función te devuelve los atributos no estáticos accesibles de
un objeto. Devulve null si el parámetro que se le pasa no es un objeto

37. Para crear clases que hereden de otra utilizamos la palabra reservada: extends

38. Por medio de parent podemos acceder a variables y funciones del padre desde dentro de la clase. A diferencia de otros lenguajes no se ejecuta primero el constructor de la clase padre A Pero podemos llamar al constructor del padre si lo queremos con: parent::__construct()

### Laravel

1. El archivo web.php contiene rutas que RouteServiceProvider coloca en el grupo de
middlewareweb, que proporciona estado de sesión, protección CSRF y encriptación de cookies

2. El directorio storage/app/public puede ser usado para almacenar archivos generados por el
usario,tales como imagenes de perfil, que deberían ser accesibles públicamente. Debes crear un enlacesimbólico en public/storage que apunte a este directorio. Puedes crear el enlace usando el comando php artisan storage:link.

3. web.php le indica a laravel que se debe hacer con cada solicitud que realiza el usuario

4. Route::any() esto significa que cualquier petición que se haga a: /pruebita se resuelve con esta ruta indistintamente del tipo de petición HTTP que sea

5. Coincide la ruta del namespace con la ruta de la carpeta. Esto es una buena política: se recomienda estructurar los namespace por la ubicación en carpetas

6. Nosotros le pasamos el nombre de las variables y compact nos construye un array
clave/valor donde la clave es el nombre de la variable y el valor aquello que contenga la variables

7. ¿Qué es un helper para Laravel?: Una función global que tenemos disponible en cualquier parte de la aplicación

8. **session():**
- Saber si existe un elemento en la sesión:
    > session()->has('usuario');//devuelve true si está presente y no es nulo

- Guardar en la sesión ( se puede hacer mediante Request o el helper session ):
    > $request->session->put('key' , 'value');
    session(['key' => 'value']); //también vale: session()->put(‘key’,’value’)

- Tomar todos los datos de la sesión:
    > $data = session()->all()

- Borrar un elemento de la sesión:
    > session()->forget('orderId');

- Y si queremos obtener el dato y borrarlo a la vez del array de session:
    > $value = $request->session()->pull('key', 'default')

- Borrar todos los elementos de la sesión
    > $request->session()->flush()

- Y si queremos borrar todos los datos de la sesión y tener un nuevo identificador de sesión:
    >$request->session()->flush();
    $request→session()→regenerate();

- Si queremos borrar la información de usuario de la sesión
    > auth()→logout();

9. Cuando generemos un formulario, se debe incluir un campo: @csrf para que el middleware
valide el token

10. Los Middleware proveen un mecanismo eficiente para el filtro de peticiones HTTP que
ingresen a tu aplicación. Es un puente entre la solicitud y la respuesta que ejecuta un filtrado

11. Una forma fácil de visualizar el token csrf es mediante: {{ csrf_token() }}

12. Es importante que especifiquemos enctype para que podamos subir el fichero. Pondremos
enctype='multipart/form-data' habitualmente cuando queramos subir fichero

13. response()->download() para ejecutar la
descarga. Ese método es el que hará la descarga del fichero que le indiquemos.

</div>
