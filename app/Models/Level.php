<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{    
    /**
     * table
     *
     * @var string 'Tabla en la DB'
     */
    protected $table = 'levels';
    
    /**
     * fillable
     *
     * @var array 'Atributos para asignacion masiva'
     */
    protected $fillable = ['name'];
    
    
    /**
     * user Funcion que relaciona la tabla pivot entre user y level
     * 
     * @return void
     */
    public function user()
    {
        return $this->hasMany(User::class,'level_id');
    }
}   
