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
use App\Http\Controllers\MaGiamGiaController;
use App\Http\Controllers\SettingController;

Route::get('/erros', function () {
    return view('Thông báo lỗi !');
});
Route::get('/', [HomeController::class , 'index']);
Route::post('/loai/{slug}', [HomeController::class , 'loai'])->name('loai');
Route::get('/detail/{id}', [ProductController::class , 'detail'])->name('product.detail');
Route::get('/category/{id}', [ProductController::class , 'category']);
Route::get('/allproduct', [ProductController::class , 'allproduct']);
Route::get('/sale', [ProductController::class , 'sale']);

Route::post('/themvaogio/{id}/{soluong?}', [BuyController::class,'themvaogio'])->name('cart.add');
Route::get('/gio-hang', [BuyController::class, 'hiengiohang'])->name('cart.gio-hang');
Route::post('/gio-hang', [BuyController::class, 'hiengiohang'])->name('cart.gio-hang');
Route::get('/xoasptronggio/{idsp}', [BuyController::class, 'xoasptronggio'])->name('cart.remove');
Route::post('/gio-hang/update/{id}', [BuyController::class, 'update'])->name('cart.update');
Route::post('/gio-hang/apply-voucher', [BuyController::class, 'applyVoucher'])->name('cart.applyVoucher');
Route::post('/gio-hang/remove-voucher', [BuyController::class, 'removeVoucher'])->name('cart.removeVoucher');

Route::get('/login', [UserController::class , 'login'])->name('login');
Route::post('/login', [UserController::class , 'login_form'])->name('login_form');
Route::get('/logout', [UserController::class,'logout']);

Route::get('/register', [UserController::class, 'register'])->name('register');
Route::post('/register', [UserController::class, 'register_form'])->name('register_form');

Route::get('/login/google', [GoogleLoginController::class, 'redirectToGoogle'])->name('login.google');
Route::get('/login/google/callback', [GoogleLoginController::class, 'handleGoogleCallback']);

Route::get('/forgot-password', [UserController::class, 'forgot_pass'])->name('password.request');
Route::post('/forgot-password', [UserController::class, 'sendResetLink'])->name('password.email');
Route::get('/reset-password/{token}', [UserController::class, 'show_reset'])->name('password.reset');
Route::post('/reset-password', [UserController::class, 'resetPassword'])->name('password.update');

Route::get('/profile/{id}', [UserController::class,'quanLyTk'])->name('user.profile');
Route::get('/profile/edit/{id}', [UserController::class,'chinhSuaThongTin'])->name('user.edit_profile');
Route::put('/profile/edit/{id}', [UserController::class,'chinhSuaMk'])->name('user.update_mk');


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

    Route::resource('cai-dat', SettingController::class);

    Route::resource('tai-khoan', AdminUserController::class);
    Route::post('/tai-khoan/{id}/hide', [AdminUserController::class, 'hide'])->name('tai-khoan.hide');
    Route::post('tai-khoan/{id}/restore', [AdminUserController::class, 'restore'])->name('tai-khoan.restore');

    Route::resource('don-hang', AdminDonHangController::class);  
    Route::put('don-hang/{id}/update-trang-thai', [AdminDonHangController::class, 'updateTrangThai'])->name('don-hang.update-trang-thai');
    
    Route::resource('danh-gia', AdminDanhGiaController::class);
    Route::post('/danh-gia/hide/{id}', [AdminDanhGiaController::class,'hide'])->name('danh-gia.hide');
    Route::post('/danh-gia/show/{id}', [AdminDanhGiaController::class,'show'])->name('danh-gia.show');

    Route::resource('magiamgia', MaGiamGiaController::class);

});


