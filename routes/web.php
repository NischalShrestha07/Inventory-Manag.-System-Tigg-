
<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\InvenAdjustmentController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductionJournalController;
use App\Http\Controllers\ProductionOrderController;
use App\Http\Controllers\UOMController;
use App\Http\Controllers\VariantProductController;
use App\Models\InvenAdjustment;
use App\Models\ProductCategory;
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
Route::delete('/AddNewProduct/{id}', [ProductController::class, 'destroy'])->name('product.destroy');

Route::get('/uom/create', [UOMController::class, 'index'])->name('uom.create');
Route::post('/AddNewUom', [UOMController::class, 'AddNewUom']);
Route::delete('/uom/{id}', [InvenAdjustmentController::class, 'destroy'])->name('uom.destroy');


Route::get('/varProduct/create', [VariantProductController::class, 'index'])->name('varProduct.create');
Route::post('/AddNewVarProduct', [VariantProductController::class, 'AddNewVarProduct']);
Route::delete('/varProduct/{id}', [VariantProductController::class, 'destroy'])->name('varProduct.destroy');


Route::get('/adjustment/create', [InvenAdjustmentController::class, 'index'])->name('adjustment.create');
Route::post('/AddNewInvenAdjustment', [InvenAdjustmentController::class, 'AddNewAdjustment']);
Route::delete('/adjustment/{id}', [InvenAdjustmentController::class, 'destroy'])->name('adjustment.destroy');

Route::get('/bill/create', [BillController::class, 'index'])->name('bill.create');
Route::post('/AddNewBill', [BillController::class, 'AddNewBill']);
Route::delete('/bill/{id}', [BillController::class, 'destroy'])->name('bill.destroy');

Route::get('/category/create', [ProductCategoryController::class, 'index'])->name('category.create');
Route::post('/AddNewProCategory', [ProductCategoryController::class, 'AddNewProductCategory']);
Route::delete('/category/{id}', [ProductCategoryController::class, 'destroy'])->name('category.destroy');


Route::get('/orders/create', [ProductionOrderController::class, 'index'])->name('order.create');
Route::post('/AddNewProductionOrder', [ProductionOrderController::class, 'AddNewProductionOrder']);
Route::delete('/orders/{id}', [ProductionOrderController::class, 'destroy'])->name('order.destroy');


Route::get('/journal/create', [ProductionJournalController::class, 'index'])->name('journal.create');
Route::post('/AddNewProductionJournal', [ProductionJournalController::class, 'AddNewProductionJournal']);
Route::delete('/journal/{id}', [ProductionJournalController::class, 'destroy'])->name('journal.destroy');

// Route::get('/attribute/create', [ProductionJournalController::class, 'index'])->name('journal.create');
// Route::post('/AddNewProductionJournal', [ProductionJournalController::class, 'AddNewProductionJournal']);
// Route::delete('/journal/{id}', [ProductionJournalController::class, 'destroy'])->name('journal.destroy');
