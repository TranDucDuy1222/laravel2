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

Route::get('/erros', function () {
    return view('Thông báo lỗi !');
});
Route::get('/', [HomeController::class , 'index']);
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
    Route::resource('san-pham', AdminSPController::class);
    Route::get('san-pham/khoi-phuc/{id}', [AdminSPController::class, 'khoiphuc']);
    Route::get('san-pham/xoa-vinh-vien/{id}', [AdminSPController::class, 'xoavinhvien']);
    Route::resource('trang-chu', LandingpageController::class);

});


