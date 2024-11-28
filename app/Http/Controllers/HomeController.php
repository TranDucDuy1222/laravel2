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

    public function index(){
        $loai_arr = Loai::all();
        //$first_loai = $loai_arr->first(); // Lấy loại đầu tiên
        $query = DB::table('san_pham')->select('san_pham.id' , 'ten_sp' , 'gia', 'gia_km' , 'hinh', 'san_pham.trang_thai', 'danh_muc.ten_dm','mo_ta_ngan' , 'luot_mua')
        ->join('danh_muc', 'san_pham.id_dm', '=', 'danh_muc.id')
        ->orderBy('san_pham.id', 'desc');
        
        $sanphamhome = (clone $query)
        ->where('san_pham.trang_thai', '!=', [1, 2])
        ->limit(2)
        ->get();


        // Sản phẩm khuyến mãi
        $sanphamsale = (clone $query)
        ->where('san_pham.gia_km','>',0)
        ->whereNotIn('san_pham.trang_thai', [1, 2])
        ->inRandomOrder()
        ->limit(6)
        ->get();    

        // Sản phẩm sắp về hàng
        $sanphamcs = (clone $query)->where('san_pham.trang_thai','=',2)->limit(4)->get();

        // Sản phảm bán chạy
        $sanphamnew = DB::table('san_pham')->select('san_pham.id' , 'ten_sp' , 'gia', 'gia_km' , 'hinh', 'san_pham.trang_thai', 'danh_muc.ten_dm','mo_ta_ngan' , 'luot_mua')
        ->join('danh_muc', 'san_pham.id_dm', '=', 'danh_muc.id')
        ->where('san_pham.trang_thai', '!=', 2)
        ->where('san_pham.luot_mua', '!=', 0)
        ->orderBy('luot_mua', 'desc')
        ->limit(4)
        ->get();

        // Bảng top sản phẩm bán chạy
        $top_sanpham = DB::table('san_pham')->select('san_pham.id', 'ten_sp', 'gia', 'gia_km', 'hinh','san_pham.trang_thai', 'danh_muc.ten_dm', 'mo_ta_ngan' ,'luot_mua')
        ->join('danh_muc', 'san_pham.id_dm', '=', 'danh_muc.id')
        ->where('san_pham.trang_thai', '!=', 2)
        ->where('san_pham.luot_mua', '!=', 0)
        ->orderBy('luot_mua', 'desc')
        ->limit(6)
        ->get();

        // Sản phẩm theo loại
        $query_theoloai = DB::table('san_pham')
        ->select('san_pham.id', 'ten_sp', 'gia', 'gia_km', 'hinh','san_pham.trang_thai', 'danh_muc.ten_dm', 'mo_ta_ngan' ,'luot_mua')
        ->join('danh_muc', 'san_pham.id_dm', '=', 'danh_muc.id')
        ->join('loai', 'danh_muc.id_loai', '=', 'loai.id')
        ->whereNotIn('san_pham.trang_thai', [2])
        ->inRandomOrder() // Random sản phẩm
        ->limit(4); // Lấy ra 4 sản phẩm

        $sanpham = [];
        foreach ($loai_arr as $loai) {
            $sanpham[$loai->slug] = (clone $query_theoloai)->where('loai.slug', $loai->slug)->get();
        }

        // Dữ liệu trang chủ
        $home_page = DB::table('home_layout')->first();

        // Dữ liệu cài đặt 
        $settings = DB::table('settings')->select('logo_sale' , 'logo_cms' , 'banner_dung_sale' , 'banner_dung_cms')->first();

        return view('user.home', compact('settings', 'top_sanpham', 'home_page','sanphamhome', 'sanphamnew', 'sanphamsale', 'sanphamcs' , 'loai_arr', 'sanpham'));
    }


}
