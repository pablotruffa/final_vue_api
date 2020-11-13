<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RsOrderStatus;

class OrderStatusController extends Controller
{
    public function all()
    {
        $rs_order_status = RsOrderStatus::all();
        return response()->json($rs_order_status);
    }
}
