<?php

use App\Http\Controllers\Auth\RegisteredUserController;
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
Route::get('/product/{product:slug}',[ProductController::class,'show'])->name('product');
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
// Admin
// Route::get('/admin/products', [AdminProductController::class,'index'])->name('admin.products');


// Route::post('/admin/products', [AdminProductController::class,'store'])->name('admin.product.store');
// Route::get('/admin/products/{product}/edit', [AdminProductController::class,'edit'])->name('admin.product.edit');
// Route::put('/admin/products/{product}', [AdminProductController::class,'update'])->name('admin.product.update');
// Route::get('/admin/products/{product}/delete', [AdminProductController::class,'destroy'])->name('admin.product.destroy');
// Route::get('/admin/products/{product}/delete-image',[AdminProductController::class,'destroyImage'])->name('admin.product.destroyImage');

Route::middleware(['auth', 'ensureSeller'])->group(function () {
    Route::get('/sellers/products', [SellerUserProductController::class, 'index'])->name('sellers.products');
    Route::get('/sellers/products/create', [SellerUserProductController::class,'create'])->name('sellers.product.create');
    Route::post('/sellers/products', [SellerUserProductController::class,'store'])->name('sellers.product.store');
    Route::get('/sellers/products/{product}/edit', [SellerUserProductController::class,'edit'])->name('sellers.product.edit');
    Route::get('/sellers/products/{product}/delete', [SellerUserProductController::class,'destroy'])->name('sellers.product.destroy');
    // Route::resource('seller/profile', SellerProfileController::class);
});
Route::post('/users',[RegisteredUserController::class,'store'])->name('users.register');
Route::middleware(['auth', 'role:customer'])->group(function () {
    Route::get('/customers/products', [CustomerUserProductController::class,'index'])->name('admin.products'); //futuro carrinho

});


require __DIR__.'/auth.php';
