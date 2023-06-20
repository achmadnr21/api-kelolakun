<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
class PackageController extends Controller
{
    public function index()
    {
        $package = Package::all();
        return response()->json([
            'status' => 'success',
            'data' => [
                'package' => $package
            ]
        ]);
    }

    public function show(string $id)
    {
        $package = Package::find($id);
        return response()->json([
            'status' => 'success',
            'data' => [
                'package' => $package
            ]
        ]);
    }

    public function store(Request $request){
        $dataPackage = new Package;
        $rules = [
            'name' => 'required'
        ];
        $validator = Validator:: make($request->all(),$rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'fail',
                'data' => $validator->errors()
            ]);
        }
        
        // 'package_id',
        // 'total_weight',
        // 'total_price'

        // $dataPackage->package_id = $request->package_id;
        $dataPackage->name = $request->name;
        $dataPackage->total_weight = $request->total_weight;
        $dataPackage->total_price = $request->total_price;

        $post = $dataPackage->save();
        return response()->json([
            'status' => 'success',
            'data' => 'insert success!'
        ]);

    }

    public function update(Request $request, string $id)
    {
        $dataPackage = Package::find($id);
        if (empty($dataPackage)) {
            return response()->json([
                'status' => 'success',
                'data' => 'data not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|string',
            'total_weight' => 'sometimes|numeric',
            'total_price' => 'sometimes|numeric'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'fail',
                'data' => $validator->errors()
            ]);
        }

        $dataPackage->fill($request->only(['total_weight', 'total_price']));
        $dataPackage->save();

        return response()->json([
            'status' => 'success',
            'data' => 'update success!'
        ]);
    }



    public function destroy(string $id)
    {
         $dataPackage = Package::find($id);
        if(empty($dataPackage)){
            return response()->json([
                'status' => 'success',
                'data' => 'data not found'
            ], 404);
        }

        $post = $dataPackage->delete();
        return response()->json([
            'status' => 'success',
            'data' => 'deletion success!'
        ]);   
    }

    public function addItem(Request $request)
    {
        $warehouse_available = Package::find($request->package_id);
        if ($warehouse_available) {
            $query = DB::table('package_item_details')->updateOrInsert(
                ['package_id' => $request->package_id, 'item_id' => $request->item_id],
                ['qty' => $request->qty]
            );
            return response()->json([
                'status' => 'success',
                'data' => 'additem success!'
            ]);
        } else {
            $query = DB::table('package_item_details')->insert([
                'package_id' => $request->package_id,
                'item_id' => $request->item_id,
                'qty' => $request->qty
            ]);
            return response()->json([
                'status' => 'success',
                'data' => 'additem success!'
            ]);
        }
    }

}
