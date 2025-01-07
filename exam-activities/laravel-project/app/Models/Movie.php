<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $titulo
 * @property string $year
 * @property string $descripcion
 * @property string $trailer
 * @property string $caratula
 * @property string $created_at
 * @property string $updated_at
 * @property ActoresPelicula[] $actoresPeliculas
 * @property DirectoresPelicula[] $directoresPeliculas
 * @property CategoriasPelicula[] $categoriasPeliculas
 */
class Movie extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'peliculas';

    /**
     * @var array
     */
    protected $fillable = ['titulo', 'year', 'descripcion', 'trailer', 'caratula', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function actoresPeliculas()
    {
        return $this->belongsToMany('App\Models\Actor', 'actores_peliculas', 'pelicula_id', 'actor_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function directoresPeliculas()
    {
        return $this->belongsToMany('App\Models\Director','directores_peliculas', 'pelicula_id', 'director_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function categoriasPeliculas()
    {
        return $this->belongsToMany('App\Models\Category', 'categorias_peliculas', 'pelicula_id', 'categoria_id');
    }
}
