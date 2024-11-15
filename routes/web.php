<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BuyController;
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

Route::get('/erros', function () {
    return view('Thông báo lỗi !');
});
Route::get('/', [HomeController::class , 'index'])->name('home');
Route::post('/loai/{slug}', [HomeController::class , 'loai'])->name('loai');
Route::get('/detail/{id}', [ProductController::class , 'detail'])->name('product.detail');
// Route::get('/category/{id}', [ProductController::class , 'category']);
// Route::get('/allproduct', [ProductController::class , 'allproduct']);
// Route::get('/sale', [ProductController::class , 'sale']);

Route::get('/danh-muc-san-pham/{slug}', [ApiproductController::class , 'sanpham_danhmuc'])->name('danh-muc-san-pham');
Route::get('/loai-san-pham/{slug}', [ApiproductController::class , 'sanpham_loai'])->name('loai-san-pham');


// Giỏ hàng
Route::post('/themvaogio/{id}/{soluong?}', [BuyController::class,'themvaogio'])->name('cart.add');
Route::get('/gio-hang', [BuyController::class, 'hiengiohang'])->name('cart.gio-hang');
Route::post('/gio-hang', [BuyController::class, 'hiengiohang'])->name('cart.gio-hang');
Route::get('/xoasptronggio/{idsp}', [BuyController::class, 'xoasptronggio'])->name('cart.remove');
Route::post('/gio-hang-cap-nhat/{id}', [BuyController::class, 'update'])->name('cart.update');

// Thanh toán
Route::get('/thanh-toan', [BuyController::class, 'pay'])->name('pay');
Route::post('/thanh-toan', [BuyController::class, 'pay'])->name('pay');
Route::put('/thanh-toan-update/{id}', [BuyController::class, 'updatePay'])->name('pay.update');
Route::post('/thanh-toan/apply-voucher', [BuyController::class, 'applyVoucher'])->name('pay.applyVoucher');
Route::get('/thanh-toan/remove-voucher', [BuyController::class, 'removeVoucher'])->name('pay.removeVoucher');

// Đặt hàng
Route::post('/dat-hang', [OrderController::class, 'datHang'])->name('dat-hang');
//Route::post('/dat-hang', [OrderController::class, 'datHang_form'])->name('dat-hang');

// Đăng nhập
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

//Liên hệ
Route::get("/lien-he", [UserController::class, 'lienHe'])->name('user.contact');
Route::post("gui-lien-he", function(Illuminate\Http\Request $request){
    $arr = request()->post();
    $ht = trim(strip_tags($arr['name']));
    $email = trim(strip_tags($arr['email']));
    $nd = trim(strip_tags($arr['noidung']));

    $adminEmail = 'trendyu02@gmail.com';//Thư được gửi tới quản trị của email này
    Mail::mailer('smtp')->to($adminEmail)->send(new GuiEmail($ht, $email, $nd));
    return redirect()->route('user.contact')->with('success', 'Gửi mail thành công !');
});

// URL Admin
Route::group(['prefix' => 'admin'], function() { 
    Route::get('/', [AdminHomeController::class,'index'])->middleware(Quantri::class);
    Route::get('/login_admin', [AdminHomeController::class , 'login_admin_view']);
    Route::post('/login_admin', [AdminHomeController::class , 'login_admin'])->name('login_admin');
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
    
    Route::resource('danh-gia', AdminDanhGiaController::class);
    Route::post('/danh-gia/hide/{id}', [AdminDanhGiaController::class,'hide'])->name('danh-gia.hide');
    Route::post('/danh-gia/show/{id}', [AdminDanhGiaController::class,'show'])->name('danh-gia.show');

    Route::resource('magiamgia', MaGiamGiaController::class);

    Route::get('/test', [AdminHomeController::class, 'statistics'])->name('admin.statistics');

});


