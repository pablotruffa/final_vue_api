<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Product;
use App\Models\RsOrder;
use Illuminate\Http\Request;
use App\Models\RsOrderStatus;
use Illuminate\Support\Facades\Validator;

class RsOrderController extends Controller
{   
    public function all()
    {
        //$orders = RsOrder::with('status')->whereNotIn('status_id', [4,5])->get();
        $orders = RsOrder::with('status')->get();
        foreach($orders as $order) {
            try {
                $order->cart = unserialize($order->cart);
            } catch (\Throwable $th) {
                throw $th;
            }
        }
        return response()->json([
            'status'=>'1',
            'orders' => $orders,
        ]);
    }

    public function getOrderByTrace($trace)
    {   
        try {
        $order = RsOrder::with('status')->where('trace',$trace)->get();
            if($order){
                $order->cart = unserialize($order->cart);
                return response()->json($order);
            }else{
                return false;
            }
        } catch (\Throwable $th) {
            return response()->json(['error'=>'Error al solicitar el pedido.']);
        }
    }

    public function clientOrders(Request $request,$id)
    {   
        $client = Client::findOrFail($id);
        if(!$client){
            return response()->json([
                'error'    => 'Sin resultados',
            ]);
        }
        $orders = RsORder::whereHas('client',function($q) use ($client){
            $q->where('client_id',$client->id);
        })
        ->with('status')
        ->get();

        if($orders){
            foreach($orders as $order) {
                $order->cart = unserialize($order->cart);
            }
        }

        return response()->json($orders);
       
    }

    public function create(Request $request)
    {   
        $validator = Validator::make($request->input(), RsOrder::$rules);
        if($validator->fails()) {
            return response()->json([
                'error'    => 'No pasa la validación',
                'erros'  => $validator->getMessageBag(),
            ]);
        }
        
        foreach($request->input('products') as $product) {
            $db_product = Product::findOrFail($product['id']);
            if($db_product->price != $product['price'] || $db_product->name != $product['name']) {
                return response()->json([
                    'status'    => 'denied',
                    'message'   => 'No se pudo registrar el pedido.'
                ]);
            }
        }
        try {
            $client_email = $request->input('client');
            $client = Client::where('email',$client_email)->first();
            if(!$client) {
                return response()->json([
                    'status'    => 'denied',
                    'message'   => 'No se pudo registrar el pedido.'
                ]); 
            }

            $data = [
                'trace'         => time(),
                'status_id'     => 1,
                'cart'          => serialize($request->input()),
                'visible'       => 1,
            ];
            $order = RsOrder::create($data);
            $order->client()->attach($client->id);
            
            $response = RsOrder::with('status')->find($order->id);
            $response->cart = unserialize($response->cart);
            return response()->json($response);
            
        } catch (\Throwable $th) {
            return response()->json([
                'status'    => 'denied',
                'message'   => 'No se pudo registrar el pedido.'
            ]);
        }
    }

    public function update(Request $request,$id)
    {
        try {
            $status = $request->input('status');
            
            $order  = RsOrder::with('status')->findOrFail($id);
            $status = RsOrderStatus::findOrFail($status); 

            $order->status_id = $status->id;
            $order->update();
            $order->load('status');
            $order->cart = unserialize($order->cart);
            return response()->json([
                'status'=> 'updated',
                'order' => $order
            ]);
        } catch (\Throwable $th) {
            return response()->json(['error'=>'No se pudo realizar la acción']);
        }
    }
    
    public function remove($id)
    {
        try {
            $order  = RsOrder::findOrFail($id);
            $order->cart = unserialize($order->cart);
            $order->delete();
            return response()->json([
                'order'     => $order,
                'status'    =>'removed',
            ]);
        } catch (\Throwable $th) {
            return response()->json(['error'=>'No se pudo realizar la acción']);
        }
    }
}
