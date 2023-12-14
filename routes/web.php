<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SubCategoryController;
use Illuminate\Support\Facades\Route;

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

Route::controller(CategoryController::class)->prefix('category')->group(function () {
    Route::get('/',  'index')->name('category.index');
    Route::get('create',  'create')->name('category.create');
    Route::post('store',  'store')->name('category.store');
});


Route::controller(SubCategoryController::class)->prefix("subcategory")->group(function () {
    Route::get('/',  'index')->name('subcategory.index');
    Route::get('create', 'create')->name('subcategory.create');
    Route::post('store', 'store')->name('subcategory.store');
});

Route::controller(ProductController::class)->prefix('products')->group(function () {
    Route::get('/',  'index')->name('products.index');
    Route::get('create',  'create')->name('products.create');
    Route::get('getcategory/{categoryId}',  'getSubcategories')->name('products.subcatId');
});

