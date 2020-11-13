<?php

namespace App\Models;

use App\Models\Client;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\RsOrderStatus;
use Illuminate\Database\Eloquent\Model;

class RsOrder extends Model
{   
    use SoftDeletes;
    /**
     * table
     *
     * @var string 'Tabla en la DB'
     */
    protected $table = 'rs_orders';
    
    /**
     * fillable
     *
     * @var array 'Atributos para asignacion masiva'
     */
    protected $fillable = ['trace','status_id','cart'];

    public static $rules = [
        'clarification'       => 'nullable|string|max:2000',
        'products'            => 'required|array',
        'products.*.id'       => 'required|numeric|min:1',
        'products.*.quantity' => 'required|numeric|min:1',
        'products.*.name'     => 'required|string',
    ];

    public function status()
    {
        return $this->belongsTo(RsOrderStatus::class, 'status_id');
    }

    public function client()
    {
        return $this->belongsToMany(Client::class, 'client_has_rs_order', 'rs_order_id', 'client_id'); 
    }



}
