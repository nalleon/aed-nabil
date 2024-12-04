<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $created_at
 * @property string $updated_at
 * @property string $asunto
 * @property boolean $terminada
 */
class Task extends Model
{
    public $timestamps = false;
    
    /**
     * @var array
     */
    protected $fillable = ['created_at', 'updated_at', 'asunto', 'terminada'];
}
