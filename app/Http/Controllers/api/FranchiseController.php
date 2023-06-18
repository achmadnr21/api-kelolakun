<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Franchise;
use Illuminate\Http\Request;

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
}
