<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WarehouseController extends Controller
{
    public function index()
    {
        $warehouse = Warehouse::all();
        return response()->json([
            'status' => 'success',
            'data' => [
                'warehouse' => $warehouse
            ]
        ]);
    }


    public function show(string $id)
    {
        $warehouse = Warehouse::find($id);
        return response()->json([
            'status' => 'success',
            'data' => [
                'warehouse' => $warehouse
            ]
        ]);
    }

    public function store(Request $request){
        $dataWarehouse = new Warehouse;
        $rules = [

        ];
        $validator = Validator:: make($request->all(),$rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'fail',
                'data' => $validator->errors()
            ]);
        }
        // 'warehouse_id',
        // 'geo_lat',
        // 'geo_lon',
        // 'email',
        // 'phone_number',
        // 'address'

        // $dataWarehouse->warehouse_id = $id;
        $dataWarehouse->geo_lat = $request->geo_lat;
        $dataWarehouse->geo_lon = $request->geo_lon;
        $dataWarehouse->email = $request->email;
        $dataWarehouse->phone_number = $request->phone_number;
        $dataWarehouse->address = $request->address;

        $post = $dataWarehouse->save();
        return response()->json([
            'status' => 'success',
            'data' => 'insert success!'
        ]);

    }

    public function update(Request $request, string $id)
    {
        $dataWarehouse = Warehouse::find($id);
        if (empty($dataWarehouse)) {
            return response()->json([
                'status' => 'success',
                'data' => 'data not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'geo_lat' => 'sometimes|numeric',
            'geo_lon' => 'sometimes|numeric',
            'email' => 'sometimes|email',
            'phone_number' => 'sometimes|string',
            'address' => 'sometimes|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'fail',
                'data' => $validator->errors()
            ]);
        }

        $dataWarehouse->fill($request->only(['geo_lat', 'geo_lon', 'email', 'phone_number', 'address']));
        $dataWarehouse->save();

        return response()->json([
            'status' => 'success',
            'data' => 'update success!'
        ]);
    }



    public function destroy(string $id)
    {
         $dataWarehouse = Warehouse::find($id);
        if(empty($dataWarehouse)){
            return response()->json([
                'status' => 'success',
                'data' => 'data not found'
            ], 404);
        }

        $post = $dataWarehouse->delete();
        return response()->json([
            'status' => 'success',
            'data' => 'deletion success!'
        ]);   
    }

    public function addItem(Request $request)
    {
        $warehouse_available = Warehouse::find($request->warehouse_id);
        if ($warehouse_available) {
            $query = DB::table('warehouse_package_details')->updateOrInsert(
                [
                    'package_id' => $request->package_id,
                    'warehouse_id' => $request->warehouse_id
                ],
                [
                    'qty' => $request->qty,
                    'modified_at' => now()
                ]
            );
        } else {
            $query = DB::table('warehouse_package_details')->insert([
                'package_id' => $request->package_id,
                'warehouse_id' => $request->warehouse_id,
                'qty' => $request->qty,
                'modified_at' => now()
            ]);
        }

        return response()->json([
            'status' => 'success',
            'data' => 'additem success!'
        ]);
    }

}
