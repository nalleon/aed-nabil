<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $nombre
 * @property CategoriasPelicula[] $categoriasPeliculas
 */
class Category extends Model
{
    
    /**
     * Disable timestamps
     */
    public $timestamps = false;

    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'categorias';

    /**
     * @var array
     */
    protected $fillable = ['nombre'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function categoriasPeliculas()
    {
        return $this->belongsToMany('App\Models\Movie', 'categorias_peliculas', 'categoria_id', 'pelicula_id');

    }
}
