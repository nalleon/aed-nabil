<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $nombre
 * @property string $apellidos
 * @property Pelicula[] $peliculas
 */
class Actor extends Model
{
    public $timestamps = false;
    
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'actor';

    /**
     * @var array
     */
    protected $fillable = ['nombre', 'apellidos'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function peliculas()
    {
        return $this->belongsToMany('App\Models\Pelicula', 'pelicula_actor');
    }
}
