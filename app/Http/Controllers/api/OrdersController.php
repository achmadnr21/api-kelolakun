<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;


class OrdersController extends Controller
{


    public function index()
    {
        $orders = Orders::all();
        return response()->json([
            'status' => 'success',
            'data' => [
                'order' => $orders
            ]
        ]);
    }

    
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

    public function store(Request $request){
        $dataOrders = new Orders;
        $rules = [
            
        ];
        $validator = Validator:: make($request->all(),$rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'fail',
                'data' => $validator->errors()
            ]);
        }
        
        // 'order_id',
        // 'created_at',
        // 'modified_at',
        // 'status',
        // 'cost',
        // 'user_id'
        // $dataOrders->order_id = $request->order_id;
        $dataOrders->created_at = now();
        $dataOrders->modified_at = now();
        $dataOrders->status = $request->status;
        $dataOrders->cost = $request->cost;
        $dataOrders->user_id = $request->user_id;

        $post = $dataOrders->save();
        return response()->json([
            'status' => 'success',
            'data' => 'insert success!'
        ]);

    }

    public function update(Request $request, string $id)
    {
        $dataOrders = Orders::find($id);
        if (empty($dataOrders)) {
            return response()->json([
                'status' => 'success',
                'data' => 'data not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'status' => 'sometimes|string',
            'cost' => 'sometimes|numeric',
            'user_id' => 'sometimes|numeric'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'fail',
                'data' => $validator->errors()
            ]);
        }

        $dataOrders->fill($request->only(['status', 'cost', 'user_id']));
        $dataOrders->modified_at = now();
        $dataOrders->save();

        return response()->json([
            'status' => 'success',
            'data' => 'update success!'
        ]);
    }


    public function destroy(string $id)
    {
         $dataOrders = Orders::find($id);
        if(empty($dataOrders)){
            return response()->json([
                'status' => 'success',
                'data' => 'data not found'
            ], 404);
        }

        $post = $dataOrders->delete();
        return response()->json([
            'status' => 'success',
            'data' => 'deletion success!'
        ]);   
    }

    public function addItem(Request $request)
    {
        $warehouse_available = Orders::find($request->order_id);
        if ($warehouse_available) {
            $query = DB::table('order_details')->updateOrInsert(
                ['order_id' => $request->order_id, 'package_id' => $request->package_id],
                ['qty' => $request->qty]
            );
        } else {
            $query = DB::table('order_details')->insert([
                'order_id' => $request->order_id,
                'package_id' => $request->package_id,
                'qty' => $request->qty
            ]);
        }

        return response()->json([
            'status' => 'success',
            'data' => 'additem success!'
        ]);
    }

}

