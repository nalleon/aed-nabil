<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $nombre
 * @property string $apellidos
 * @property ActoresPelicula[] $actoresPeliculas
 */
class Actor extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'actores';

    /**
     * @var array
     */
    protected $fillable = ['nombre', 'apellidos'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function actoresPeliculas()
    {
        return $this->hasMany('App\Models\ActoresPelicula', 'actor_id');
    }
}
