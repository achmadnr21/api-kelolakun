<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function show(string $id)
    {
        $package = Package::find($id);
        return response()->json([
            'status' => 'success',
            'data' => [
                'package' => $package
            ]
        ]);
    }
}
