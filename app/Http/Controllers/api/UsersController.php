<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{

    public function index()
    {
        $user = Users::all();
        return response()->json([
            'status' => 'success',
            'data' => [
                'user' => $user
            ]
        ]);
    }
    public function show(string $id)
    {
        $user = Users::find($id);
        return response()->json([
            'status' => 'success',
            'data' => [
                'user' => $user
            ]
        ]);
    }

    public function store(Request $request){
        $dataUser = new Users;
        $rules = [
            'name' => 'required',
            'username' => 'required',
            'password' => 'required',
            'franchise_id' => 'required'
        ];
        $validator = Validator:: make($request->all(),$rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'fail',
                'data' => $validator->errors()
            ]);
        }
        
        // 'user_id',
        // 'name',
        // 'username',
        // 'password',
        // 'franchise_id'

        // user_id pas insertion gaperlu diisi karena sudah ada auto_increment dari sisi database
        // menggunakan sequence
        // $dataUser->user_id = $request->user_id;
        $dataUser->name = $request->name;
        $dataUser->username = $request->username;
        $dataUser->password = bcrypt($request->password);
        $dataUser->franchise_id = $request->franchise_id;

        $post = $dataUser->save();
        return response()->json([
            'status' => 'success',
            'data' => 'insert success!'
        ]);

    }

    public function update(Request $request, string $id)
    {
        $dataUser = Users::find($id);
        if (empty($dataUser)) {
            return response()->json([
                'status' => 'success',
                'data' => 'data not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|string',
            'username' => 'sometimes|string',
            'password' => 'sometimes|string',
            'franchise_id' => 'sometimes|numeric'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'fail',
                'data' => $validator->errors()
            ]);
        }

        $dataUser->fill($request->only(['name', 'username', 'password', 'franchise_id']));
        $dataUser->save();

        return response()->json([
            'status' => 'success',
            'data' => 'update success!'
        ]);
    }


    public function destroy(string $id)
    {
         $dataUser = Users::find($id);
        if(empty($dataUser)){
            return response()->json([
                'status' => 'success',
                'data' => 'data not found'
            ], 404);
        }

        $post = $dataUser->delete();
        return response()->json([
            'status' => 'success',
            'data' => 'deletion success!'
        ]);   
    }
}
