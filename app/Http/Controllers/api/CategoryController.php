<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index()
    {
        $category = Category::all();
        return response()->json([
            'status' => 'success',
            'data' => [
                'category' => $category
            ]
        ]);
    }
    public function show(string $id)
    {
        $category = Category::find($id);
        return response()->json([
            'status' => 'success',
            'data' => [
                'category' => $category
            ]
        ]);
    }

    public function store(Request $request){
        $dataCategory = new Category;
        $rules = [
            'name' => 'required',
        ];
        $validator = Validator:: make($request->all(),$rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'fail',
                'data' => $validator->errors()
            ]);
        }


        // 'category_id',
        // 'name'

        // $dataCategory->category_id = $request->category_id;
        $dataCategory->name = $request->name;

        $post = $dataCategory->save();
        return response()->json([
            'status' => 'success',
            'data' => 'insert success!'
        ]);

    }

    public function update(Request $request, string $id)
    {
        $dataCategory = Category::find($id);
        if (empty($dataCategory)) {
            return response()->json([
                'status' => 'success',
                'data' => 'data not found'
            ], 404);
        }

        $rules = [
            'name' => 'required|string',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'fail',
                'data' => $validator->errors()
            ]);
        }

        $dataCategory->fill($request->only(['name']));
        $dataCategory->save();

        return response()->json([
            'status' => 'success',
            'data' => 'update success!'
        ]);
    }



    public function destroy(string $id)
    {
         $dataCategory = Category::find($id);
        if(empty($dataCategory)){
            return response()->json([
                'status' => 'success',
                'data' => 'data not found'
            ], 404);
        }

        $post = $dataCategory->delete();
        return response()->json([
            'status' => 'success',
            'data' => 'deletion success!'
        ]);   
    }
}
