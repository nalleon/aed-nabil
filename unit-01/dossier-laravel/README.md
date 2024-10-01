<div align="justify">

## PHP Dossier

- [Práctica 01](#práctica-01)
- [Práctica 02](#práctica-02)
- [Práctica 03](#práctica-03)
- [Práctica 04](#práctica-04)
- [Práctica 05](#práctica-05)
- [Práctica 06](#práctica-06)
- [Práctica 07](#práctica-07)
- [Práctica 08](#práctica-08)
- [Práctica 09](#práctica-09)
- [Práctica 10](#práctica-10)
- [Práctica 11](#práctica-11)
- [Práctica 12](#práctica-12)
- [Práctica 13](#práctica-13)
- [Práctica 14](#práctica-14)
- [Práctica 15](#práctica-15)
- [Práctica 16](#práctica-16)
- [Práctica 17](#práctica-17)
- [Práctica 18](#práctica-18)
- [Práctica 19](#práctica-19)
- [Práctica 20](#práctica-20)


#### Extras:

- [To do - subjects]()


***

### Práctica 01

> 📂
> Modificar el fichero web.php para que las peticiones GET ( parecido al ejemplo anterior ) al raíz de la aplicación: “/” muestren un mensaje que diga: “Under construction
>

```code
 Route::get('/', function () {
    echo "Under construction";
});
```

- Captura:
<div align="center">
<img src="./img/p1.png"/>
</div>

***
</br>

### Práctica 02

> 📂
> Modificar el fichero web.php para que las peticiones POST a: /pruebita muestren el mensaje: “se ha ejecutado una petición POST a la dirección: /pruebita ” Probar a hacer la petición POST ¿ muestra lo solicitado ? ¿ qué ocurre si se hace mediante una petición GET ? Volver a reestablecer la protección CSRF y hacer de nuevo la petición POST ¿ qué muestra ahora ?
>

```code
Route::post('/pruebita', function () {
    echo "Se ha ejecutado una petición POST a la dirección: /pruebita";
});
```

- Captura:

<div align="center">
<img src="./img/p2.png"/>
</div>

</br>

### Práctica 03

> 📂
> Crear una ruta para TODA petición ( ya sea GET, POST, … ) hacia /relatos/numero ( recordar que hemos visto una opción para recoger todo tipo de petición) De tal forma que numero deba ser un número y muestre el mensaje: “petición recibida para
el parámetro: numero”
>

```code
Route::any('/relatos/numeros/{num}', function ($num) {
    echo "Petición recivida para el parámetro: ". $num;
    exit();
})->where('num', '[0-9]+');
```

- Captura:

<div align="center">
<img src="./img/p3-1.png"/>
<img src="./img/p3-2.png"/>

</div>

</br>

### Práctica 04

> 📂
> Crear una ruta para el raíz: “/” En una primera implementación mostrará el mensaje: “página raíz de nuestra aplicación” que se resolverá en el propio web.php Haremos una segunda versión de esta actividad en la que redireccionará hacia el controlador y la función pertinente y allí se mostrará un mensaje que indique adicionalmente que se ha respondido desde el controlador
>

```code
Route::get('/', function (){
    echo "Página raíz de nuestra aplicación";
});
```

- Captura:

<div align="center">
<img src="./img/p4.png"/>
</div>

</br>

### Práctica 05

> 📂
> Crear un controlador llamado: ListarProductos que sea redireccionado en web.php cuando se acceda al raíz: “/” y muestre un mensaje que diga: “Ejecutando el controlador ListarProductos mediante get”. ( si la llamada fue get. En el caso de que la llamada fuera post deberá decirlo )
>

```code
Route::any('/', [ListarProductos::class, 'index']);

class ListarProductos extends Controller
{
    public function index(Request $request) {
        if ($request->isMethod('GET')){
            echo "Ejecutando el controlador ListarProductos mediante get";
        } elseif ($request->isMethod('POST')) {
            echo "Ejecutando el controlador ListarProductos mediante POST";
        }
    }
}

```

- Captura:

<div align="center">
<img src="./img/p5-1.png"/>
<img src="./img/p5-2.png"/>
</div>

</br>

### Práctica 06

> 📂
> Comprobar que la anotación @var para un objeto permite que el ide con
inteliphense nos ayude con los atributos y los métodos
>

```code
<?php
class Practice06 {
    /**
     * @var string 
     */
    protected $name;
}
?>
```

- Captura:

<div align="center">
<img src="./img/p6.png"/>
</div>

</br>

### Práctica 07

> 📂
> Reproducir la vista descrita. Crear una tabla html por cada primo con un
encabezado en la tabla que nos diga que campo estamos visualizando.
>

```code
Route::any('/practice07', [Practice07Controller::class, 'primeNums']);
```

```code
class Practice07Controller extends Controller
{
    public function primeNums()
    {
    $primeArray = collect([1,2,3,5,7,11,13,17,19]);
    return view('practice07',compact('primeArray'));
    }
}
```

```code
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body class="antialiased">
    @foreach ($primeArray as $num)
    <p> num: {{$num}} </p>
    @endforeach
</body>
</html>
```

- Captura:

<div align="center">
<img src="./img/p7.png"/>
</div>

</br>

### Práctica 08

> 📂
> Agregar al comienzo de la vista el mensaje(sustituye por la hora/día actual): Son las: 17:53 del día: 29-11-2020 Nota: buscar información y usar la función PHP date()
>

```code
Route::get('/practice08', [Practice08Controller::class, 'date']);
```

```code
class Practice08Controller extends Controller
{
    public function date() {
        $currentDateTime = date('H:i \d\e l, d-m-Y');
        return view('practice08', compact('currentDateTime'));
    }
}
```

```code
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body class="antialiased">
        <h1>{{$currentDateTime}}</h1>
</body>
</html>
```

- Captura:

<div align="center">
<img src="./img/p8.png"/>
</div>

</br>

### Práctica 09

> 📂
> El comando sleep() en php permite pausar la ejecución la cantidad de segundo especificada como parámetro. Modificar el ejemplo anterior para que lo muestre 3 veces con una espera de 1 segundo entre una iteración y la siguiente, mostrando de forma actualizada la información de los segundos desde 1970
>

```code
Route::get('/practice09', function(){
    return view('practice09');
});
```


```code
    @php
        $dataSecondsArray = [];

        for($i=0; $i < 3; $i++){
            $seconds = time();
            $dataSecondsArray[$i] = $seconds;
            sleep(1);
        }
        
    @endphp

    @foreach ($dataSecondsArray as $seconds ){
        <h1>Since 1-01-1970 have passed: {{$seconds}} seconds</h1>
    }
        
    @endforeach
```

- Captura:

<div align="center">
<img src="./img/p9.png"/>
</div>

</br>

### Práctica 10

> 📂
>Generar una lista de números aleatorios de 0 a100 en el controlador. Desde
nuestra plantilla blade mostraremos primero la lista de números obtenidos menores de 50 y un poco más abajo en la página los mayores que 50. Hacer uso de las directivas @if para que al mostrar aquellos que sean mayores de 50
>

```code
Route::get('/practice10', [Practice10Controller::class, 'rndNum']);
```

```code
    public function rndNum() {
        $array = [];
        for ($i = 0; $i < 15; $i++) {
            $array[] = rand(1, 100);
        }
        return view('practice10', compact('array'));
    }
```

```code
    <h2>Smaller than 50:</h2>
    <ul>
        @foreach ($array as $num )
            @if ($num < 50)
                <li>{{$num}}</li>
            
            @endif
        
        @endforeach
    </ul>

    <h2>Greater than 50:</h2>
    <ul>
        @foreach ($array as $num )
            @if ($num > 50)
                <li>{{$num}}</li>
            
            @endif
        
        @endforeach 
    </ul>
```

- Captura:

<div align="center">
<img src="./img/p10-1.png"/>
<img src="./img/p10-2.png"/>
</div>

</br>


### Práctica 10

> 📂
> Enviar en un textarea una lista de palabras separadas por comas. Mostrar en
una lista html esas palabras recibidas (una palabra por cada <li> de la lista ) convertidas todas a mayúsculas. Para ello se usará el bucle: @for ( cuidado! No el foreach ) Observar que eso implicará “contar” el número de elementos que tiene la colección de palabras
>

```code
Route::get('/processwords', [Practice11Controller::class, 'processWords']);
```

- practice11.blade.php

```code
    <form action="processwords" method="GET">
        <textarea name="words" placeholder="Word's list">ç</textarea>
        <input type="submit" value="Send">
    </form>
```

- practice11Controller.php

```code
class Practice11Controller extends Controller
{
    public function processWords(Request $request) {
        $words = explode(',',  $request->input('words')??null);

        return view('practice11result', [
            'words' => $words,
        ]);
    }
}
```

- practice11result.blade.php

```code
    @php
    $length = count($words);
    @endphp

    <ul>
        @for ($i=0; $i<$length; $i++)
            <li>{{$words[$i]}}</li>
        @endfor
    </ul>
```

- Captura:

<div align="center">
<img src="./img/p11-1.png"/>
<img src="./img/p11-2.png"/>
</div>

</br>


</div>