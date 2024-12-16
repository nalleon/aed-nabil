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



    public function matriculas(){
        return $this->belongsToMany('App\Models\Matricula',
                                    'asignatura_matricula',
                                    'idasignatura',
                                    'idmatricula');
    }
}
