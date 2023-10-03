<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SellerUserProductController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',[ProductController::class,'index'])->name('index.products');
Route::get('/query',[HomeController::class,'index'])->name('home');
Route::get('/product/{product:slug}',[ProductController::class,'show'])->name('product');
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'ensureSeller'])->group(function () {
    Route::get('/sellers/{user}/products', [SellerUserProductController::class, 'sellerProducts'])->name('seller.products');
    Route::get('/sellers/{seller}/products/create', [SellerUserProductController::class,'create'])->name('seller.products.create');

    Route::get('/sellers/{user}/myproducts', [SellerUserProductController::class,'myProducts'])->name('seller.products.index');

    Route::get('/sellers/products/{product}/edit', [SellerUserProductController::class,'edit'])->name('sellers.product.edit');
    Route::put('/sellers/products/{product}', [SellerUserProductController::class,'update'])->name('sellers.product.update');
    Route::post('/sellers/products', [SellerUserProductController::class,'store'])->name('sellers.product.store');
    Route::get('/sellers/products/{product}/delete-image',[SellerUserProductController::class,'destroyImage'])->name('sellers.product.destroyImage');
    Route::get('/sellers/products/{product}/delete', [SellerUserProductController::class,'destroy'])->name('sellers.product.destroy');
    Route::get('/sellers/products/{product}/delete-image',[SellerUserProductController::class,'destroyImage'])->name('sellers.product.destroyImage');
    // Route::resource('seller/profile', SellerProfileController::class);
});
Route::post('/users',[RegisteredUserController::class,'store'])->name('users.register');
Route::middleware(['auth'])->group(function () {
    Route::post('/checkout/{id}',[ProductController::class,'checkout'])->name('checkout');
    Route::get('/success', [ProductController::class,'success'])->name('checkout.success');
    Route::get('/cancel', [ProductController::class,'cancel'])->name('checkout.cancel');

    // Route::get('/cart/products', [CustomerUserProductController::class,'index'])->name('cart.products'); //futuro carrinho

});


require __DIR__.'/auth.php';
