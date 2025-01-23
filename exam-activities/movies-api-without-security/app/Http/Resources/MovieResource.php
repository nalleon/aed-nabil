<?php

namespace App\Http\Resources;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MovieResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $movie = Movie::find($this->id);

        $actors = $movie->actoresPeliculas;
        $categories = $movie->categoriasPeliculas;
        $directors = $movie->directoresPeliculas;

        return [
            'id' => $this->id,
            'titulo' => $this->titulo,
            'year' => $this->year,
            'directores' => $directors,
            'actores' => $actors,
            'categorias' => $categories,
            'descripcion' => $this->descripcion,
            'caratula' => $this->caratula,
            'trailer' => $this->trailer,
        ];
    }
}
