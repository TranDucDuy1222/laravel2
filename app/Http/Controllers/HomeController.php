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
        
        $sanphamhome = (clone $query)->limit(2)->get();

        // Sản phẩm khuyến mãi
        $sanphamsale = (clone $query)
        ->where('san_pham.gia_km','>',0)
        ->where('san_pham.trang_thai', '!=', 3)
        ->inRandomOrder()
        ->limit(6)
        ->get();    

        // Sản phẩm sắp về hàng
        $sanphamcs = (clone $query)->where('san_pham.trang_thai','=',3)->limit(4)->get();

        // Sản phảm bán chạy
        $sanphamnew = DB::table('san_pham')->select('san_pham.id' , 'ten_sp' , 'gia', 'gia_km' , 'hinh', 'san_pham.trang_thai', 'danh_muc.ten_dm','mo_ta_ngan' , 'luot_mua')
        ->join('danh_muc', 'san_pham.id_dm', '=', 'danh_muc.id')
        ->where('san_pham.trang_thai', '!=', 3)
        ->where('san_pham.luot_mua', '!=', 0)
        ->orderBy('luot_mua', 'desc')
        ->limit(3)
        ->get();

        // Top sản phẩm bán chạy
        $top_sanpham = DB::table('san_pham')->select('san_pham.id', 'ten_sp', 'gia', 'gia_km', 'hinh','san_pham.trang_thai', 'danh_muc.ten_dm', 'mo_ta_ngan' ,'luot_mua')
        ->join('danh_muc', 'san_pham.id_dm', '=', 'danh_muc.id')
        ->where('san_pham.trang_thai', '!=', 3)
        ->where('san_pham.luot_mua', '!=', 0)
        ->orderBy('luot_mua', 'desc')
        ->limit(6)
        ->get();

        // Sản phẩm theo loại
        $query_theoloai = DB::table('san_pham')
        ->select('san_pham.id', 'ten_sp', 'gia', 'gia_km', 'hinh','san_pham.trang_thai', 'danh_muc.ten_dm', 'mo_ta_ngan' ,'luot_mua')
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

        // Dữ liệu cài đặt 
        $settings = DB::table('settings')->select('logo_sale' , 'logo_cms' , 'banner_dung_sale' , 'banner_dung_cms')->first();

        // Truy vấn mã khuyến mãi
        $ma_giam_gia = DB::table('maGiamGia')->select('code' , 'mo_ta')->get();


        return view('user.home', compact('settings', 'top_sanpham', 'ma_giam_gia', 'home_page','sanphamhome', 'sanphamnew', 'sanphamsale', 'sanphamcs' , 'loai_arr', 'sanpham'));
    }


}
