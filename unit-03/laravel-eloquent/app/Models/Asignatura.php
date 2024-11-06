<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $nombre
 * @property string $curso
 * @property AsignaturaMatricula[] $asignaturaMatriculas
 */
class Asignatura extends Model
{
    public $timestamps = false;
    
    /**
     * @var array
     */
    protected $fillable = ['nombre', 'curso'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function asignaturaMatriculas()
    {
        return $this->hasMany('App\Models\AsignaturaMatricula', 'idasignatura');
    }
}
