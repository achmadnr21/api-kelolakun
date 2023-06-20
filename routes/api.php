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


/*
========== INFORMASI ==========
employees:superadmin can insert employees:admin, employees:shipper, franchise, users.

employees:superadmin can update franchise. The franchise owner have to request into the
            company to change their data

users can insert users

*/


// login
// Route::post('/employee/register', [\App\Http\Controllers\api\AuthController::class, 'employee_register']);
// Route::post('/user/register', [\App\Http\Controllers\api\AuthController::class, 'user_register']);

Route::post('/employee/login', [\App\Http\Controllers\api\AuthController::class, 'employee_login']);
Route::post('/user/login', [\App\Http\Controllers\api\AuthController::class, 'user_login']);

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [\App\Http\Controllers\api\AuthController::class, 'logout']);
    // Route::post('/employee/logout', [\App\Http\Controllers\api\AuthController::class, 'employee_logout']);
    // Route::post('/user/logout', [\App\Http\Controllers\api\AuthController::class, 'user_logout']);
});

// FRANCHISE :: DONE
Route::get('/franchise/index', [App\Http\Controllers\api\FranchiseController::class, 'index']);
Route::get('/franchise/select/{id}', [App\Http\Controllers\api\FranchiseController::class, 'show']);
Route::post('/franchise/insert', [App\Http\Controllers\api\FranchiseController::class, 'store']);
Route::put('/franchise/update/{id}', [App\Http\Controllers\api\FranchiseController::class, 'update']);
Route::delete('/franchise/delete/{id}', [App\Http\Controllers\api\FranchiseController::class, 'destroy']);


// USER
Route::get('/user/index', [App\Http\Controllers\api\UsersController::class, 'index']);
Route::get('/user/select/{id}', [App\Http\Controllers\api\UsersController::class, 'show']);
Route::post('/user/insert', [App\Http\Controllers\api\UsersController::class, 'store']);
Route::put('/user/update/{id}', [App\Http\Controllers\api\UsersController::class, 'update']);
Route::delete('/user/delete/{id}', [App\Http\Controllers\api\UsersController::class, 'destroy']);

// ORDER
Route::get('/order/index', [App\Http\Controllers\api\OrdersController::class, 'index']);
Route::get('/order/select/{id}', [App\Http\Controllers\api\OrdersController::class, 'show']);
Route::post('/order/insert', [App\Http\Controllers\api\OrdersController::class, 'store']);
Route::put('/order/update/{id}', [App\Http\Controllers\api\OrdersController::class, 'update']);
Route::delete('/order/delete/{id}', [App\Http\Controllers\api\OrdersController::class, 'destroy']);
Route::post('/order/additem', [App\Http\Controllers\api\OrdersController::class, 'addItem']);

// EMPLOYEE
Route::get('/employee/index', [App\Http\Controllers\api\EmployeesController::class, 'index']);
Route::get('/employee/select/{id}', [App\Http\Controllers\api\EmployeesController::class, 'show']);
Route::post('/employee/insert', [App\Http\Controllers\api\EmployeesController::class, 'store']);
Route::put('/employee/update/{id}', [App\Http\Controllers\api\EmployeesController::class, 'update']);
Route::delete('/employee/delete/{id}', [App\Http\Controllers\api\EmployeesController::class, 'destroy']);

// WAREHOUSE
Route::get('/warehouse/index', [App\Http\Controllers\api\WarehouseController::class, 'index']);
Route::get('/warehouse/select/{id}', [App\Http\Controllers\api\WarehouseController::class, 'show']);
Route::post('/warehouse/insert', [App\Http\Controllers\api\WarehouseController::class, 'store']);
Route::put('/warehouse/update/{id}', [App\Http\Controllers\api\WarehouseController::class, 'update']);
Route::delete('/warehouse/delete/{id}', [App\Http\Controllers\api\WarehouseController::class, 'destroy']);
Route::post('/warehouse/additem', [App\Http\Controllers\api\WarehouseController::class, 'addItem']);

// CATEGORY
Route::get('/category/index', [App\Http\Controllers\api\CategoryController::class, 'index']);
Route::get('/category/select/{id}', [App\Http\Controllers\api\CategoryController::class, 'show']);
Route::post('/category/insert', [App\Http\Controllers\api\CategoryController::class, 'store']);
Route::put('/category/update/{id}', [App\Http\Controllers\api\CategoryController::class, 'update']);
Route::delete('/category/delete/{id}', [App\Http\Controllers\api\CategoryController::class, 'destroy']);

// ITEM
Route::get('/item/index', [App\Http\Controllers\api\ItemController::class, 'index']);
Route::get('/item/select/{id}', [App\Http\Controllers\api\ItemController::class, 'show']);
Route::post('/item/insert', [App\Http\Controllers\api\ItemController::class, 'store']);
Route::put('/item/update/{id}', [App\Http\Controllers\api\ItemController::class, 'update']);
Route::delete('/item/delete/{id}', [App\Http\Controllers\api\ItemController::class, 'destroy']);

// PACKAGE
Route::get('/package/index', [App\Http\Controllers\api\PackageController::class, 'index']);
Route::get('/package/select/{id}', [App\Http\Controllers\api\PackageController::class, 'show']);
Route::post('/package/insert/', [App\Http\Controllers\api\PackageController::class, 'store']);
Route::put('/package/update/{id}', [App\Http\Controllers\api\PackageController::class, 'update']);
Route::delete('/package/delete/{id}', [App\Http\Controllers\api\PackageController::class, 'destroy']);
Route::post('/package/additem', [App\Http\Controllers\api\PackageController::class, 'addItem']);
