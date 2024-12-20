<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BuyController;
use App\Http\Controllers\HomelayoutController;
use App\Http\Controllers\OrderController;
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
use App\Http\Controllers\AdminHomeController;
use App\Http\Controllers\MaGiamGiaController;
use App\Http\Controllers\SettingController;
use App\Mail\GuiEmail;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\ApiproductController;
use App\Http\Controllers\AdminemailController;

// Đăng nhập
Route::get('/login', [UserController::class , 'login'])->name('login');
Route::post('/login', [UserController::class , 'login_form'])->name('login_form');
Route::get('/logout', [UserController::class,'logout']);

Route::get('/register', [UserController::class, 'register'])->name('register');
Route::post('/register', [UserController::class, 'register_form'])->name('register_form'); 

Route::get('/verify-otp', [UserController::class, 'showOtpForm'])->name('otpform');
Route::post('/verify-otp', [UserController::class, 'verifyOtp'])->name('verify.otp');
Route::post('/resend-otp', [UserController::class, 'resendOtp'])->name('resendOtp');

Route::get('/login/google', [GoogleLoginController::class, 'redirectToGoogle'])->name('login.google');
Route::get('/login/google/callback', [GoogleLoginController::class, 'handleGoogleCallback']);

Route::get('/forgot-password', [UserController::class, 'forgot_pass'])->name('password.request');
Route::post('/forgot-password', [UserController::class, 'sendResetLink'])->name('password.email');
Route::get('/reset-password/{token}', [UserController::class, 'show_reset'])->name('password.reset');
Route::post('/reset-password', [UserController::class, 'resetPassword'])->name('password.update');

Route::middleware(['khachhang'])->group(function() {
    Route::get('/erros', function () {
        return view('Thông báo lỗi !');
    });
    Route::get('/', [HomeController::class , 'index'])->name('home');
    //Route::get('/tim-kiem/{slug}', [ApiproductController::class, 'tim_kiem']);
    Route::get('/detail/{id}', [ProductController::class , 'detail'])->name('product.detail');

    Route::get('/huong_dan_chon_size', [ProductController::class, 'hdchonsize'])->name('huongdanchonsize');
    
    Route::get('/loai-san-pham/{slug}', [ApiproductController::class , 'sanpham_loai'])->name('loai-san-pham');
    Route::get('/danh-muc-san-pham/{slug}', [ApiproductController::class , 'sanpham_danhmuc'])->name('danh-muc-san-pham');
    Route::get('/ket-qua', [ProductController::class, 'ket_qua_tim_kiem'])->name('KQ_tim-kiem');
    
    // Giỏ hàng
    Route::post('/themvaogio/{id}/{soluong?}', [BuyController::class,'themvaogio'])->name('cart.add');
    Route::get('/gio-hang', [BuyController::class, 'hiengiohang'])->name('cart.gio-hang');
    Route::post('/gio-hang', [BuyController::class, 'hiengiohang'])->name('cart.gio-hang');
    Route::get('/xoasptronggio/{idsp}', [BuyController::class, 'xoasptronggio'])->name('cart.remove');
    Route::post('/gio-hang-cap-nhat/{id}', [BuyController::class, 'update'])->name('cart.update');
    
    // Thanh toán
    Route::match(['get', 'post'], '/thanh-toan', [BuyController::class, 'pay'])->name('pay');
    Route::post('/apply-voucher', [BuyController::class, 'applyVoucher'])->name('pay.applyVoucher');
    Route::put('/thanh-toan-update/{id}', [BuyController::class, 'updatePay'])->name('pay.update');
    Route::post('/remove-voucher', [BuyController::class, 'removeVoucher'])->name('pay.removeVoucher');
    
    // Đặt hàng
    // Route::post('/dat-hang', [OrderController::class, 'datHang'])->name('dat-hang');
    // Route::get('/vnpay/return/{userId}', [OrderController::class, 'vnpayReturn'])->name('vnpay.return'); // Chuyển thành GET
    // Route::post('/vnpay/store-order', [OrderController::class, 'storeOrder'])->name('vnpay.storeOrder');
    Route::post('/dat-hang', [OrderController::class, 'datHang'])->name('dat-hang');
    Route::get('/vnpay/return/{userId}', [OrderController::class, 'vnpayCallback'])->name('vnpay.return'); // Chuyển thành GET
    Route::get('/zalopay/callback/{id}', [OrderController::class, 'zalopayCallback'])->name('zalopay.callback');
    
    //Quản lý tài khoản
    Route::get('/profile/{id}', [UserController::class,'quanLyTk'])->name('user.profile');
    Route::get('/profile/edit/{id}', [UserController::class,'chinhSuaThongTin'])->name('user.edit_profile');
    Route::put('/profile/edit/{id}', [UserController::class,'chinhSuaMk'])->name('user.update_mk');
    Route::put('/profile/editdiachi/{id}', [UserController::class,'capnhatdiachi'])->name('dia_chi.update');
    Route::delete('/profile/xoa-dia-chi/{id}', [UserController::class, 'xoa_dc'])->name('xoa-dia-chi');
    Route::post('/profile/dia-chi/{id}', [UserController::class, 'themDiaChi'])->name('diachi.add');
    
    // Quản lý đơn hàng
    //Route::post('/purchase/{id}', [OrderController::class, 'donHangDaMua'])->name('user.purchase');
    Route::get('/purchase/{id}', [OrderController::class, 'donHangDaMua'])->name('user.purchase');
    Route::get('/purchase-cancel/{id}', [OrderController::class, 'huyDon'])->name('user.purchase-cancel');
    Route::get('/purchase-confirm/{id}', [OrderController::class, 'xacnhanDonHang'])->name('user.purchase-confirm');
    Route::post('/purchase-reivew', [OrderController::class, 'danhGia'])->name('user.purchase-reivew');
    
    //Liên hệ
    Route::get("/lien-he", [UserController::class, 'lienHe'])->name('user.contact');
    Route::post('gui-lien-he', [UserController::class, 'sendContact']);
});



// URL Admin
Route::group(['prefix' => 'admin'], function() { 
    Route::get('/', [AdminHomeController::class,'index'])->name('admin')->middleware(Quantri::class);
    Route::get('/login_admin', [AdminHomeController::class , 'login_admin_view']);
    Route::post('/login_admin', [AdminHomeController::class , 'login_admin'])->name('login_admin');
});
Route::group(['prefix' => 'admin', 'middleware' => [Quantri::class] ], function() {
    Route::resource('danh-muc', AdminLoaiController::class);
    Route::get('danh-muc/xoa-danh-muc/{id}', [AdminLoaiController::class, 'delete'])->name('danh-muc.delete');
    Route::get('danh-muc/hidden/{id}', [AdminLoaiController::class, 'hidden'])->name('danh-muc.hidden');
    Route::get('danh-muc/show/{id}', [AdminLoaiController::class, 'show'])->name('danh-muc.show');

    Route::resource('san-pham', AdminSPController::class)->names([
        'index' => 'san-pham.index',
        'create' => 'san-pham.create',
        'store' => 'san-pham.store',
        'show' => 'san-pham.show',
        'edit' => 'san-pham.edit',
        'update' => 'san-pham.update',
        'destroy' => 'san-pham.destroy',
    ]);
    
    Route::post('/san-pham/hide/{id}', [AdminSPController::class, 'hide'])->name('san-pham.hide');
    Route::post('/san-pham/show/{id}', [AdminSPController::class, 'show'])->name('san-pham.show');
    Route::get('san-pham/khoi-phuc/{id}', [AdminSPController::class, 'khoiphuc']);
    Route::get('san-pham/xoa-vinh-vien/{id}', [AdminSPController::class, 'xoavinhvien']);

    Route::resource('trang-chu', HomelayoutController::class);

    Route::resource('cai-dat', SettingController::class);

    Route::resource('tai-khoan', AdminUserController::class);
    Route::get('tai-khoan-kh', [AdminUserController::class, 'accCustomer']);
    Route::post('/tai-khoan/{id}/hide', [AdminUserController::class, 'hide'])->name('tai-khoan.hide');
    Route::post('tai-khoan/{id}/restore', [AdminUserController::class, 'restore'])->name('tai-khoan.restore');

    Route::resource('don-hang', AdminDonHangController::class)->names([
        'index' => 'don-hang.index',
        'create' => 'donhang.create',
        'store' => 'donhang.store',
        'show' => 'don-hang.show',
        'edit' => 'donhang.edit',
        'update' => 'donhang.update',
        'destroy' => 'donhang.destroy',
    ]); 
    Route::post('/remove-notification', [AdminController::class, 'xoaThongBao'])->name('xoa');
    Route::put('don-hang/{id}/update-trang-thai', [AdminDonHangController::class, 'updateTrangThai'])->name('don-hang.update-trang-thai');
    Route::put('/don-hang-update-all', [AdminDonHangController::class, 'updateAll'])->name('don-hang.update-all');
    
    Route::resource('danh-gia', AdminDanhGiaController::class);
    Route::post('/danh-gia/hide/{id}', [AdminDanhGiaController::class,'hide'])->name('danh-gia.hide');
    Route::post('/danh-gia/show/{id}', [AdminDanhGiaController::class,'show'])->name('danh-gia.show');

    Route::resource('email', AdminemailController::class);
    Route::post('phan-hoi/{id}', [AdminemailController::class, 'sendReply'])->name('admin.contact');

    Route::resource('magiamgia', MaGiamGiaController::class);

});


