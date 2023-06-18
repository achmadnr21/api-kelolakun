<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Orders;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function show(string $id)
    {
        $orders = Orders::find($id);
        return response()->json([
            'status' => 'success',
            'data' => [
                'order' => $orders
            ]
        ]);
    }
}

