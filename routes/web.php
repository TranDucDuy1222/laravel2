<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BuyController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\Quantri;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\GoogleLoginController;
use App\Http\Controllers\AdminLoaiController;
use App\Http\Controllers\AdminSPController;
use App\Http\Controllers\LandingpageController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminDonHangController;
use App\Http\Controllers\AdminDanhGiaController;

Route::get('/erros', function () {
    return view('Thông báo lỗi !');
});
Route::get('/', [HomeController::class , 'index']);
Route::post('/loai/{slug}', [HomeController::class , 'loai'])->name('loai');
Route::get('/detail/{id}', [ProductController::class , 'detail']);
Route::get('/category/{id}', [ProductController::class , 'category']);
Route::get('/allproduct', [ProductController::class , 'allproduct']);
Route::get('/sale', [ProductController::class , 'sale']);

Route::get('/themvaogio/{masp}/{soluong?}', [BuyController::class,'themvaogio']);
Route::get('/gio-hang', [BuyController::class,'hiengiohang']);
Route::get('/xoasptronggio/{idsp}', [BuyController::class,'xoasptronggio']);

Route::get('/login', [UserController::class , 'login']);
Route::post('/login', [UserController::class , 'login_form'])->name('login_form');
Route::get('/logout', [UserController::class,'logout']);

Route::get('/login/google', [GoogleLoginController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/login/google/callback', [GoogleLoginController::class, 'handleGoogleCallback']);



// URL Admin
Route::group(['prefix' => 'admin'], function() { 
    Route::get('/', [AdminController::class,'index'])->middleware(Quantri::class);
    Route::get('/login_admin', [AdminController::class , 'login_admin_view']);
    Route::post('/login_admin', [AdminController::class , 'login_admin'])->name('login_admin');
});
Route::group(['prefix' => 'admin', 'middleware' => [Quantri::class] ], function() {
    Route::resource('danh-muc', AdminLoaiController::class);
    Route::get('danh-muc/xoa-danh-muc/{id}', [AdminLoaiController::class, 'delete'])->name('danh-muc.delete');
    Route::get('danh-muc/hidden/{id}', [AdminLoaiController::class, 'hidden'])->name('danh-muc.hidden');
    Route::get('danh-muc/show/{id}', [AdminLoaiController::class, 'show'])->name('danh-muc.show');
    Route::resource('san-pham', AdminSPController::class);
    Route::post('/san-pham/hide/{id}', [AdminSPController::class, 'hide'])->name('san-pham.hide');
    Route::post('/san-pham/show/{id}', [AdminSPController::class, 'show'])->name('san-pham.show');
    Route::get('san-pham/khoi-phuc/{id}', [AdminSPController::class, 'khoiphuc']);
    Route::get('san-pham/xoa-vinh-vien/{id}', [AdminSPController::class, 'xoavinhvien']);
    Route::resource('trang-chu', LandingpageController::class);
    Route::resource('tai-khoan', AdminUserController::class);
    Route::post('/tai-khoan/{id}/hide', [AdminUserController::class, 'hide'])->name('tai-khoan.hide');
    Route::post('tai-khoan/{id}/restore', [AdminUserController::class, 'restore'])->name('tai-khoan.restore');
    Route::resource('don-hang', AdminDonHangController::class);  
    Route::put('don-hang/{id}/update-trang-thai', [AdminDonHangController::class, 'updateTrangThai'])->name('don-hang.update-trang-thai');
    Route::resource('danh-gia', AdminDanhGiaController::class);
    Route::post('/danh-gia/hide/{id}', [AdminDanhGiaController::class,'hide'])->name('danh-gia.hide');
    Route::post('/danh-gia/show/{id}', [AdminDanhGiaController::class,'show'])->name('danh-gia.show');
});


