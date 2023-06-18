<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Users;
use Illuminate\Http\Request;

class UsersController extends Controller
{
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
}
