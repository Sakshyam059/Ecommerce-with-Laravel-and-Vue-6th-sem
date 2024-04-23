<?php

use App\Http\Controllers\Product\CartController;
use App\Http\Controllers\Product\ProductController;
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

Route::get('/products',[ProductController::class,'viewProduct'])->name('product.get');
Route::get('/products/search/{keyword}',[ProductController::class,'searchProduct'])->name('product.search');

Route::get('/cart/products',[CartController::class,'cartProducts'])->name('testcart');

// Route::get('/product/{id}',[ProductController::class,'findProduct'])->name('product.find');
