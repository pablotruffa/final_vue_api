<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
{
    public function all()
    {   
        return response()->json(Client::withTrashed()->orderBy('room_number','ASC')->get());
    }

    public function create(Request $request) {
        try {
            $validator = Validator::make($request->input(), Client::$rules);
            if($validator->fails()) {
                return response()->json([
                    'error'    => 'No pasa la validación',
                    'erros'  => $validator->getMessageBag(),
                ]);
            }
            $data = $request->input();
            $data['password'] = Hash::make($data['password']);
            $client = Client::create($data);
            return response()->json([
                'client'=>$client,
                'status'=>'created',
                'data' => $data
            ]);
            
        } catch (\Throwable $th) {
            return response()->json([
                'error'    => 'Error al crear el cliente.',
            ]);
            
        }
     
    }

    public function edit(Request $request, $id) {
        //Validation
        try {
            $client = Client::findOrFail($id);
            $data = $request->input();
            $client->update($data);
            return response()->json([
                'client'=>$client,
                'status'=>'edited',
            ]);
                
            } catch (\Throwable $th) {
                return response()->json([
                'error'=>'El cliente no pudo ser editado.',
                ]);
            }
    }


        
    public function delete($id) {
        try {
            $client = Client::findOrFail($id);
            $client->delete();
            return response()->json([
                'client'=>$client,
                'status'=>'deleted',
            ]);

        } catch (\Throwable $th) {
            return response()->json([
                'error'=>'El cliente no pudo ser eliminado.',
            ]);
        }  
    }

    public function restore($id) {
        try {
            $client = Client::withTrashed()->findOrFail($id);
            $client->restore();
            return response()->json([
                'client'=>$client,
                'status'=>'restored',
            ]);

        } catch (\Throwable $th) {
            return response()->json([
                'error'=>'El cliente no pudo ser restaurado.',
            ]);
        }  
    }

    public function kill($id) {
        try {
            $client = Client::with('order')->withTrashed()->findOrFail($id);
            $traces = [];
            foreach($client->order as $order) {
                $traces[]=$order->trace;
                $client->order()->detach($order->id);
                $order->delete();

            }
            $kill = DB::table('clients')->where('id',$client->id)->delete();
            return response()->json([
                'status' => 'killed',
                'client' => $client,
                'notificationsToDelete' => $traces,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => 'Error al eliminar al cliente',
            ]);
        }
    }

}
