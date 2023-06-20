<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Employees;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmployeesController extends Controller
{

    public function index()
    {
        $dataEmployee = Employees::all();
        return response()->json([
            'status' => 'success',
            'data' => [
                'employee' => $dataEmployee
            ]
        ]);
    }


    public function show(string $id)
    {
        $dataEmployee = Employees::find($id);
        return response()->json([
            'status' => 'success',
            'data' => [
                'employee' => $dataEmployee
            ]
        ]);
    }

    public function store(Request $request){
        $dataEmployee = new Employees;
        $rules = [
            
        ];
        $validator = Validator:: make($request->all(),$rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'fail',
                'data' => $validator->errors()
            ]);
        }
        
        // 'employee_id',
        // 'warehouse_id',
        // 'name',
        // 'username',
        // 'password',
        // 'role'

        // $dataEmployee->employee_id = $request->employee_id;
        $dataEmployee->warehouse_id = $request->warehouse_id;
        $dataEmployee->name = $request->name;
        $dataEmployee->username = $request->username;
        $dataEmployee->password = $request->password;
        $dataEmployee->role = $request->role;
        $post = $dataEmployee->save();
        return response()->json([
            'status' => 'success',
            'data' => 'insert success!'
        ]);

    }

    public function update(Request $request, string $id)
    {
        $dataEmployee = Employees::find($id);
        if (empty($dataEmployee)) {
            return response()->json([
                'status' => 'success',
                'data' => 'data not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'warehouse_id' => 'sometimes|numeric',
            'name' => 'sometimes|string',
            'username' => 'sometimes|string',
            'password' => 'sometimes|string',
            'role' => 'sometimes|string',
            'email' => 'sometimes|email',
            'phone_number' => 'sometimes|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'fail',
                'data' => $validator->errors()
            ]);
        }

        $dataEmployee->fill($request->only(['warehouse_id', 'name', 'username', 'password', 'role', 'email', 'phone_number']));
        $dataEmployee->password = bcrypt($request->password);
        $dataEmployee->save();

        return response()->json([
            'status' => 'success',
            'data' => 'update success!'
        ]);
    }



    public function destroy(string $id)
    {
         $dataEmployee = Employees::find($id);
        if(empty($dataEmployee)){
            return response()->json([
                'status' => 'success',
                'data' => 'data not found'
            ], 404);
        }

        $post = $dataEmployee->delete();
        return response()->json([
            'status' => 'success',
            'data' => 'deletion success!'
        ]);   
    }
}
