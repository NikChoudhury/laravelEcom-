<?php

use Illuminate\Support\Facades\Route;
Use App\Http\Controllers\AdminController;
Use App\Http\Controllers\AdminCategoryController;
Use App\Http\Controllers\CouponController;
Use App\Http\Controllers\SizeController;
Use App\Http\Controllers\ColorController;
Use App\Http\Controllers\BrandController;
Use App\Http\Controllers\TaxController;
Use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('welcome');
});

# Admin Route
Route::get('admin', [AdminController::class,'index']);
Route::post('admin/auth', [AdminController::class,'auth'])->name('admin.auth');
// Route::get('admin/getHashPass', [AdminController::class,'getHashPassword']);
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
     // Size
     Route::get('admin/size', [SizeController::class,'index']);
     Route::get('admin/size/manage_size', [SizeController::class,'manageSize']);
     Route::get('admin/size/manage_size/{id}', [SizeController::class,'manageSize']);
     Route::post('admin/size/manage_size_process', [SizeController::class,'manageSizeProcess'])->name('size.manage_size_process');
     Route::get('admin/size/remove/{id}', [SizeController::class,'removeSize']);
     Route::get('admin/size/status/{status}/{id}', [SizeController::class,'changeStatus']);
     // END Size
    // Color
    Route::get('admin/color', [ColorController::class,'index']);
    Route::get('admin/color/manage_color', [ColorController::class,'manageColor']);
    Route::get('admin/color/manage_color/{id}', [ColorController::class,'manageColor']);
    Route::post('admin/color/manage_color_process', [ColorController::class,'manageColorProcess'])->name('color.manage_color_process');
    Route::get('admin/color/remove/{id}', [ColorController::class,'removeColor']);
    Route::get('admin/color/status/{status}/{id}', [ColorController::class,'changeStatus']);
    // END Color
    // Brand
    Route::get('admin/brand', [BrandController::class,'index']);
    Route::get('admin/brand/manage_brand', [BrandController::class,'manageBrand']);
    Route::get('admin/brand/manage_brand/{id}', [BrandController::class,'manageBrand']);
    Route::post('admin/brand/manage_brand_process', [BrandController::class,'manageBrandProcess'])->name('brand.manage_brand_process');
    Route::get('admin/brand/remove/{id}', [BrandController::class,'removeBrand']);
    Route::get('admin/brand/status/{status}/{id}', [BrandController::class,'changeStatus']);
    // END Brand
    // Tax
    Route::get('admin/tax', [TaxController::class,'index']);
    Route::get('admin/tax/manage_tax', [TaxController::class,'manageTax']);
    Route::get('admin/tax/manage_tax/{id}', [TaxController::class,'manageTax']);
    Route::post('admin/tax/manage_tax_process', [TaxController::class,'manageTaxProcess'])->name('tax.manage_tax_process');
    Route::get('admin/tax/remove/{id}', [TaxController::class,'removeTax']);
    Route::get('admin/tax/status/{status}/{id}', [TaxController::class,'changeStatus']);
    // END Tax
    // Product
    Route::get('admin/product', [ProductController::class,'index']);
    Route::get('admin/product/manage_product', [ProductController::class,'manageProduct']);
    Route::get('admin/product/manage_product/{id}', [ProductController::class,'manageProduct']);
    Route::post('admin/product/manage_product_process', [ProductController::class,'manageProductProcess'])->name('product.manage_product_process');
    Route::get('admin/product/remove/{id}', [ProductController::class,'removeProduct']);
    Route::get('admin/product/remove_product_attr/{product_attr_id}/{product_id}', [ProductController::class,'removeProductAttr']);
    Route::get('admin/product/remove_product_images/{product_images_id}/{product_id}', [ProductController::class,'removeProductImages']);
    Route::get('admin/product/status/{status}/{id}', [ProductController::class,'changeStatus']);
    // END Product
});