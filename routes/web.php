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
    Route::get('admin/category', [CategoryController::class,'index']);
    Route::get('admin/manage_category', [CategoryController::class,'manageCategory']);
});