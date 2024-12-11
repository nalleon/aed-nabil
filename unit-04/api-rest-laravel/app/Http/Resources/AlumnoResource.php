<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AlumnoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        return parent::toArray($request);

        /*$alumno =parent::toArray($request);
        $id_alumno = $alumno['dni'];

        $nombre_completo = $alumno['nombre'] . ' ' . $alumno['apellidos'];
        $es_mayor_de_edad =  (time() - ($alumno['fechanacimiento']/1000))/((60*60*24)*365) >= 18;

        return [
            'id_alumno' => $id_alumno,
            'nombre_completo' => $nombre_completo,
            'es_mayor_de_edad' => $es_mayor_de_edad,
        ];*/
    }
}
