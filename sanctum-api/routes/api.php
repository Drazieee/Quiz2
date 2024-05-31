<?php
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('index', [AuthenticationController::class, 'index']);
Route::post('register', [AuthenticationController::class, 'register']);
Route::post('login', [AuthenticationController::class, 'login']);

Route::get('products', [ProductController::class, 'products']);
Route::get('showProduct/{id}', [ProductController::class, 'showProduct']);
Route::post('addProduct', [ProductController::class, 'addProduct']);
Route::get('filter/low', [ProductController::class, 'filterLowPrice']);
Route::get('filter/high', [ProductController::class, 'filterHighPrice']);
Route::put('editProduct/{id}', [ProductController::class, 'editProduct']);
Route::delete('removeProduct/{id}', [ProductController::class, 'removeProduct']);

Route::get('users', [UserController::class, 'users']);
Route::get('showUser/{id}', [UserController::class, 'showUser']);
Route::post('registerUser', [UserController::class, 'registerUser']);
Route::put('editUser/{id}', [UserController::class, 'editUser']);
Route::delete('removeUser/{id}', [UserController::class, 'removeUser']);

Route::get('cart/{id}', [CartController::class, 'cart']);
Route::post('addItemCart/{id}', [CartController::class, 'addItemCart']);

Route::patch('updateQuantityItem/{id}', [CartController::class, 'updateQuantityItem']);
Route::delete('removeItemCart/{id}', [CartController::class, 'removeItemCart']);

Route::get('orders', [OrderController::class, 'orders']);
Route::post('checkoutItem/{id}', [OrderController::class, 'checkoutItem']);
Route::patch('processOrder/{id}', [OrderController::class, 'processOrder']);
Route::delete('removeOrder/{id}', [OrderController::class, 'removeOrder']);
