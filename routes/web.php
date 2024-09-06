
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
use App\Http\Controllers\VarientAttributeController;
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
// Route::post('/AddCategory', [ProductController::class, 'AddCategory']);
Route::put('/UpdateProduct', [ProductController::class, 'UpdateProduct']);
Route::delete('/DeleteProduct/{id}', [ProductController::class, 'destroy'])->name('product.destroy');

Route::get('/uom/create', [UOMController::class, 'index'])->name('uom.create');
Route::post('/AddNewUom', [UOMController::class, 'AddNewUom']);
Route::put('/UpdateUOM', [UOMController::class, 'UpdateUOM']);
Route::delete('/uom/{id}', [UOMController::class, 'destroy'])->name('uom.destroy');


Route::get('/varProduct/create', [VariantProductController::class, 'index'])->name('varProduct.create');
Route::post('/AddNewVarProduct', [VariantProductController::class, 'AddNewVarProduct']);
Route::put('/UpdateVarProduct', [VariantProductController::class, 'UpdateVarProduct']);
Route::delete('/varProduct/{id}', [VariantProductController::class, 'destroy'])->name('varProduct.destroy');

//Ajax Use to access the dependent options
Route::get('/fetch-options/{attribute}', [VariantProductController::class, 'fetchOptions']);



Route::get('/adjustment/create', [InvenAdjustmentController::class, 'index'])->name('adjustment.create');
Route::post('/AddNewInvenAdjustment', [InvenAdjustmentController::class, 'AddNewAdjustment']);
Route::put('/UpdateAdjustment', [InvenAdjustmentController::class, 'UpdateAdjustment']);
Route::delete('/adjustments/{id}', [InvenAdjustmentController::class, 'destroy'])->name('adjustment.destroy');

Route::get('/bill/create', [BillController::class, 'index'])->name('bill.create');
Route::post('/AddNewBill', [BillController::class, 'AddNewBill']);
Route::put('/UpdateBill', [BillController::class, 'UpdateBill']);
Route::delete('/bill/{id}', [BillController::class, 'destroy'])->name('bill.destroy');

Route::get('/category/create', [ProductCategoryController::class, 'index'])->name('category.create');
Route::post('/AddNewProCategory', [ProductCategoryController::class, 'AddNewProductCategory']);
Route::put('/UpdateCategory', [ProductCategoryController::class, 'UpdateCategory']);
Route::delete('/category/{id}', [ProductCategoryController::class, 'destroy'])->name('category.destroy');


Route::get('/orders/create', [ProductionOrderController::class, 'index'])->name('order.create');
Route::post('/AddNewProductionOrder', [ProductionOrderController::class, 'AddNewProductionOrder']);
Route::put('/UpdateProductionOrder', [ProductionOrderController::class, 'UpdateProductionOrder']);
Route::delete('/orders/{id}', [ProductionOrderController::class, 'destroy'])->name('order.destroy');


Route::get('/journal/create', [ProductionJournalController::class, 'index'])->name('journal.create');
Route::post('/AddNewProductionJournal', [ProductionJournalController::class, 'AddNewProductionJournal']);
Route::put('/UpdateJournal', [ProductionJournalController::class, 'UpdateJournal']);
Route::delete('/journal/{id}', [ProductionJournalController::class, 'destroy'])->name('journal.destroy');

Route::get('/attribute/create', [VarientAttributeController::class, 'index'])->name('varAttribute.create');
Route::post('/AddNewVarAttribute', [VarientAttributeController::class, 'AddNewVarAttribute'])->name('variant.add');
Route::put('/UpdateVarAttribute', [VarientAttributeController::class, 'UpdateVarAttribute']);
Route::delete('/attribute/{id}', [VarientAttributeController::class, 'destroy'])->name('varAttribute.destroy');
