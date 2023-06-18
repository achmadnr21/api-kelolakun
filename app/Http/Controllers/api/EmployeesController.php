<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Employees;
use Illuminate\Http\Request;

class EmployeesController extends Controller
{
    public function show(string $id)
    {
        $emp = Employees::find($id);
        return response()->json([
            'status' => 'success',
            'data' => [
                'employee' => $emp
            ]
        ]);
    }
}
