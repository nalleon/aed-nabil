<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $pais
 * @property string $nombre
 * @property Historico[] $historicos
 */
class Moneda extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['pais', 'nombre'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function historicos()
    {
        return $this->hasMany('App\Models\Historico');
    }
}
