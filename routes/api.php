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
Route::get('/franchise', [App\Http\Controllers\api\FranchiseController::class, 'index']);
Route::get('/franchise/{id}', [App\Http\Controllers\api\FranchiseController::class, 'show']);

// USER
Route::get('/user', [App\Http\Controllers\api\UsersController::class, 'index']);
Route::get('/user/{id}', [App\Http\Controllers\api\UsersController::class, 'show']);

// ORDER
Route::get('/order', [App\Http\Controllers\api\OrdersController::class, 'index']);
Route::get('/order/{id}', [App\Http\Controllers\api\OrdersController::class, 'show']);

// EMPLOYEE
Route::get('/employee', [App\Http\Controllers\api\EmployeesController::class, 'index']);
Route::get('/employee/{id}', [App\Http\Controllers\api\EmployeesController::class, 'show']);

// WAREHOUSE
Route::get('/warehouse', [App\Http\Controllers\api\WarehouseController::class, 'index']);
Route::get('/warehouse/{id}', [App\Http\Controllers\api\WarehouseController::class, 'show']);

// CATEGORY
Route::get('/category', [App\Http\Controllers\api\CategoryController::class, 'index']);
Route::get('/category/{id}', [App\Http\Controllers\api\CategoryController::class, 'show']);

// ITEM
Route::get('/item', [App\Http\Controllers\api\ItemController::class, 'index']);
Route::get('/item/{id}', [App\Http\Controllers\api\ItemController::class, 'show']);

// PACKAGE
Route::get('/package', [App\Http\Controllers\api\ItemController::class, 'index']);
Route::get('/package/{id}', [App\Http\Controllers\api\ItemController::class, 'show']);
