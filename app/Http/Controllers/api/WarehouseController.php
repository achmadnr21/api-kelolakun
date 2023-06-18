<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Warehouse;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    public function show(string $id)
    {
        $warehouse = Warehouse::find($id);
        return response()->json([
            'status' => 'success',
            'data' => [
                'warehouse' => $warehouse
            ]
        ]);
    }
}
