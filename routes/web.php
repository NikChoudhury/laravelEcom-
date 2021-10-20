<?php

use Illuminate\Support\Facades\Route;
Use App\Http\Controllers\AdminController;
Use App\Http\Controllers\AdminCategoryController;
Use App\Http\Controllers\CouponController;
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
    Route::get('admin/category', [AdminCategoryController::class,'index']);
    Route::get('admin/category/manage_category', [AdminCategoryController::class,'manageCategory']);
    Route::get('admin/category/manage_category/{id}', [AdminCategoryController::class,'manageCategory']);
    Route::post('admin/category/manage_category_process', [AdminCategoryController::class,'manage_category_process'])->name('category.manage_category_process');
    Route::get('admin/category/remove/{id}', [AdminCategoryController::class,'removeCategory']);
    Route::get('admin/category/status/{status}/{id}', [AdminCategoryController::class,'changeStatus']);
    // END Category
    // Coupon
    Route::get('admin/coupon', [CouponController::class,'index']);
    Route::get('admin/coupon/manage_coupon', [CouponController::class,'manageCoupon']);
    Route::get('admin/coupon/manage_coupon/{id}', [CouponController::class,'manageCoupon']);
    Route::post('admin/coupon/manage_coupon_process', [CouponController::class,'manageCouponProcess'])->name('coupon.manage_coupon_process');
    Route::get('admin/coupon/remove/{id}', [CouponController::class,'removeCoupon']);
    Route::get('admin/coupon/status/{status}/{id}', [CouponController::class,'changeStatus']);
    // END Coupon
});