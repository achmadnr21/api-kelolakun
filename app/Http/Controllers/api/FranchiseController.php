<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Franchise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class FranchiseController extends Controller
{

    public function index()
    {
        $franchise = Franchise::all();
        return response()->json([
            'status' => 'success',
            'data' => [
                'franchise' => $franchise
            ]
        ]);
    }
    public function show(string $id)
    {
        $franchise = Franchise::find($id);
        return response()->json([
            'status' => 'success',
            'data' => [
                'franchise' => $franchise
            ]
        ]);
    }
    public function store(Request $request){
        $dataFranchise = new Franchise;
        $rules = [
            'owner_name' => 'required',
            'owner_ktp' => 'required',
            'address' => 'required',
            'geo_lat' => 'required',
            'geo_lon' => 'required',
            'email' => 'required',
            'phone_number' => 'required'

        ];
        $validator = Validator:: make($request->all(),$rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'fail',
                'data' => $validator->errors()
            ]);
        }

        // $dataFranchise->franchise_id = $request->franchise_id;
        $dataFranchise->owner_name = $request->owner_name;
        $dataFranchise->owner_ktp = $request->owner_ktp;
        $dataFranchise->address = $request->address;
        $dataFranchise->geo_lat = $request->geo_lat;
        $dataFranchise->geo_lon = $request->geo_lon;
        $dataFranchise->email = $request->email;
        $dataFranchise->phone_number = $request->phone_number;

        $post = $dataFranchise->save();
        return response()->json([
            'status' => 'success',
            'data' => 'insert success!'
        ]);

    }

    public function update(Request $request, string $id)
    {
        $dataFranchise = Franchise::find($id);
        if (empty($dataFranchise)) {
            return response()->json([
                'status' => 'success',
                'data' => 'data not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'owner_name' => 'sometimes|string',
            'owner_ktp' => 'sometimes|string',
            'address' => 'sometimes|string',
            'geo_lat' => 'sometimes|string',
            'geo_lon' => 'sometimes|string',
            'email' => 'sometimes|email',
            'phone_number' => 'sometimes|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'fail',
                'data' => $validator->errors()
            ]);
        }

        $dataFranchise->fill($request->only([
            'owner_name', 'owner_ktp', 'address', 'geo_lat', 'geo_lon', 'email', 'phone_number'
        ]));
        $dataFranchise->save();

        return response()->json([
            'status' => 'success',
            'data' => 'update success!'
        ]);
    }



    public function destroy(string $id)
    {
         $dataFranchise = Franchise::find($id);
        if(empty($dataFranchise)){
            return response()->json([
                'status' => 'success',
                'data' => 'data not found'
            ], 404);
        }

        $post = $dataFranchise->delete();
        return response()->json([
            'status' => 'success',
            'data' => 'deletion success!'
        ]);   
    }
}
