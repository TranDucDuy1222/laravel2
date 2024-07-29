<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Pagination\Paginator;
Paginator::useBootstrap();

class HomeController extends Controller
{

    function __construct(){
        $query = DB::table('danhmuc')
        ->select('madm', 'tendm')
        ->orderBy('madm', 'asc');
        $danhmuc = $query->get();
        \View::share('danhmuc', $danhmuc);
    }

    public function index(){
        $query = DB::table('sanpham')->select('masp' , 'tensp' , 'gia', 'giakhuyenmai' , 'anhsp' , 'soluong' , 'danhmuc.tendm')
        ->join('danhmuc', 'sanpham.madm', '=', 'danhmuc.madm')
        ->orderBy('masp', 'desc')
        ->limit(4);
        $sanphamhome = $query->get();

        $query = DB::table('banner')
        ->select('tieudelayout', 'imglayout','tieudephu','tieudephu2','tieudephu3')
        ->orderBy('ibbn', 'desc')
        ->limit(2);
        $banner = $query->get();

        return view('user.home', ['sanphamhome' => $sanphamhome , 'banner' => $banner]);   
    }
}
