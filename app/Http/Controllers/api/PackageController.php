<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\Request;

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
            'total_weight' => 'required',
            'total_price' => 'required'
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

        $dataPackage->package_id = $request->package_id;
        $dataPackage->total_weight = $request->total_weight;
        $dataPackage->total_price = $request->total_price;

        $post = $dataPackage->save();
        return response()->json([
            'status' => 'success',
            'data' => 'insert success!'
        ]);

    }

    public function update(Request $request, string $id){
        $dataPackage = Package::find($id);
        if(empty($dataPackage)){
            return response()->json([
                'status' => 'success',
                'data' => 'data not found'
            ], 404);
        }
        $rules = [

        ];
        $validator = Validator:: make($request->all(),$rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'fail',
                'data' => $validator->errors()
            ]);
        }
        

        $dataPackage->package_id = $request->package_id;
        $dataPackage->total_weight = $request->total_weight;
        $dataPackage->total_price = $request->total_price;

        $post = $dataPackage->save();
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
}
