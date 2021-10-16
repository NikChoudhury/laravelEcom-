<?php

use Illuminate\Support\Facades\Route;
Use App\Http\Controllers\AdminController;
Use App\Http\Controllers\CategoryController;

Route::get('/', function () {
    return view('welcome');
});

# Admin Route
Route::get('admin', [AdminController::class,'index']);
Route::post('admin/auth', [AdminController::class,'auth'])->name('admin.auth');
## Admin Route Middleware
Route::middleware(['admin_auth'])->group(function () {
    Route::get('admin/dashboard', [AdminController::class,'dashboard']);
    Route::get('admin/logout', [AdminController::class,'logout']);
    // Category
    Route::get('admin/category', [CategoryController::class,'index']);
    Route::get('admin/category/manage_category', [CategoryController::class,'manageCategory']);
    Route::get('admin/category/manage_category/{id}', [CategoryController::class,'manageCategory']);
    Route::post('admin/category/manage_category_process', [CategoryController::class,'manage_category_process'])->name('category.manage_category_process');
    Route::get('admin/category/remove/{id}', [CategoryController::class,'removeCategory']);
    // END Category
});