<?php

use App\Http\Controllers\AdminActionsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ProductDescriptionController;
use App\Http\Controllers\ProductImagesController;
use App\Http\Controllers\ProductsController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/admin/home');
Route::redirect('/home', '/admin/home');
Route::get('/admin/home', [HomeController::class, 'index'])->name('home');

// Admin Actions
Route::prefix('admin-actions')->group(function () {
    Route::get('/set-active-state/{table}/{id}', [AdminActionsController::class, 'setActiveState'])->name('set-active-state');
    Route::get('/delete/{table}/{id}', [AdminActionsController::class, 'delete'])->name('delete');
});

Route::prefix('/admin/categories')->group(function () {
    Route::get('/', [CategoriesController::class, 'edit'])->name('categories.edit');
    Route::post('/update', [CategoriesController::class, 'update'])->name('categories.update');
});

Route::prefix('/admin/products')->group(function () {
    Route::get('/', [ProductsController::class, 'edit'])->name('products.edit');
    Route::post('/update', [ProductsController::class, 'update'])->name('products.update');

    Route::get('/description/{id}', [ProductDescriptionController::class, 'edit'])->name('products-description.edit');
    Route::post('/description/{id}/update', [ProductDescriptionController::class, 'update'])->name('products-description.update');
});

Route::prefix('/admin/product-images')->group(function () {
    Route::get('/', [ProductImagesController::class, 'edit'])->name('product-images.edit');
    Route::post('/update', [ProductImagesController::class, 'update'])->name('product-images.update');
    Route::get('/set-main/{id}', [ProductImagesController::class, 'setMainImage'])->name('product-images.set-main');
});