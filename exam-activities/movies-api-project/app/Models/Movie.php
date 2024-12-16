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
 * @property Actor[] $actors
 * @property Categoria[] $categorias
 * @property Director[] $directors
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
    protected $fillable = ['titulo', 'year', 'descripcion', 'trailer', 'caratula'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function actors()
    {
        return $this->belongsToMany('App\Models\Actor', 'pelicula_actor');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categorias()
    {
        return $this->belongsToMany('App\Models\Categoria', 'pelicula_categoria');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function directors()
    {
        return $this->belongsToMany('App\Models\Director', 'pelicula_director');
    }
}
