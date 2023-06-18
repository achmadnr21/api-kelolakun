<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

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
}
