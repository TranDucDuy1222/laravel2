<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CheckLogin;
use Illuminate\Support\Facades\Auth;
use App\Models\DonHang;
use App\Models\DanhGia;
use App\Models\SanPham;
use App\Models\DanhMuc;

class AdminHomeController extends AdminController
{
    public function index(Request $request){
        return view('admin.home');
    }
    function login_admin_view(){
        return view('admin.login_admin');
    }
    function login_admin(CheckLogin $request) {
        if (Auth::guard('web')->attempt(['email' => $request['email'], 'password' => $request['password']])) {
            $user = auth()->guard('web')->user();
            
            if ($user->is_hidden) {
                Auth::guard('web')->logout();
                return back()->with('thongbao', 'Tài khoản này hiện tạm khóa và không thể đăng nhập.');
            }
            if ($user) {
                // Truy cập thuộc tính role
                if ($user->role == 1) {
                    session(['user_role' => $user->role]);
                    return redirect('admin/');
                } else {
                    return back()->with('thongbao', 'Bạn không đủ quyền hạn');
                }
            } else {
                return back()->with('thongbao', 'Đăng nhập không thành công');
            }
        }
        return back()->with('thongbao', 'Email hoặc mật khẩu không đúng');
    }

    
    public function statistics() {
        // Lấy số lượng đơn hàng mới
        $newOrdersCount = DonHang::where('id','new')->count();
    
        // Lấy số lượng đánh giá mới (trang_thai == 0)
        $newReviewsCount = DanhGia::where('an_hien', 0)->count();
    
        // Lấy tổng số sản phẩm và danh mục
        $totalProducts = SanPham::count();
        $totalCategories = DanhMuc::count();
    
        return view('admin.statistics', compact('newOrdersCount', 'newReviewsCount', 'totalProducts', 'totalCategories'));
    }
}
