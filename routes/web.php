<?php

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);

Route::get('/admin/categories', [CategoriesController::class, 'edit'])->name('categories.edit');
Route::post('/admin/categories/update', [CategoriesController::class, 'update'])->name('categories.update');