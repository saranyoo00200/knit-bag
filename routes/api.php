<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// routes/api.php
use App\Http\Controllers\api\UsersManageController;
use App\Http\Controllers\api\UsersProductsController;
use App\Http\Controllers\api\ApprovalManageController;
use App\Http\Controllers\api\ProductsController;
use App\Http\Controllers\api\ProfileController;
use App\Http\Controllers\api\AuthController;

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

// Auth
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/profile', [AuthController::class, 'profile'])->middleware('auth:sanctum');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

// Profile
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/profile/update/{id}', [ProfileController::class, 'update']);
    Route::post('/profile/checkPasswprd/{id}', [ProfileController::class, 'checkPasswprd']);
    Route::post('/profile/changePasswprd/{id}', [ProfileController::class, 'changePasswprd']);
});

// Users
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/users/index/list', [UsersManageController::class, 'index']);
    Route::post('/users/addUsers/create', [UsersManageController::class, 'create']);
    Route::get('/users/edit/{id}', [UsersManageController::class, 'edit']);
    Route::post('/users/update/{id}', [UsersManageController::class, 'update']);
    Route::get('/users/delete/{id}', [UsersManageController::class, 'destroy']);
});

// UsersProducts
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/users/product/{id}/index', [UsersProductsController::class, 'index']);
    Route::post('/users/addProduct/create', [UsersProductsController::class, 'create']);
    Route::get('/users/product/{id}/delete', [UsersProductsController::class, 'destroy']);
    Route::post('/users/product/{id}/plus', [UsersProductsController::class, 'plus']);
    Route::post('/users/product/{id}/minus', [UsersProductsController::class, 'minus']);
    Route::post('/users/products/{id}/order-approve', [UsersProductsController::class, 'orderApprove']);
    // Route::post('/users/products/{id}/order', [UsersProductsController::class, 'order']);
});

// Approval
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/order/approval/index', [ApprovalManageController::class, 'index']);
    // Route::post('/users/addProduct/create', [ApprovalManageController::class, 'create']);
    // Route::get('/users/product/{id}/delete', [ApprovalManageController::class, 'destroy']);
    // Route::post('/users/product/{id}/plus', [ApprovalManageController::class, 'plus']);
    // Route::post('/users/product/{id}/minus', [ApprovalManageController::class, 'minus']);
    // Route::post('/users/products/{id}/order-approve', [ApprovalManageController::class, 'orderApprove']);
});

// product
Route::get('/products/show', [ProductsController::class, 'show']);
Route::get('/get/products/info/product/{id}', [ProductsController::class, 'getClick']);
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/products/index/list', [ProductsController::class, 'index']);
    Route::post('/products/addProduct/store', [ProductsController::class, 'store']);
    Route::get('/products/edit/{id}', [ProductsController::class, 'edit']);
    Route::post('/products/update/{id}', [ProductsController::class, 'update']);
    Route::get('/products/delete/{id}', [ProductsController::class, 'destroy']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
