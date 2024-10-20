<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Loai;
use Carbon\Carbon;
use Illuminate\Support\Facades\View;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
Paginator::useBootstrap();

class HomeController extends Controller
{
    // function __construct(){
    //     $query = DB::table('loai')
    //         ->select('id', 'ten_loai', 'slug')
    //         ->orderBy('id', 'asc');
    //     $loai = $query->get();
    //     $danh_muc = DB::table('danh_muc')->get();
    //     \View::share('loai', $loai);
    //     \View::share('danh_muc', $danh_muc);

    //     // Giả sử người dùng đã đăng nhập
    //     $userId = Auth::id();
    //     if ($userId) {
    //         // Thực hiện truy vấn SQL và lấy tổng số lượng sản phẩm có id_sp và id_size duy nhất
    //         $totalProducts = DB::table('gio_hang')
    //             ->where('user_id', $userId)
    //             ->distinct('id_sp', 'id_size')
    //             ->count('id_sp'); // Đếm số lượng id_sp duy nhất
    //         //dd($totalProducts);
    //         // Lưu kết quả vào session
    //         session(['totalProducts' => $totalProducts]);
    //     } else {
    //         // Người dùng chưa đăng nhập
    //         session(['totalProducts' => 0]);
    //     }
    
    // }
    

    public function index(){
        $loai_arr = Loai::all();
        //$first_loai = $loai_arr->first(); // Lấy loại đầu tiên
        $query = DB::table('san_pham')->select('san_pham.id' , 'ten_sp' , 'gia', 'gia_km' , 'hinh', 'san_pham.trang_thai', 'danh_muc.ten_dm')
        ->join('danh_muc', 'san_pham.id_dm', '=', 'danh_muc.id')
        ->orderBy('san_pham.id', 'desc');
        
        $sanphamhome = (clone $query)->limit(2)->get();
        // Sản phảm mới
        $sanphamnew = (clone $query)
        ->where('san_pham.trang_thai', '!=', 3)
        ->limit(4)
        ->get();

        // Sản phẩm khuyến mãi
        $sanphamsale = (clone $query)
        ->where('san_pham.gia_km','>',0)
        ->where('san_pham.trang_thai', '!=', 3)
        ->inRandomOrder()
        ->limit(4)
        ->get();    

        // Sản phẩm sắp về hàng
        $sanphamcs = (clone $query)->where('san_pham.trang_thai','=',3)->limit(4)->get();

        // Sản phẩm theo loại
        $query_theoloai = DB::table('san_pham')
        ->select('san_pham.id', 'ten_sp', 'gia', 'gia_km', 'hinh','san_pham.trang_thai', 'danh_muc.ten_dm')
        ->join('danh_muc', 'san_pham.id_dm', '=', 'danh_muc.id')
        ->join('loai', 'danh_muc.id_loai', '=', 'loai.id')
        ->inRandomOrder() // Random sản phẩm
        ->limit(4); // Lấy ra 4 sản phẩm

        $sanpham = [];
        foreach ($loai_arr as $loai) {
            $sanpham[$loai->slug] = (clone $query_theoloai)->where('loai.slug', $loai->slug)->get();
        }

        // Dữ liệu trang chủ
        $home_page = DB::table('landing_page')->first();

        return view('user.home', compact('home_page','sanphamhome', 'sanphamnew', 'sanphamsale', 'sanphamcs' , 'loai_arr', 'sanpham'));
    }


}
