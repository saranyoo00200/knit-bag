<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// routes/api.php
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\ProductsController;
use App\Http\Controllers\api\UsersManageController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// Auth
// Route::post('/register', [AuthController::class, 'register']);
// Route::post('/login', [AuthController::class, 'login']);
// Route::get('/profile', [AuthController::class, 'profile'])->middleware('auth:sanctum');
// Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

// Users
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/users/index/list', [UsersManageController::class, 'index']);
    Route::post('/users/addUsers/create', [UsersManageController::class, 'create']);
    Route::get('/users/edit/{id}', [UsersManageController::class, 'edit']);
    Route::post('/users/update/{id}', [UsersManageController::class, 'update']);
    Route::get('/users/delete/{id}', [UsersManageController::class, 'destroy']);
});

// product
Route::get('/products/show', [ProductsController::class, 'show']);
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/products/index/list', [ProductsController::class, 'index']);
    Route::post('/products/addProduct/store', [ProductsController::class, 'store']);
    Route::get('/products/edit/{id}', [ProductsController::class, 'edit']);
    Route::post('/products/update/{id}', [ProductsController::class, 'update']);
    Route::get('/products/delete/{id}', [ProductsController::class, 'destroy']);
});
