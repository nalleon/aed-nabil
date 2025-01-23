<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
/**
* @OA\Info(
* title="Peliculas api",
* version="1.0.0",
* description="Esta es la documentación de la API generada automáticamente con Swagger",
* @OA\Contact(
* email="soporte@example.com"
* )
* )
*/
class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}
