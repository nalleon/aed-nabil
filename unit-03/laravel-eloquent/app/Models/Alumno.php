<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $dni
 * @property string $nombre
 * @property string $apellidos
 * @property integer $fechanacimiento
 * @property Matricula[] $matriculas
 */
class Alumno extends Model
{
    public $timestamps = false;

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'dni';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var array
     */
    //protected $fillable = ['nombre', 'apellidos', 'fechanacimiento'];
    protected $guarded = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function matriculas(){
        
        return $this->hasMany('App\Models\Matricula', 'dni', 'dni');
    }

    protected $dates = ['fechanacimiento'];
    public function setFechaAttribute($dateValue) : void {
        $this->attributes['fechanacimiento'] = (new Carbon($dateValue))->format('Y-m-d H:i');
    }

    public function getFechaAttribute($dateValue) : string {
        return (new Carbon($dateValue))->format('Y-m-d H:i');
    }
}
