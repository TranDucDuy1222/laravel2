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
    public function index(Request $request) {
        $filter = $request->query('filter', 'month'); 
        $year = $request->query('year', now()->year);
        $month = $request->query('month', now()->month);
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

        $dsSP = SanPham::with('sizes')  // Tải các size cùng với sản phẩm
            ->whereHas('sizes', function($query) {  // Chỉ lấy sản phẩm có size có số lượng nhỏ hơn 5
                $query->where('so_luong', '<', 10);
            })
            ->get();
         
        
        $dsDG = DB::table('danh_gia')
            ->join('san_pham', 'danh_gia.id_sp', '=', 'san_pham.id')
            ->join('users', 'danh_gia.id_user', '=', 'users.id')
            ->select(
                'danh_gia.id',
                'users.name as ten_khach_hang',
                'san_pham.ten_sp',
                'danh_gia.noi_dung',
                'danh_gia.thoi_diem',
                'danh_gia.quality_product'
            )
            ->orderBy('danh_gia.thoi_diem', 'desc')
            ->limit(10) // Lấy 10 đánh giá mới nhất
            ->get();
        
        $query = DonHang::query();

        switch ($filter) {
            case 'day':
                // Doanh thu theo ngày trong tháng
                $query->selectRaw('DAY(thoi_diem_mua_hang) as day, SUM(tong_dh) as revenue')
                    ->whereMonth('thoi_diem_mua_hang', $month)
                    ->whereYear('thoi_diem_mua_hang', $year)
                    ->groupBy('day');
                break;

            case 'week':
                // Doanh thu theo tuần trong tháng
                $query->selectRaw('WEEK(thoi_diem_mua_hang) as week, SUM(tong_dh) as revenue')
                    ->whereMonth('thoi_diem_mua_hang', $month)
                    ->whereYear('thoi_diem_mua_hang', $year)
                    ->groupBy('week');
                break;

            case 'month':
            default:
                // Doanh thu theo tháng trong năm
                $query->selectRaw('MONTH(thoi_diem_mua_hang) as month, SUM(tong_dh) as revenue')
                    ->whereYear('thoi_diem_mua_hang', $year)
                    ->groupBy('month');
                break;
        }

        $data = $query->orderBy('thoi_diem_mua_hang', 'asc')->get();

        // Lấy kiểu lọc
        $filterType = $request->input('filter');
        $query = DonHang::query();

        if ($filterType === 'day' && $request->input('filter_date')) {
            $query->whereDate('thoi_diem_mua_hang', $request->input('filter_date'));
        } elseif ($filterType === 'month' && $request->input('filter_month')) {
            $month = Carbon::parse($request->input('filter_month'))->month;
            $year = Carbon::parse($request->input('filter_month'))->year;
            $query->whereMonth('thoi_diem_mua_hang', $month)
                ->whereYear('thoi_diem_mua_hang', $year);
        } elseif ($filterType === 'year' && $request->input('filter_year')) {
            $query->whereYear('thoi_diem_mua_hang', $request->input('filter_year'));
        }
        // Tính toán thống kê
        $newCustomers = DB::table('users')->whereDate('created_at', $request->input('filter_date') ?: now())->count();
        $orderCount = $query->count();
        $totalRevenue = $query->sum('tong_dh');
        $totalProductsSold = DB::table('chi_tiet_don_hang')
        ->join('don_hang', 'don_hang.id', '=', 'chi_tiet_don_hang.id_dh')
        ->whereIn('don_hang.id', $query->pluck('id')) 
        ->sum('chi_tiet_don_hang.so_luong');

        $orderStatusData = DB::table('don_hang')
            ->selectRaw('trang_thai, COUNT(*) as count')
            ->groupBy('trang_thai')
            ->get();


        return view('admin.home', compact('data', 'filter', 'year', 'month', 'dsDH', 'dsKH', 'dsSP','dsDG', 'orderCount', 'totalRevenue', 'totalProductsSold', 'newCustomers', 'orderStatusData', ));
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
