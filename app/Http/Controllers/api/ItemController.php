<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\Request;

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
}
