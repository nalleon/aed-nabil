<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $dni
 * @property integer $year
 * @property AsignaturaMatricula[] $asignaturaMatriculas
 * @property Alumno $alumno
 */
class Matricula extends Model {
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['dni', 'year'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function alumno()
    {
        return $this->belongsTo('App\Models\Alumno', 'dni', 'dni');
    }

    public function matriculas(){
        return $this->belongsToMany('App\Models\Asignatura',
                                    'asignatura_matricula',
                                    'idasignatura',
                                    'idmatricula');
    }

    public function asignaturas()
    {
        return $this->belongsToMany(
            'App\Models\Asignatura',
            'asignatura_matricula',  
            'idmatricula',          
            'asignatura' 
        );
    }
    
}
