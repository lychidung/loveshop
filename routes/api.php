<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProductCategoriesController;
use App\Http\Controllers\ProductItemController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductGalleriesController;
use App\Http\Controllers\VoucherController;
use Database\Seeders\ProductGalleryTableSeeder;
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

//Route API đăng kí, đăng nhập User
Route::group(['middleware'=>'api'], function($routes){

    Route::post('/register',[UserController::class,'register']);
    Route::post('/login',[UserController::class,'login']);
    Route::post('/profile',[UserController::class,'profile']);
    Route::post('/refresh',[UserController::class,'refresh']);
    Route::post('/logout',[UserController::class,'logout']);
});


//Route API đăng kí, đăng nhập và các tác vụ cho Customer
Route::group(['middleware'=>'api'], function($routes){
    Route::post('/register',[CustomerController::class,'register']);
    Route::post('/login',[CustomerController::class,'login']);
    Route::post('/profile',[CustomerController::class,'profile']);
    Route::post('/refresh',[CustomerController::class,'refresh']);
    Route::post('/logout',[CustomerController::class,'logout']);
    Route::post('/updateProfile',[CustomerController::class,'updateProfile']);

});

Route::get('user/{id?}',[UserController::class, 'index']);

// Route cho Posts
Route::get('post/{id?}',[PostController::class, 'index']);
Route::post('post',[PostController::class, 'create']);
Route::put('post/{id}',[PostController::class, 'update']);
Route::delete('post/{id}',[PostController::class, 'delete']);

// Route cho Categories Product
Route::get('categories-product/{id?}', [ProductCategoriesController::class, 'index']);

// Route cho Product Items
Route::get('product-items/{id?}',[ProductItemController::class, 'index']);
Route::get('productItem-color/{id?}',[ProductItemController::class, 'product_color']);
Route::get('productItem-size/{id?}',[ProductItemController::class, 'productItems_size']);

// Route cho Product
Route::get('product/{id?}',[ProductController::class, 'index']);

// Route cho Product Galleries
Route::get('product-galleries/{id?}',[ProductGalleriesController::class, 'index']);


// Route cho Vouchers
Route::get('vouchers',[VoucherController::class, 'index']);
Route::get('vouchers-coming-soon',[VoucherController::class, 'voucherComingSoon']);
Route::post('vouchers-check',[VoucherController::class, 'checkVoucher']);

// Route cho Order
Route::post('order',[OrderController::class, 'index']);
Route::post('order-list',[OrderController::class, 'orderList']);
Route::post('order-details',[OrderController::class, 'orderDetails']);
Route::post('order-details-list',[OrderController::class, 'orderListDetails']);
