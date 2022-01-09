<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () { return view('pages.index.index')->with('auth_user', auth()->user()); });
Route::get('/reviews', function () { return view('pages.index.review'); });
Route::get('/contact', function () { return view('pages.index.contact'); });


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/profile', [App\Http\Controllers\HomeController::class, 'profile'])->name('profile');
Route::get('/info/profile', [App\Http\Controllers\HomeController::class, 'info_profile'])->name('info_profile');
Route::get('/management/products', [App\Http\Controllers\HomeController::class, 'products'])->name('products');
Route::get('/management/users', [App\Http\Controllers\HomeController::class, 'users'])->name('users');
Route::get('/products/users/store', [App\Http\Controllers\HomeController::class, 'myProducts'])->name('myProducts');

// Route::get('/{any?}', function () {
//     return view('index');
// })->where('any', '.*');
