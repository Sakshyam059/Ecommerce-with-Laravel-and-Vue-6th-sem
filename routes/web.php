<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Homepage\HomeController;
use App\Http\Controllers\Order\OrderController;
use App\Http\Controllers\Payment\PaymentController;
use App\Http\Controllers\Product\CartController;
use App\Http\Controllers\Product\CategoryController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Product\ReviewController;
use App\Http\Controllers\Product\SalesController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class,'index'])->name('welcome');
Route::get('/home', [HomeController::class,'home'])->name('home');
Route::get('/about', [HomeController::class,'about'])->name('about');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/upload/image', [ProfileController::class, 'uploadImage'])->name('profile.image.upload');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/product/payment',[PaymentController::class,'index'])->name('product.pay');
    Route::post('/payment-verify',[PaymentController::class,'khaltiPayment'])->name('khalti.pay');
    Route::get('/epayment/verify', [PaymentController::class,'verifyPayment']);
    Route::get('/payment/success', [PaymentController::class,'success'])->name('pay.success');

    Route::get('/myorders', [OrderController::class,'index'])->name('orders.index');

    Route::post('/addreview',[ReviewController::class,'addReview'])->name('review.add');
    Route::delete('/review/{id}/delete',[ReviewController::class,'deleteReview'])->name('review.delete');
});


Route::get('/products',[ProductController::class,'index'])->name('product.index');

Route::get('/product/about/{id}',[ProductController::class,'aboutProduct'])->name('product.about');

Route::get('/product/search={keyword}',[ProductController::class,'searchResult'])->name('search.result');

Route::get('/category/{name}',[CategoryController::class,'category'])->name('category.product');
Route::get('/sales',[SalesController::class,'index'])->name('sales.index');


Route::prefix('admin')->middleware('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class,'dashboard'])->name('dashboard');
    Route::get('/products',[AdminController::class,'myProduct'])->name('myproducts');
    Route::get('/addproduct',[AdminController::class,'addProduct'])->name('add.product');
    Route::post('/storeproduct',[AdminController::class,'storeProduct'])->name('product.store');

    Route::get('/categories',[AdminController::class,'categories'])->name('categories');
    Route::post('/add/categories',[AdminController::class,'addCategory'])->name('category.add');
    Route::get('/categories/{id}/edit',[AdminController::class,'editCategory'])->name('category.edit');
    Route::post('/categories/{id}/update',[AdminController::class,'updateCategory'])->name('category.update');
    Route::delete('/category/{id}/delete',[AdminController::class,'deleteCategory'])->name('category.delete');
    
    Route::get('/product/edit/{id}',[AdminController::class,'editProduct'])->name('edit.product');
    Route::post('/product/update',[AdminController::class,'updateProduct'])->name('product.update');
    
    Route::delete('/product/{id}/delete',[AdminController::class,'deleteProduct'])->name('product.delete');
    
    Route::get('/sales',[AdminController::class,'salesAdmin'])->name('sales.admin');
    Route::get('/sales/manage',[SalesController::class,'viewSaleForm'])->name('sales.form');
    Route::post('/sales/add',[SalesController::class,'addSales'])->name('sales.add');
    Route::delete('/sales/{id}/delete',[SalesController::class,'deleteSale'])->name('sales.delete');
    
    Route::get('/orders', [AdminController::class,'orders'])->name('orders.admin');

    
   
});

Route::get('/mycart',[CartController::class,'myCart'])->name('mycart');
Route::get('/testcart',[CartController::class,'testcart'])->name('cart.add');

require __DIR__.'/auth.php';
