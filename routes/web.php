
<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UOMController;
use App\Http\Controllers\VariantProductController;
use Illuminate\Support\Facades\Route;

Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');

Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/form', [AdminController::class, 'form'])->name('admin.form');
// Route::get('/login', [AdminController::class, 'login'])->name('admin.login');
// // Route::get('/products', [AdminController::class, 'products'])->name('admin.products');
// Route::get('/var_products', [AdminController::class, 'variant_product'])->name('admin.var_products');
// Route::get('/var_attributes', [AdminController::class, 'variant_attribute'])->name('admin.var_attributes');
// Route::get('/uom', [AdminController::class, 'uom'])->name('admin.uom');


Route::get('/product/create', [ProductController::class, 'index'])->name('product.create');
Route::post('/AddNewProduct', [ProductController::class, 'AddNewProduct']);

Route::get('/uom/create', [UOMController::class, 'index'])->name('uom.create');
Route::post('/AddNewUom', [UOMController::class, 'AddNewUom']);

Route::get('/varProduct/create', [VariantProductController::class, 'index'])->name('varProduct.create');
Route::post('/AddNewVarProduct', [VariantProductController::class, 'AddNewVarProduct']);
