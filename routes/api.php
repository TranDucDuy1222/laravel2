<?php

use App\Http\Controllers\ApiproductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
// Route::get('/loai-san-pham/{slug}', [ApiproductController::class , 'sanpham_loai'])->name('loai-san-pham');
Route::get('/danh-muc-san-pham/{slug}', [ApiproductController::class, 'api_sanpham_danhmuc']);
Route::get('/loai-san-pham/{slug}', [ApiproductController::class, 'api_sanpham_loai']);
Route::get('/tim-kiem/{slug}', [ApiproductController::class, 'api_tim_kiem'])->name('tim-kiem');