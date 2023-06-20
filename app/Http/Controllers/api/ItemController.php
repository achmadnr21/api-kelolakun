<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ItemController extends Controller
{
    
    public function index()
    {
        $item = Item::all();
        return response()->json([
            'status' => 'success',
            'data' => [
                'item' => $item
            ]
        ]);
    }

    public function show(string $id)
    {
        $item = Item::find($id);
        return response()->json([
            'status' => 'success',
            'data' => [
                'item' => $item
            ]
        ]);
    }

    public function store(Request $request){
        $dataItem = new Item;
        $rules = [
        ];
        $validator = Validator:: make($request->all(),$rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'fail',
                'data' => $validator->errors()
            ]);
        }
        
        // 'item_id',
        // 'name',
        // 'weight',
        // 'price',
        // 'category_id'

        // $dataItem->item_id = $request->item_id;
        $dataItem->name = $request->name;
        $dataItem->weight = $request->weight;
        $dataItem->price = $request->price;
        $dataItem->category_id = $request->category_id;

        $post = $dataItem->save();
        return response()->json([
            'status' => 'success',
            'data' => 'insert success!'
        ]);

    }

    public function update(Request $request, string $id)
    {
        $dataItem = Item::find($id);
        if (empty($dataItem)) {
            return response()->json([
                'status' => 'success',
                'data' => 'data not found'
            ], 404);
        }

        $rules = [
            'name' => 'sometimes|string',
            'weight' => 'sometimes|numeric',
            'price' => 'sometimes|numeric',
            'category_id' => 'sometimes|exists:categories,id'
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'fail',
                'data' => $validator->errors()
            ]);
        }

        $dataItem->fill($request->only(['name', 'weight', 'price', 'category_id']));
        $dataItem->save();

        return response()->json([
            'status' => 'success',
            'data' => 'update success!'
        ]);
    }



    public function destroy(string $id)
    {
         $dataItem = Item::find($id);
        if(empty($dataItem)){
            return response()->json([
                'status' => 'success',
                'data' => 'data not found'
            ], 404);
        }

        $post = $dataItem->delete();
        return response()->json([
            'status' => 'success',
            'data' => 'deletion success!'
        ]);   
    }
}
