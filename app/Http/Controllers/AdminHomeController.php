<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CheckLogin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\DonHang;
use App\Models\DanhGia;
use App\Models\SanPham;
use App\Models\DanhMuc;
use Carbon\Carbon;

class AdminHomeController extends AdminController
{
    public function __construct() {
        parent::__construct();
    }
    public function index(Request $request){
        $filter = $request->query('filter', 'month'); // Mặc định là 'month' nếu không có filter
        $year = $request->query('year', now()->year); // Năm mặc định là năm hiện tại
        $month = $request->query('month', now()->month); // Tháng mặc định là tháng hiện tại
        $dsDH = DB::table('don_hang')
        ->join('users', 'users.id', '=', 'don_hang.id_user')
        ->select('users.name', 'don_hang.*')
        ->orderBy('thoi_diem_mua_hang', 'DESC')
        ->limit(5)
        ->get();
        $dsKH = DB::table('users')
        ->orderBy('id', 'DESC')
        ->where('role', 0)
        ->get();

        $query = DonHang::query();

        switch ($filter) {
            case 'week':
                // Doanh thu từng tuần trong 1 tháng
                $query->selectRaw('WEEK(thoi_diem_mua_hang) as week, SUM(tong_dh) as revenue')
                    ->whereMonth('thoi_diem_mua_hang', $month)
                    ->whereYear('thoi_diem_mua_hang', $year)
                    ->groupBy('week');
                break;
            case 'month':
            default:
                // Doanh thu từng tháng trong 1 năm
                $query->selectRaw('MONTHNAME(thoi_diem_mua_hang) as month, SUM(tong_dh) as revenue')
                    ->whereYear('thoi_diem_mua_hang', $year)
                    ->groupBy('month');
                break;
        }

        $data = $query->orderBy('thoi_diem_mua_hang', 'asc')->get();

        return view('admin.home', compact('data', 'filter', 'year', 'month', 'dsDH', 'dsKH'));
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

}
