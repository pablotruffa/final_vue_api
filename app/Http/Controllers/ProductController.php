<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function all()
    {
        $products = Product::with('category')->get();
        foreach ($products as $product) {
           
            if($product->picture != null){
                $route = "food_pictures/$product->picture";
                if(file_exists($route)) {
                    $imageData = base64_encode(file_get_contents($route));
                    $src = 'data: '.mime_content_type($route).';base64,'.$imageData;
                    
                    $product->blob = $src;
                }
                
            } 
        
        }
        return response()->json($products);
    }


    public function create(Request $request)
    {   
        $request->validate(Product::$rules);
        $input = $request->input();
        if($request->picture)
        {
            $data = explode(',',$request->picture);
            $image = base64_decode($data[1]);
            $imageName = time().'.jpg';
            file_put_contents(public_path("/food_pictures/$imageName"),$image);

            $input['picture'] = $imageName;
        } else{
            $input['picture'] = null;
        }
        try {
            $product = Product::create($input);
            $product->load('category');
            return response()->json([
                'message'   => 'Producto creado.',
                'product'   => $product,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message'   => 'Error inesperado, reintente a la brevedad.',
                'error'     => $th->getMessage()
            ]);
        }
        
    }



    public function getPicture($id)
    {   
        try {
            $product = Product::findOrFail($id);
            if($product->picture != null){
                $route = "food_pictures/$product->picture";
                if(file_exists($route)) {
                    return file_get_contents($route);
                }
                
            }else{
                return false;
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
        
    }

    public function edit(Request $request, $id)
    {   
        $request->validate(Product::edit_rules($id));
        try {
            $product = Product::findOrFail($id);
            $input = $request->input();
            
            if($input['picture'] != null)
            {
                $data = explode(',',$request->picture);
                $image = base64_decode($data[1]);
                $imageName = time().'.jpg';
                file_put_contents(public_path("/food_pictures/$imageName"),$image);
                if($product->picture){
                    unlink(public_path("/food_pictures/$product->picture"));
                }
                
                $input['picture'] = $imageName;
            }else{
                //Si no actualiza la foto la misma persiste.
                $input['picture'] = $product->picture;
            }
                
            $product->update($input);
            $product->load('category');
            return response()->json([
                'message' => 'El producto fue editado',
                'status'  => 'edited',
                'product' => $product,
            ]);
            
        } catch (\Throwable $th) {
            
            return response()->json([
                'message' => 'El producto no pudo ser editado',
                'status'  => 'db',
                'payload' => $request->input(),
                'id'      =>$id,
                'error'   => $th->getMessage()
            ]);
        }
    }

    public function delete($id)
    {
        try {
            $product = Product::findOrFail($id);
            if($product->picture){
                unlink(public_path("/food_pictures/$product->picture"));
            }
            $product->delete();
            return response()->json([
                'message' => 'Producto eliminado',
                'status'  => 'deleted',
                'product' => $product,
            ]);
            
        } catch (\Throwable $th) {
                return response()->json([
                    'message' => 'El producto no pudo ser eliminado',
                    'status'  => 'db',
                ]);
            
        }
        

    }

}
