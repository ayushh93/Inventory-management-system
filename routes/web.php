<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
use App\Http\Controllers\admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\admin\CouponController;
use App\Http\Controllers\admin\CustomerController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\admin\ProductAttributeController as AdminProductAttributeController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\ProductAttributeController;
use App\Models\ProductAttribute;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'prevent-back-history'])->name('dashboard');


require __DIR__ . '/auth.php';

//admin login
Route::prefix('admin')->name('admin.')->group(function () {
    Route::namespace('auth')->middleware('guest:admin')->group(function () {
        //login route
        Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
        Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('adminlogin');
    });
    //protected routes
    Route::middleware('admin', 'prevent-back-history')->group(function () {
        Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
        Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('adminlogout');
        Route::resource('/categories', CategoryController::class);
        Route::resource('/coupons', CouponController::class);
        Route::resource('/customers', CustomerController::class);
        Route::resource('/brands', BrandController::class);
        Route::post('/brand/updatebrandstatus/{id}', [BrandController::class, 'updateBrandStatus'])->name('updateBrandStatus');
        Route::resource('/users', UserController::class);
        //product in and out
        Route::get('/products/productsIn',[ProductController::class,'productIn'])->name('products.productIn');
        Route::post('/products/productsIn/update/{id}',[ProductController::class,'addStock'])->name('products.addStock');
        Route::get('/products/productsOut',[ProductController::class,'productOut'])->name('products.productOut');
        Route::post('/products/productsOut/update/{id}',[ProductController::class,'removeStock'])->name('products.removeStock');



        //product resource
        Route::resource('/products', ProductController::class);
        //product attribute
        Route::get('/product/productattributes/{id}', [AdminProductAttributeController::class,'addAttribute'])->name('product.addAttribute');
        Route::POST('/product/productattributes/store', [AdminProductAttributeController::class,'storeAttribute'])->name('product.storeAttribute');
        Route::PUT('/product/productattributes/update/{id}', [AdminProductAttributeController::class,'updateAttribute'])->name('product.updateAttribute');
        Route::get('/product/productattributes/delete/{id}', [AdminProductAttributeController::class,'deleteAttribute'])->name('product.deleteAttribute');
        //product images
        Route::get('/product/productimages/{id}', [AdminProductAttributeController::class,'addImage'])->name('product.addImage');
        Route::POST('/product/productimages/store', [AdminProductAttributeController::class,'storeImage'])->name('product.storeImage');
        Route::get('/product/productimages/delete/{id}', [AdminProductAttributeController::class,'deleteImage'])->name('product.deleteImage');
        


    });
});
