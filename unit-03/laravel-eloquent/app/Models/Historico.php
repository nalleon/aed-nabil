<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $moneda_id
 * @property float $equivalenteeuro
 * @property string $fecha
 * @property Moneda $moneda
 */
class Historico extends Model
{
    public $timestamps = false;
    
    /**
     * @var array
     */
    protected $fillable = ['moneda_id', 'equivalenteeuro', 'fecha'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function moneda()
    {
        return $this->belongsTo('App\Models\Moneda');
    }
}
