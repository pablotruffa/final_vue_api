<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RsOrderStatus extends Model
{
    /**
     * table
     *
     * @var string 'Tabla en la DB'
     */
    protected $table = 'rs_order_status';
    
    /**
     * fillable
     *
     * @var array 'Atributos para asignacion masiva'
     */
    protected $fillable = ['name'];
}
