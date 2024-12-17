<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $nombre
 * @property string $apellidos
 * @property DirectoresPelicula[] $directoresPeliculas
 */
class Director extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'directores';

    /**
     * @var array
     */
    protected $fillable = ['nombre', 'apellidos'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function directoresPeliculas()
    {
        return $this->hasMany('App\Models\DirectoresPelicula', 'director_id');
    }
}
