<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    /**
     * table
     *
     * @var string 'Tabla en la DB'
     */
    protected $table = 'product_categories';
    
    /**
     * fillable
     *
     * @var array 'Atributos para asignacion masiva'
     */
    protected $fillable = ['name',];

    public function product()
    {
        return $this->hasMany(Product::class,'category_id');
    }
}
