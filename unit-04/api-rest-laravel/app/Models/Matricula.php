<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $dni
 * @property integer $year
 * @property Alumno $alumno
 * @property AsignaturaMatricula[] $asignaturaMatriculas
 */
class Matricula extends Model
{

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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function asignaturaMatriculas()
    {
        return $this->hasMany('App\Models\AsignaturaMatricula', 'idmatricula');
    }
}
