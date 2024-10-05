<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Pagination\Paginator;
Paginator::useBootstrap();

class HomeController extends Controller
{

    function __construct(){
        $query = DB::table('loai')
        ->select('id', 'ten_loai')
        ->orderBy('id', 'asc');
        $loai = $query->get();
        \View::share('loai', $loai);
    }

    public function index(){
        $query = DB::table('san_pham')->select('san_pham.id' , 'ten_sp' , 'gia', 'gia_km' , 'hinh', 'danh_muc.ten_dm')
        ->join('danh_muc', 'san_pham.id_dm', '=', 'danh_muc.id')
        ->orderBy('san_pham.id', 'desc')
        ->limit(4);
        $sanphamhome = $query->get();

        // $query = DB::table('langdingpage')
        // ->select('content_header', 'imgheader','content_1','content_2','content_3')
        // ->orderBy('ib', 'desc')
        // ->limit(2);
        // $banner = $query->get();

        return view('user.home', ['sanphamhome' => $sanphamhome]);   
    }
}
