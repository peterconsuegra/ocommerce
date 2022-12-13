<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HelloController;  
use App\Http\Controllers\WooDashboard;  
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('list_users', [HelloController::class,'list_users']);
Route::get('list_orders', [HelloController::class,'list_orders']);
Route::get('list_posts', [HelloController::class,'list_posts']);
Route::get('list_products', [HelloController::class,'list_products']);
Route::get('edit_posts', [HelloController::class, 'edit_posts']);
Route::get('edit_post', [HelloController::class, 'edit_post']);



Route::post('update_post', [HelloController::class, 'update_post']);
Route::get('/wordpress_plus_laravel_examples', [HelloController::class, 'wordpress_plus_laravel_examples']);


Route::get('orders', [WooDashboard::class, 'orders']);
