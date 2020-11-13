<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Level;
use App\Models\Client;
use App\Models\Product;
use App\Models\RsOrder;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\DB;

class TestingController extends Controller
{
    public function test()
    {   
        try {
            $id = 7;
            $client = Client::with('order')->withTrashed()->findOrFail($id);
            
            foreach($client->order as $order) {
                $client->order()->detach($order->id);
                $order->delete();
            }
            
            //$kill = DB::table('clients')->where('id',$client->id)->delete();
            return response()->json([
                'client' => $client,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'error'=>$th->getMessage()
            ]);
        }
    }
}
