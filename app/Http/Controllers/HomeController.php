<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Loai;
use Illuminate\Pagination\Paginator;
Paginator::useBootstrap();

class HomeController extends Controller
{

    function __construct(){
        $query = DB::table('loai')
        ->select('id', 'ten_loai', 'slug')
        ->orderBy('id', 'asc');
        $loai = $query->get();
        $danh_muc = DB::table('danh_muc')->get();
        \View::share('loai', $loai);
        \View::share('danh_muc', $danh_muc);
    }

    public function index(){
        $query = DB::table('san_pham')->select('san_pham.id' , 'ten_sp' , 'gia', 'gia_km' , 'hinh', 'danh_muc.ten_dm')
        ->join('danh_muc', 'san_pham.id_dm', '=', 'danh_muc.id')
        ->orderBy('san_pham.id', 'desc')
        ->limit(2);
        $sanphamhome = $query->get();
        $loai_arr = Loai::all();

        $query_theoloai = DB::table('san_pham')
        ->select('san_pham.id', 'ten_sp', 'gia', 'gia_km', 'hinh', 'danh_muc.ten_dm')
        ->join('danh_muc', 'san_pham.id_dm', '=', 'danh_muc.id')
        ->join('loai', 'danh_muc.id_loai', '=', 'loai.id')
        ->inRandomOrder()
        ->limit(4);

        // Lấy sản phẩm ngẫu nhiên cho loại áo
        $ao = (clone $query_theoloai)->where('loai.slug', 'ao')->get();

        // Lấy sản phẩm ngẫu nhiên cho loại quần
        $quan = (clone $query_theoloai)->where('loai.slug', 'quan')->get();

        // Lấy sản phẩm ngẫu nhiên cho loại giày
        $giay = (clone $query_theoloai)->where('loai.slug', 'giay')->get();

        // Lấy sản phẩm ngẫu nhiên cho loại nam
        $nam = (clone $query_theoloai)->where('loai.slug', 'nam')->get();

        // Lấy sản phẩm ngẫu nhiên cho loại nữ
        $nu = (clone $query_theoloai)->where('loai.slug', 'nu')->get();

        // Lấy sản phẩm ngẫu nhiên cho loại trẻ em
        $tre_em = (clone $query_theoloai)->where('loai.slug', 'tre-em')->get();

        // $query = DB::table('langdingpage')
        // ->select('content_header', 'imgheader','content_1','content_2','content_3')
        // ->orderBy('ib', 'desc')
        // ->limit(2);
        // $banner = $query->get();
        return view('user.home', compact('sanphamhome' , 'loai_arr','ao' ,'quan', 'giay' ,'nam' ,'nu','tre_em'));   
    }
}
