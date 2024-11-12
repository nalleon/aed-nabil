<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $nombre
 * @property integer $edad
 */
class Persona extends Model
{
    protected $table = "personas";
    public $timestamps = false;
    /**
     * @var array
     */
    protected $fillable = ['id','nombre', 'edad'];
}
