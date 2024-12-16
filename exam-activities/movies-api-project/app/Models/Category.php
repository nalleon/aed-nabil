<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $nombre
 * @property Pelicula[] $peliculas
 */
class Category extends Model
{
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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function peliculas()
    {
        return $this->belongsToMany('App\Models\Pelicula', 'pelicula_categoria');
    }
}
