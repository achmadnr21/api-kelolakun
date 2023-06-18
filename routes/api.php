<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// FRANCHISE
Route::get('/franchise/{id}', [App\Http\Controllers\api\FranchiseController::class, 'show']);

// USER
Route::get('/user/{id}', [App\Http\Controllers\api\UsersController::class, 'show']);

// ORDER
Route::get('/order/{id}', [App\Http\Controllers\api\OrdersController::class, 'show']);

// EMPLOYEE
Route::get('/employee/{id}', [App\Http\Controllers\api\EmployeesController::class, 'show']);

// WAREHOUSE
Route::get('/warehouse/{id}', [App\Http\Controllers\api\WarehouseController::class, 'show']);

// CATEGORY
Route::get('/category/{id}', [App\Http\Controllers\api\CategoryController::class, 'show']);

// ITEM
Route::get('/item/{id}', [App\Http\Controllers\api\ItemController::class, 'show']);

// PACKAGE
Route::get('/package/{id}', [App\Http\Controllers\api\ItemController::class, 'show']);
