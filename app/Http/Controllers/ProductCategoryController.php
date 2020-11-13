<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductCategory;

class ProductCategoryController extends Controller
{
    public function all()
    {
        $categories = ProductCategory::all();
        return response()->json($categories);
    }
}
