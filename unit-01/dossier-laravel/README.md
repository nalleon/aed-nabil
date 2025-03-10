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

- [To do tasks - Session](#to-do-list---session)
- [To do tasks - Files](#to-do-list---files)
- [BlackJack](#blackjack)

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

- Version 1:

```code
Route::get('/', function (){
    echo "Página raíz de nuestra aplicación";
});
```

- Captura:

<div align="center">
<img src="./img/p4-1.png"/>
</div>


- Version 2:

```code
Route::get('/', [Practice04Controller::class, 'controllerResponse']);
```

```code
class Practice04Controller extends Controller
{
    function controllerResponse(){
        echo "Responding from the controller!";
    }
}
```

- Captura:

<div align="center">
<img src="./img/p4-2.png"/>
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

- Routes:

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

- View:

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

- Routes:

```code
Route::get('/practice08', [Practice08Controller::class, 'date']);
```

- Controller:
```code
class Practice08Controller extends Controller
{
    public function date() {
        $currentDateTime = date('H:i \d\e l, d-m-Y');
        return view('practice08', compact('currentDateTime'));
    }
}
```

- View:

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

- Routes:

```code
Route::get('/practice09', function(){
    return view('practice09');
});
```

- View:

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

- Routes:

```code
Route::get('/practice10', [Practice10Controller::class, 'rndNum']);
```

- Controller
```code
    public function rndNum() {
        $array = [];
        for ($i = 0; $i < 15; $i++) {
            $array[] = rand(1, 100);
        }
        return view('practice10', compact('array'));
    }
```

- View:

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


### Práctica 11

> 📂
> Enviar en un textarea una lista de palabras separadas por comas. Mostrar en
una lista html esas palabras recibidas (una palabra por cada <li> de la lista ) convertidas todas a mayúsculas. Para ello se usará el bucle: @for ( cuidado! No el foreach ) Observar que eso implicará “contar” el número de elementos que tiene la colección de palabras
>

- Routes:
```code
Route::get('/processwords', [Practice11Controller::class, 'processWords']);
```


- Controller

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

- Views:

```code
    <form action="processwords" method="GET">
        <textarea name="words" placeholder="Word's list">ç</textarea>
        <input type="submit" value="Send">
    </form>
```

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

### Práctica 12

> 📂
> Ubicar imágenes en la carpeta descrita para las imágenes que quieras mostrar
( mínimo 5 ). Hacer que se visualicen en el navegador las imágenes en nuestra vista
>


-  Routes:
```code
Route::get('/practice12', [Practice12Controller::class, 'showImgs']);
```

- Controller:

```code
class Practice12Controller extends Controller
{
    function showImgs(){
        $imgArray =['img1.jpg', 'img2.jpg', 'img3.jpg', 'img4.jpg', 'img5.jpg'];
    
        return view('practice12', compact('imgArray' ));
    }
}
```

- View:

```code
    @foreach ($imgArray as $img)
        <img src="img/{{$img}}" alt="practice12">
    @endforeach
```


- Captura:

<div align="center">
<img src="./img/p12-1.png"/>
<img src="./img/p12-2.png"/>
</div>

</br>

### Práctica 13

> 📂
> Crear un formulario que envíe nombres de colores en cada ejecución del usuario. Obtendrá por respuesta una página con la lista de colores que ha ido introduciendo (usar session() para almacenar la lista de colores ) ( es un formulario post tendremos que tener en cuenta @csrf leer más abajo )
>

- Routes:

```code
Route::get('/practice13', [Practice13Controller::class, 'getColors']);
Route::post('/add-color', [Practice13Controller::class, 'addColor']);
Route::post('/delete-color/{id}', [Practice13Controller::class, 'deleteColor']);
```

- Controller:

```code
class Practice13Controller extends Controller
{
    public function getColors() {
        $colors = session()->get('colors', []);

        if(!isset($colors)){
            $colors = [];
            session()->put('colors', $colors);
        }
      
        return view('practice13', compact('colors'));    
    }
    
    public function addColor(Request $request){
        $colors = session()->get('colors', []);

        $name = $request->input('color')??null;
        $id = count($colors) + 1;
      

        $newColor = new Color( $id, $name);
        $colors[] = $newColor;

        session()->put('colors', $colors); 

        return redirect('/practice13');
    }

    public function deleteColor(Request $request){
        $colors = session()->get('colors', []);
        $id = $request->input('id');

        foreach($colors as $key => $item){
            if($item->getId() == $id){
                unset($colors[$key]);
                break;
            }
        }

        session()->put('colors', array_values($colors));
        return redirect('/practice13');
    }

}
```

- View:

```code
   <form method="POST" action="{{ url('/add-color')}}">
        @csrf
        @if(isset($color))
            <input type="hidden" name="id" value="{{ $color->id }}">
        @endif
        <label for="color">Color's name: </label>
        <input type="text" name="color" id="color">
        <br>
        <input type="submit" name="submit" id="submit" value="Send">
    </form>
    <br>
    <div class="history">
        <ul>
            @if(!empty($colors))
                @foreach ($colors as $color)
                <li>
                    {{ $color->getName() }}
                    <form method="POST" action="{{ url('/delete-color/'.$color->id) }}">
                        @csrf
                        <input type="hidden" name="id" value="{{ $color->id }}">
                        <button type="submit">Delete</button>
                    </form>
                </li>
                @endforeach
            @else
                <li>Empty list.</li>
            @endif
        </ul>
    </div>
```

- Captura:

<div align="center">
<img src="./img/p13-1.png"/>
<img src="./img/p13-2.png"/>
</div>

</br>


### Práctica 14

> 📂
>Una forma fácil de visualizar el token csrf es mediante: {{ csrf_token() }}
Introducir en la práctica 12 ese código y comprobar que está activo.
>

- View (práctica 12 modificada):

```code
<body class="antialiased">
    <p>CSRF Token: {{ csrf_token() }}</p>
    @foreach ($imgArray as $img)
        <img src="img/{{$img}}" alt="practice12">
    @endforeach
</body>
```

- Captura:

<div align="center">
<img src="./img/p14.png"/>
</div>

<br>


### Práctica 15

> 📂
>Crear un formulario POST Con los datos de un posible usuario ( nombre,
edad, gustos, etc ) En cada ejecución de este formulario se le muestra al usuario la información almacenada del usuario en session() Observar que si se envía el formulario sin rellenar algún campo, se mantendrá la información anterior respecto a ese campo
>

- Routes:

```code
Route::get('/practice15', [Practice15Controller::class, 'showForm']);

Route::post('practice15/update', [Practice15Controller::class, 'handleForm']);
```

- Controller:

```code
    public function showForm(Request $request) {

        $name = session()->get('name');
        $age = session()->get('age');
        $likes = session()->get('likes');

        return view('practice15', compact('name', 'age', 'likes'));
    }

    public function handleForm(Request $request)
    {
        $nameSession = session()->get('name', '');
        $ageSession = session()->get('age', '');
        $likesSession = session()->get('likes', '');

        $nameUpdate = $request->get('name', $nameSession);
        $ageUpdate = $request->get('age', $ageSession);
        $likesUpdate = $request->get('likes', $likesSession);

        $request->session()->put('name', $nameUpdate);
        $request->session()->put('age', $ageUpdate);
        $request->session()->put('likes', $likesUpdate);

        return redirect('practice15')->with('success', 'Updated correctly.');
    }
```  

- View:

```code
<div class="main-container">
    @if(session('success'))
        <p> {{session('success')}}</p>
    @endif

    <p>DATA: {{session('name')}}, {{session('age')}}, {{session('likes')}}</p>
    <form action="{{ url('/practice15/update')}}" method="POST">
        @csrf
            <label for="name">Name</label>
            <input type="text" name="name" id="name" value="{{session('name')}}" />
            <br>
            <label for="age">Age</label>
            <input type="text" name="age" id="age" value="{{session('age')}}" />
            <br>
            <label for="likes">Likes</label>
            <input type="text" name="likes" id="likes" value="{{session('likes')}}" />
            <br>
            <input type="submit" name="submit" value="submit">
    </form>
    <br>
</div>
```

- Captura:

<div align="center">
<img src="./img/p15.png"/>
</div>

<br>


### Práctica 16

> 📂
>Crear un fichero con nombre y dirección de correo por fila ( en formato csv )
almacenado en Storage Leer el fichero y mostrarlo en pantalla
>


- Routes:

```code
 Route::get('/practice16', [Practice16Controller::class, 'readCsv']);
```


- Controller:

```code
public function readCsv (){
    $csvContent = Storage::get('users.csv');
    $rows = explode("\n", $csvContent);
    $data = [];

    foreach ($rows as $row) {
        $columns = explode(',', $row);
        $data[] = [
            'name' => $columns[0],
            'email' => $columns[1],
        ];
    }

    return view('practice16', compact('data'));
}
```

- View:

```code
<div class="main-container">

    <h3>Data of the csv:</h3>
    <ul>
        @foreach($data as $row)
        <li>
            {{ $row['name'] }} -- {{ $row['email'] }} 
        </li>
    @endforeach
    </ul>
</div>
```


- Captura:

<div align="center">
<img src="./img/p16.png"/>
</div>

<br>

### Práctica 17

> 📂
> Crear un formulario que se introduzca un nombre y cree un directorio en
storage con ese nombre
>

- Routes:
```code
Route::get('/practice17', function (){
    return view('/practice17');
});

Route::post('/create-directory', [Practice17Controller::class 'createDirectory']);
```

- Controller:

```code
class Practice17Controller extends Controller
{
    public function createDirectory(Request $request){
        $directory = $request->input('directory');
        if($directory ==! null){
            Storage::makeDirectory('/' . $directory, 700, true);
            echo "Directory created successfully";
        }
        return view('/practice17');
    }

}
```

- View:

```code
     <form method="POST" action="{{ url('/create-directory')}}">
        @csrf
        @if(isset($directory))
            <input type="hidden" name="id" value="{{ $color->id }}">
        @endif
        <label for="directory">Directory's name: </label>
        <input type="text" name="directory" id="directory">
        <br>
        <input type="submit" name="submit" id="submit" value="Send">
    </form>
    <br>
    <div class="history">
            
    </div>
```

- Captura:

<div align="center">
<img src="./img/p17-1.png"/>
<img src="./img/p17-2.png"/>
<img src="./img/p17-3.png"/>
</div>

</br>

### Práctica 18

> 📂
>Crear un formulario que se introduzca un nombre y cree un directorio en
storage con ese nombre
>

- Routes:

```code
Route::get('/practice18', function (){
    return view('/practice18');
});

Route::post('/read-file', [Practice18Controller::class, 'readFile']);
```

- Controller:

```code
class Practice18Controller extends Controller
class Practice18Controller extends Controller
{
    public function readFile(Request $request) {
        if (!$request->hasFile('myFile')) {
            return back()->withErrors(['myFile' => 'No se ha subido ningún archivo.']);
        }

      
        $file = $request->file('myFile');

        $content = [];

        $fileOriginalName = $file->getClientOriginalName();

        $path =$file->storeAs("/", $fileOriginalName);
        
        if (($open = fopen(storage_path('app/' . $path), "r")) !== FALSE) {
            while (($data = fgetcsv($open, 1000, ",")) !== FALSE) {
                $content[] = $data;
            }
            fclose($open);
        }

        return redirect('/practice18')->with('content', $content);
    }
}

```

- View:

```code
    <form method="POST" action="{{ url('/read-file')}}" enctype='multipart/form-data' >
        @csrf
        <input type="file" name="myFile" id="myFile">
        <br>
        <input type="submit" name="submit" id="submit" value="Send">
    </form>
    <br>
    <div class="history">
        @if (session('content') && count(session('content')) > 0)
            <ul>
                @foreach (session('content') as $row)
                    <li>{{ implode(', ', $row) }}</li>
                @endforeach
            </ul>
        @endif
    </div>
```

- Captura:

<div align="center">
<img src="./img/p18.png"/>
</div>

</br>

### Práctica 19

> 📂
> Mostrar en una página una lista de ficheros de una carpeta en storage.
Cuando se pulse en el nombre del fichero se descargará
>

- Routes:

```code
Route::get('/practice19', [Practice19Controller::class, 'showFiles']);
Route::get('/practice19/download/{filename}', [Practice19Controller::class, 'downloadFile']);
```

- Controller:

```code
    public function showFiles(){
        $files = Storage::files('practice19'); 
        return view('practice19', compact('files'));
    }


    public function downloadFile($filename){
        return Storage::download('practice19/' . $filename);
    }
```

- View:

```code
    <div class="main-container">
        <h1>Files in directory</h1>
        <ul>
            @foreach ($files as $file)
                <li>
                    <a href="{{ url('practice19/download/' . basename($file)) }}">{{ basename($file) }}</a>
                </li>
            @endforeach
        </ul>

        @if ($files === null)
            <p>There are no files in this directory.</p>
        @endif
    </div>
```

- Captura:

<div align="center">
<img src="./img/p19-1.png"/>
<img src="./img/p19-2.png"/>
<img src="./img/p19-3.png"/>
</div>

</br>

### Práctica 20

> 📂
> Continuando con el ejemplo anterior crear una opción para borrar los ficheros
listados
>

- Routes:

```code
Route::get('/practice20', [Practice20Controller::class, 'showFiles']);
Route::get('/practice20/download/{filename}', [Practice20Controller::class, 'downloadFile']);
Route::post('/practice20/delete/{filename}', [Practice20Controller::class, 'deleteFile']);
```

- Controller:

```code
    public function showFiles(){
        $files = Storage::files('practice19'); 
        return view('practice19', compact('files'));
    }


    public function downloadFile($filename){
        return Storage::download('practice19/' . $filename);
    }

    public function deleteFile($filename){
        Storage::delete('practice20/' . $filename);
        return redirect('/practice20');
    }
```

- View:

```code
<div class="main-container">
    <h1>Files in directory</h1>
    <ul>
        @foreach ($files as $file)
            <li>
                <a href="{{ url('practice20/download/' . basename($file)) }}">{{ basename($file) }}</a>
                <form action="{{ url('practice20/delete', basename($file)) }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>

    @if ($files === null)
        <p>There are no files in this directory.</p>
    @endif
</div>
```

- Captura:

<div align="center">
<img src="./img/p20-1.png"/>
<img src="./img/p20-2.png"/>
</div>

</br>


### Extra:

#### To do list - Session

- Routes:

```code
Route::get('/', [FormController::class, 'show']);
Route::get('/task', [FormController::class, 'getTask']);

Route::post('/task/create', [FormController::class, 'createTask']);

Route::post('/task/delete', [FormController::class, 'deleteTask']);

Route::post('/task/update', [FormController::class, 'updateForm']);
```

Esta es la única clase del modelo.

- Task:

```code
  /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $subject;

    /**
     * @var string
     */
    public $description;

    /**
     * @var bool
     */
    public $finished;

    /**
     * Task constructor.
     *
     * @param string $subject
     * @param string $description
     *
     *
     * */

     public function __construct(string $subject = "", int $id = 0, string $description = "", bool $finished = false){
        $this->subject = $subject;
        $this->id = $id;
        $this->description = $description;
        $this->finished = $finished;
    }

    // getters and setters
```

- Controller:

```code
 public function show(){
        $todolist = session()->get('todolist');
    
        if (!isset($todolist)) {
            $todolist = [];
            session()->put('todolist', $todolist);
        }
    
        return view('startpage', compact('todolist'));
    }
    

    public function getTask(Request $request){
        $id = $request->input('id');

        $todolist = session()->get('todolist');
        $auxTask = null;


        foreach ($todolist as $item) {
            if($item->getId() == $id){
                $auxTask = $item;
                break;
            }
        }

        return view('tasks', compact('auxTask'));
    }

    public function createTask(Request $request){
            $todolist = session()->get('todolist', []);

            $subject = $request->input('subject')??null;
            $id = count($todolist) + 1;
            $description=$request->input('description')??null;
            $finished = $request->input('finished') === 'Closed' ? true : false; 

            $newTask = new Task($subject, $id, $description, $finished);
            $todolist[] = $newTask;
    
            session()->put('todolist', $todolist); 

        return redirect('/');
    }

    public function updateForm(Request $request){
        $todolist = session()->get('todolist', []);

        $subject = $request->input('subject');
        $id = $request->input('id');
        $description=$request->input('description');
        $finished = $request->input('finished') === 'Closed' ? true : false; // important to declare

        foreach($todolist as $key => $item){
            if($item->getId() == $id){
                $item->setSubject($subject);
                $item->setDescription($description);
                $item->setFinished($finished);
                $todolist[$key] = $item;
                break;
            }
        }

        session()->put('todolist', $todolist);
        return redirect('/');
    }


    public function deleteTask(Request $request){
        $todolist = session()->get('todolist', []);
        $id = $request->input('id');

        foreach($todolist as $key => $item){
            if($item->getId() == $id){
                unset($todolist[$key]);
                break;
            }
        }

        session()->put('todolist', array_values($todolist));
        return redirect('/');
    }
```

- View (página principal):

```code
<div class="main-container">

    <h2>ALL TASKS</h2>
    <ul>
        @foreach ($todolist as $task)
            <li>
                <a href="./task?id={{$task->id}}">{{ $task->subject }}</a>
                <a href="./task?id={{$task->id}}">{{ $task->description }}</a>
                <a href="./task?id={{$task->id}}">{{ $task->finished ? 'Finished' : 'Not finished' }}</a>

                <form action="{{ url('task/delete') }}" method="POST" style="display:inline;">
                    @csrf
                    <input type="hidden" name="id" value="{{ $task->id }}">
                    <input type="submit" name="delete" id="delete" value="Delete">
                </form>
            </li>
        @endforeach
    </ul>     

    <form action="{{ url('task/create') }}" method="POST">
        @csrf
        <label for="subject">Task Subject:</label>
        <input type="text" name="subject" id="subject" placeholder="Task subject" />
        <br>
        <label for="description">Task Description:</label>
        <textarea cols="50" rows="5" name="description" id="description" placeholder="Task description"></textarea>
        <br>
        <label for="finished">Status:</label><br>
        <div class="status-container">
            <input type="radio" value="Open" name="finished" id="finishedOpen" checked> 
            <label for="finishedOpen">Open</label><br>
            <input type="radio" value="Closed" name="finished" id="finishedClosed"> 
            <label for="finishedClosed">Closed</label><br>
        </div>                
        <br>
        <input type="submit" name="create" value="Create">
    </form>
</div>   
```

- View (Task seleccionada):

```code
<div class="main-container">
    <h2>TASK TO UPDATE</h2>
    <form action="{{ url('task/update')}}" method="POST" id="formTasks">
        @csrf
        <label for="subject">Task ID: {{$auxTask->id}}</label>
        <br>
        <input type="hidden" name="id" value="{{ $auxTask->id }}">
        <input type="text" name="subject" id="subject" placeholder="Task subject" value="{{$auxTask->subject}}" />
        <textarea cols="200" rows="5" name="description" placeholder="Task description" id="description">{{$auxTask->description}}</textarea>
    
        <label for="finished">Status:</label><br>
        <div class="status-container">
            @if ($auxTask->finished)
                <input type="radio" value="Open" name="finished" id="finishedOpen"> 
                <label for="finishedOpen">Open</label>
                <input type="radio" value="Closed" name="finished" id="finishedClosed" checked> 
                <label for="finishedClosed">Close</label>
            @else
                <input type="radio" value="Open" name="finished" id="finishedOpen" checked> 
                <label for="finishedOpen">Open</label>
                <input type="radio" value="Closed" name="finished" id="finishedClosed"> 
                <label for="finishedClosed">Close</label>
            @endif
        </div>
    
        <input type="submit" name="submit" id="submit" value="Update">
    </form>
</div>
```

- Captura:

<div align="center">
<img src="./img/tds-1.png"/>
<img src="./img/tds-2.png"/>
<img src="./img/tds-3.png"/>
<img src="./img/tds-4.png"/>
<img src="./img/tds-5.png"/>
</div>

</br>


#### To do list - Files

- Routes:

```code
Route::get('/', [FormController::class, 'getAllTasks']);
Route::get('/task', [FormController::class, 'getTask']);
Route::post('/task/create', [FormController::class, 'createTask']);
Route::post('/task/delete', [FormController::class, 'deleteTask']);
Route::post('/task/update', [FormController::class, 'updateForm']);
```

Esta es la única clase del modelo.

- Task:

```code
  /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $subject;

    /**
     * @var string
     */
    public $description;

    /**
     * @var bool
     */
    public $finished;

    /**
     * Task constructor.
     *
     * @param string $subject
     * @param string $description
     *
     *
     * */

     public function __construct(string $subject = "", int $id = 0, string $description = "", bool $finished = false){
        $this->subject = $subject;
        $this->id = $id;
        $this->description = $description;
        $this->finished = $finished;
    }

    // getters and setters
```

- Controller

```code
  /**
     * Read file
     */
    public function getAllTasks(){
        $filePath = storage_path('app/tasks.csv');

        if(!file_exists($filePath)){
            return redirect('/);
        }

        $tasks = [];


        if(($open = fopen($filePath, 'r') )!== false){
            while (($data = fgetcsv($open, 1000, ','))!== false) {
                if(count($data) == 4){
                    $tasks[] = new Task($data[0], 
                                        $data[1], 
                                        $data[2],
                                        $data[3] === 'Closed'? true : false);
            
                }                    
            }
            fclose($open);
            return view('startpage', compact('tasks'));
        }
    }
        
    /**
     * Get specific file 
     */

    public function getTask(Request $request){

        $id = $request->input('id');

        $filePath = storage_path('app/tasks.csv');

        if(!file_exists($filePath)){
            return redirect('/');
        }

        $auxTask = null;

        if(($open = fopen($filePath, 'r') )!== false){
            while (($data = fgetcsv($open, 1000, ','))!== false) {
                if($data[1] == $id){
                    $auxTask =  new Task(
                                $data[0], 
                                $data[1], 
                                $data[2],
                                $data[3] === 'Closed'? true : false);
                    break;
                }                    

            }

            fclose($open);
            return view('tasks', compact('auxTask'));
        }
    }

    /**
     * Create a new Task
     */

    public function createTask(Request $request){
            $filePath = storage_path('app/tasks.csv');

            $subject = $request->input('subject')??null;
            $id = $this->getIdFromCsv($filePath);
            $description=$request->input('description')??null;
            $finished = $request->input('finished') === 'Closed' ? true : false; 

            $newTask = new Task($subject, $id, $description, $finished);

            $open = fopen($filePath, 'a');
            if($open){
                fputcsv($open,[
                            $newTask->getSubject(),
                            $newTask->getId(),
                            $newTask->getDescription(),
                            $newTask->getFinished() ? 'Closed' : 'Open'
                        ]);
                fclose($open);
            }
    
        return redirect('/');
    }

    public function getIdFromCsv($filePath){
        if(file_exists($filePath)){
            $open = fopen($filePath, 'r');
            $id = 1;
            while (($data = fgetcsv($open, 1000, ','))!== false) {
                if(isset($data[1])){
                    $actualId = (int)$data[1];
                }
                $id = max($id, $actualId);
            }
            fclose($open);
            return $id+1;
        }
        
        return 1;
    }
    
    public function updateForm(Request $request){

        $filePath = storage_path('app/tasks.csv');

        if(!file_exists($filePath)){
            return redirect('/');
        }

        $subject = $request->input('subject');
        $id = $request->input('id');
        $description=$request->input('description');
        $finished = $request->input('finished') === 'Closed' ? true : false;

        $tasks = [];

        if(($open = fopen($filePath, 'r'))!== false){
            while (($data = fgetcsv($open, 1000, ','))!== false) {
                if($data[1] == $id){
                    $data[0] = $subject;
                    $data[2] = $description;
                    $data[3] = $finished ? 'Closed' : 'Open';
                }                    
                $tasks[] = $data;
            }
            fclose($open);
        }

        //var_dump($tasks);
        //die();

        if(($open = fopen($filePath, 'w'))!== false){
            foreach($tasks as $task){
                fputcsv($open, $task);
            }
            fclose($open);
        }

        return redirect('/');
    }


    /**
     * @param Request $request for get the id of the item to delete
     */
    public function deleteTask(Request $request){

        $filePath = storage_path('app/tasks.csv');

        if(!file_exists($filePath)){
            return redirect('/');
        }


        $id = $request->input('id');
        $tasks = [];

        if(($open = fopen($filePath, 'r'))!== false){
            while (($data = fgetcsv($open, 1000, ','))!== false) {
                if($data[1] != $id && count($data) >= 4){
                    $task =  new Task(
                                $data[0], 
                                (int)$data[1], 
                                $data[2],
                                $data[3] === 'Closed'? true : false
                            );
                    $tasks[] = $task;
                }                    
               
            }
            fclose($open);
        }


        if(($open = fopen($filePath, 'w'))!== false){
            foreach($tasks as $task){
                fputcsv($open,[
                    $task->getSubject(),
                    $task->getId(),
                    $task->getDescription(),
                    $task->getFinished() ? 'Closed' : 'Open'
                ]);     
            }
            fclose($open);
        }

        return redirect('/');

    }
```

- View (página principal):

```code
<div class="main-container">

    <h2>ALL TASKS</h2>
    <ul>
        @foreach ($todolist as $task)
            <li>
                <a href="./task?id={{$task->id}}">{{ $task->subject }}</a>
                <a href="./task?id={{$task->id}}">{{ $task->description }}</a>
                <a href="./task?id={{$task->id}}">{{ $task->finished ? 'Finished' : 'Not finished' }}</a>

                <form action="{{ url('task/delete') }}" method="POST" style="display:inline;">
                    @csrf
                    <input type="hidden" name="id" value="{{ $task->id }}">
                    <input type="submit" name="delete" id="delete" value="Delete">
                </form>
            </li>
        @endforeach
    </ul>     

    <form action="{{ url('task/create') }}" method="POST">
        @csrf
        <label for="subject">Task Subject:</label>
        <input type="text" name="subject" id="subject" placeholder="Task subject" />
        <br>
        <label for="description">Task Description:</label>
        <textarea cols="50" rows="5" name="description" id="description" placeholder="Task description"></textarea>
        <br>
        <label for="finished">Status:</label><br>
        <div class="status-container">
            <input type="radio" value="Open" name="finished" id="finishedOpen" checked> 
            <label for="finishedOpen">Open</label><br>
            <input type="radio" value="Closed" name="finished" id="finishedClosed"> 
            <label for="finishedClosed">Closed</label><br>
        </div>                
        <br>
        <input type="submit" name="create" value="Create">
    </form>
</div>   
```

- View (Task seleccionada):

```code
<div class="main-container">
    <h2>TASK TO UPDATE</h2>
    <form action="{{ url('task/update')}}" method="POST" id="formTasks">
        @csrf
        <label for="subject">Task ID: {{$auxTask->id}}</label>
        <br>
        <input type="hidden" name="id" value="{{ $auxTask->id }}">
        <input type="text" name="subject" id="subject" placeholder="Task subject" value="{{$auxTask->subject}}" />
        <textarea cols="200" rows="5" name="description" placeholder="Task description" id="description">{{$auxTask->description}}</textarea>
    
        <label for="finished">Status:</label><br>
        <div class="status-container">
            @if ($auxTask->finished)
                <input type="radio" value="Open" name="finished" id="finishedOpen"> 
                <label for="finishedOpen">Open</label>
                <input type="radio" value="Closed" name="finished" id="finishedClosed" checked> 
                <label for="finishedClosed">Close</label>
            @else
                <input type="radio" value="Open" name="finished" id="finishedOpen" checked> 
                <label for="finishedOpen">Open</label>
                <input type="radio" value="Closed" name="finished" id="finishedClosed"> 
                <label for="finishedClosed">Close</label>
            @endif
        </div>
    
        <input type="submit" name="submit" id="submit" value="Update">
    </form>
</div>
```

- Captura:

<div align="center">
<img src="./img/tdf-1.png"/>
<img src="./img/tdf-2.png"/>
<img src="./img/tdf-3.png"/>
<img src="./img/tdf-4.png"/>
<img src="./img/tdf-5.png"/>
</div>

</br>

#### BlackJack

- Routes:

```code
/**
 * Login
 */
Route::get('/', function (){
    return view('login');
});

Route::post('/login', [LoginController::class, 'createUser']);


/**
 * Game
 */

Route::get('/blackjack', function () {
    return view('blackjack');
});

Route::post('/start-game', [GameController::class, 'startGame']);

Route::post('/player-action', [GameController::class, 'getActions']);
```

Las clases del modelo son las siguientes:

- Card:

```code

    /**
    * @var string type of card (hearts, )
    */
    public $suit;

    /**
    * @var string
    */
    public $rank;

    /**
    * @var int
    */
    public $value;


    /**
    * Constructor of the class
    */
    public function __construct(string $suit, string $rank, int $value){
        $this->suit = $suit;
        $this->rank = $rank;
        $this->value = $value;
    }

    // getters and setters
```

- DeckCards:

```code

 /**
     * @var array
     */
    public $deckCards = [];

    public $currentIndexDeck = 0;

    public function __construct(){
        $this->deckCards = $this->initializeDeck();
        shuffle($this->deckCards);
    }

    /**
     * Function to create the deck cards
     */
    public function initializeDeck() {
        $suits = ['Hearts', 'Diamonds', 'Clubs', 'Spades'];
        $ranks = [
            '2' => 2, '3' => 3, '4' => 4, '5' => 5, '6' => 6, '7' => 7, '8' => 8, '9' => 9, '10' => 10,
            'J' => 10, 'Q' => 10, 'K' => 10, 'A' => 11
        ];

        foreach ($suits as $suit) {
            foreach ($ranks as $rank => $value) {
                $this->deckCards[] = new Card($suit, $rank, $value);
            }
        }
        return $this->deckCards;
    }

    /**
     * Function to draw a card from the deck and remove it from it
     */
    public function drawCard(){
        if ($this->currentIndexDeck >= count($this->deckCards)){
            return null;
        }

        $cardSelected = $this->deckCards[$this->currentIndexDeck];
        $this->currentIndexDeck++;
        return $cardSelected;
    }

    // getters and setters
```

- Game:

```code
    /**
     * @var DeckCards
     */
    public $deck;
    /**
     * @var Player
     */
    public $playerGame;

    /**
     * @var Player
     */

     public $dealer;

    const BLACKJACK = 21;
    const DEALER_STAND = 17;
    const HIT = 'hit';
    const STAND = 'stand';


    public function __construct($playerGame){
        $this->deck = new DeckCards();
        $this->dealer = new Player("Dealer");
        $this->playerGame = $playerGame;
    }

    public function initialDeal() {
        for ($i = 0; $i < 2; $i++) {
            $this->playerGame->addCard($this->deck->drawCard());
            $this->dealer->addCard($this->deck->drawCard());
        }
    }


    public function getActions($playerAction){
        if($playerAction == self::HIT){
            $card = $this->deck->drawCard();
            $this->playerGame->addCard($card);

            if($this->playerGame->getScore() > self::BLACKJACK){
                return $this->checkGameOver();
            }

        } elseif($playerAction == self::STAND){
            $this->playerGame->setIsStand(true);
        }

        $dealerAction = $this->dealerActions();

        if($dealerAction == self::HIT){
            $card = $this->deck->drawCard();
            $this->dealer->addCard($card);

        } elseif($dealerAction == self::STAND){
            $this->dealer->setIsStand(true);
            //dd($dealerAction);
        }

        if ($this->playerGame->getIsStand() && $this->dealer->getIsStand()) {
            return $this->checkGameOver();
        }
    }


    public function dealerActions(){
        $score = $this->dealer->getScore();

        if($score < 11){
            return self::HIT;
        }

        if($score >= 11 && $score <= self::DEALER_STAND){
            $probability = rand(1, 100);
            if($probability >= 70){
                return self::HIT;
            } else {
                return self::STAND;
            }
        }

        if($score == self::BLACKJACK){
            return self::STAND;
        }

        return self::STAND;
    }



    public function checkGameOver() {
        $playerScore = $this->playerGame->getScore();
        $dealerScore = $this->dealer->getScore();
        if ($playerScore > self::BLACKJACK) {
            $this->endGame();
            return false;
        }

        if ($dealerScore > self::BLACKJACK) {
            $this->endGame();
            return true;
        }

        if ($playerScore > $dealerScore) {
            $this->endGame();
            return true;
        } else {
            $this->endGame();
            return false;
        }
    }



    public function endGame(){
        $this->playerGame->setIsStand(false);
        $this->dealer->setIsStand(false);

        $this->deck = new DeckCards();
    }

    // getters and setters
```


- Player:

```code
    /**
     * @var string name of the player
     */
    public $playerName;
    /**
     * @var array of cards in the player's hand
     */
    public $hand;
    /**
     * @var int number of points of the player
     */
    public $score;

    /**
     * @var bool
     */
    public $isStand;


    const BLACKJACK = 21;
    const ACE_VALUE = 10;

    /**
     * Constructor of the class
     */
    public function __construct($playerName="") {
        $this->playerName = $playerName;
        $this->hand = [];
        $this->score = 0;
        $this->isStand = false;
    }


    /**
     * Add a card to the player's hand
     * @param  Card  $card  the card to be added
     **/

    public function addCard(Card $card) {
         $this->hand[] = $card;
         $this->score = $this->calculateScore();

    }

    /**
     * Function to calculate the score of the player
     */

    public function calculateScore() {
        $aceCounter = 0;
        $this->score = 0;

        foreach ($this->hand as $card) {
            $this->score += $card->getValue();
            if ($card->getRank() == 'A') {
                $aceCounter++;
            }
        }

        while($aceCounter > 0 && $this->score > self::BLACKJACK){
            $this->score = $this->score - self::ACE_VALUE;
            $aceCounter--;
        }

        return $this->score;
    }

    // getters and setters
```

- UserModel:

```code
    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $username;


    public function __construct (int $id=0, string $username=""){
        $this->id=$id;
        $this->username=$username;
    }

    // getters and setters
```



- LoginController:

```code
       public function createUser(Request $request){

        $filePath = storage_path('app/users.csv');
        $username = $request->input('username');

        $userExists = $this->getUserIfExists($username, $filePath);

        if($userExists !== null){
            session(['user' => $userExists]);

            if (session('player') === null) {
                session(['player' => new Player($username)]);
            }

            return redirect('/blackjack');
        }

        $id = $this->createId($filePath);

        $newUser = new UserModel();
        $newUser->setId($id);
        $newUser->setUsername($username);

        session(['user' => $newUser]);
        session(['player' => new Player($username)]);

        $open = fopen($filePath, 'a');
        if($open){
            fputcsv($open, [
                        $newUser->getId(),
                        $newUser->getUsername()
                    ]);
            fclose($open);
        }

        return redirect('/blackjack');
    }



   public function createId($filePath){
    if(file_exists($filePath)){
        $open = fopen($filePath, 'r');
        $id = 1;
        while (($data = fgetcsv($open, 1000, ','))!== false) {
            if(isset($data[0])){
                $actualId = (int)$data[0];
            }
            $id = max($id, $actualId);
        }
        fclose($open);
        return $id+1;
    }
    return 1;
   }

   public function getUserIfExists($username, $filePath){
        if(!file_exists($filePath)){
            return redirect('/');
        }

        $auxUser = null;

        if (($open = fopen($filePath, 'r')) !== false) {
            while (($data = fgetcsv($open, 1000, ',')) !== false) {
                if (isset($data[1]) && $data[1] == $username) {
                    $auxUser = new UserModel();
                    $auxUser->setId($data[0]);
                    $auxUser->setUsername($data[1]);
                    fclose($open);
                    return $auxUser;
                }
            }
        }

        return null;

    }
```


- GameController:

```code

    public  $game;

    // route /player-action
    public function getActions(Request $request){
       $game = session('game');
       $player = new Player();
       if (!$game) {
            $playerName = $request->input('playerName');
            $player->setPlayerName($playerName);
            $game = new Game($player);
            session(['game' => $game]);
        } else {
            $player = $game->getPlayerGame();
        }

        $action = $request->input('action');
        $result = $game->getActions($action);
        $dealer = $game->getDealer();

            if ($result === true){
                $message = $player->getPlayerName() . " wins!";
                session(['firstTry' => true]);
            } elseif ($result === false){
                $message = $dealer->getPlayerName() . " wins!";
                session(['firstTry' => true]);
            } else {
                $message = "";
                session(['firstTry' => false]);
            }

            session(['message' => $message]);


        $dealer = $game->getDealer();

        session(['game' => $game]);
        session(['player' => $player]);
        session(['dealer' => $dealer]);

        return redirect('/blackjack');
    }

    // route /start-game
    public function startGame(Request $request) {
        $playerName = $request->input('playerName');
        $player = new Player();
        $player->setPlayerName($playerName);
        $game = new Game($player);
        $dealer = $game->getDealer();
        $message = "";
        $game->initialDeal();
        $firstTry = false;

        session(['game' => $game]);
        session(['player' => $player]);
        session(['dealer' => $dealer]);
        session(['message' => $message]);
        session(['firstTry' => $firstTry]);


        return redirect('/blackjack');
    }
```


- View (login):

```code
<div class="main-container">
    <form action="{{ url('/login')}}" method="POST">
            @csrf
            <label for="username">Username</label>
            <input type="text" name="username" id="username" placeholder="Enter your username" />
            <br>
            <input type="submit" name="login" value="Login">
    </form>
</div>
```

- View (juego):

```code
    @php
        $user = session('user');
        $username = $user ? $user->getUsername(): 'Anonymous';

        $player = session('player');
        $playerName = $username;
        $hand = $player ? $player->getHand() : [];
        $score = $player ? $player->getScore() : 0;
        $isStand = $player ? $player->getIsStand() : false;

        $dealer = session('dealer');
        $dealerHand = $dealer ? $dealer->getHand() : [];
        $dealerScore = $dealer ? $dealer->getScore() : 0;
        $dealerIsStand = $dealer ? $dealer->getIsStand() : false;

        $firstTry = session('firstTry', false);
    @endphp

    <div class="main-container">
    <div class="player-name">
        <p>Player: {{$playerName}}</p>
    </div>

    @if($firstTry)
        <div class="action-container">
            <form action="{{ url('start-game') }}" method="POST">
                @csrf
                <input type="hidden" id="playerName" name="playerName" value="{{ $playerName }}"></input>
                <input type="submit" id="startBtn" value="Start Game">
            </form>
        </div>
    @endif

    <br></br>
    <div class="result">
        @if(session('message'))
            <div class="message">
                <b>{{ session('message') }}</b>
            </div>
            <p>Your score: {{ $score }}</p>
            <p>Dealer's score: {{ $dealerScore }}</p>
        @endif
    </div>

    <div class="players-container">
        <p>Your hand:</p>
        <ul>
            @foreach ($hand as $index => $card)
                <li>{{ $card->getRank() }} of {{ $card->getSuit() }}</li>
            @endforeach
        </ul>


        @if (session('dealer') !== null)
            <p>Dealer's hand:</p>
            <ul>
                @foreach ($dealerHand as $index => $card)
                    @if($index != 0 && !$dealerIsStand)
                        <li>??</li>
                    @else
                        <li>{{ $card->getRank() }} of {{ $card->getSuit() }}</li>
                    @endif
                @endforeach
            </ul>
        @endif

        <div class="action-container">
            <form action="{{ url('player-action') }}" method="POST">
                @csrf
                <input type="hidden" id="playerName" name="playerName" value="{{ $playerName }}"></input>
                <input type="submit" name="action" value="hit"
                    @if($player->getIsStand())
                        disabled
                    @endif
                ></input>
                <input type="submit" name="action" value="stand"></input>
            </form>
        </div>
    </div>
</div>
```

- Capturas:

<div align="center">
<img src="./img/bljk-1.png"/>
<img src="./img/bljk-2.png"/>
<img src="./img/bljk-3.png"/>
<img src="./img/bljk-4.png"/>
<img src="./img/bljk-5.png"/>
</div>

</br>

</div>