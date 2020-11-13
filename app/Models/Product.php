<?php

namespace App\Models;

use App\Models\ProductCategory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * table
     *
     * @var string 'Tabla en la DB'
     */
    protected $table = 'products';
    
    /**
     * fillable
     *
     * @var array 'Atributos para asignacion masiva'
     */
    protected $fillable = ['name','description','category_id','price','picture','sellable'];


    public static $rules = [
        'name'          =>'required|string|min:2|max:300|unique:products,name',
        'description'   =>'required|string|min:2|max:3000',
        'category_id'   =>'required|numeric|min:1',
        'price'         =>'required|numeric|between:0,50000000',
        'picture'       =>'nullable',
        'sellable'      =>'required|numeric|boolean',
    ];
    
    public static function edit_rules($id){
        return [
            'name'          =>'required|string|min:2|max:300|unique:products,name,'.$id,
            'description'   =>'required|string|min:2|max:3000',
            'category_id'   =>'required|numeric|min:1',
            'price'         =>'required|numeric|between:0,50000000',
            'picture'       =>'nullable',
            'sellable'      =>'required|numeric|boolean',
        ];
    }
        
    /**
     * category Relación entre productos y categorias
     *
     * @return void
     */
    public function category()
    {
        return $this->belongsTo(ProductCategory::class,'category_id');
    }




}
