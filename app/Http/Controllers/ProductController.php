<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Pagination\Paginator;
Paginator::useBootstrap();

class ProductController extends Controller
{

    function __construct(){
        $query = DB::table('danhmuc')
        ->select('madm', 'tendm')
        ->orderBy('madm', 'asc');
        $danhmuc = $query->get();
        \View::share('danhmuc', $danhmuc);
    }

    function detail($id){
        $query = DB::table('sanpham')
        ->select('masp' , 'tensp' , 'gia', 'giakhuyenmai' , 'anhsp' , 'soluong' ,'motangan')
        ->where('masp' , $id);
        $detail = $query->first();

        $query = DB::table('sanpham')
        ->select('madm')
        ->where('masp' , $id);
        $madm = $query->first();

        $query = DB::table('sanpham')
        ->select('masp', 'tensp', 'gia', 'giakhuyenmai', 'anhsp', 'danhmuc.tendm')
        ->join('danhmuc', 'sanpham.madm', '=', 'danhmuc.madm')
        ->where('sanpham.madm' , $madm->madm)
        ->inRandomOrder()
        ->limit(3);
        $relatedpro = $query->get();

        $query = DB::table('danhgia')
            ->select('danhgia.*' , 'taikhoan.hoten' , 'ctdh.*' , 'sanpham.tensp')
            ->join('taikhoan', 'danhgia.matk', '=', 'taikhoan.matk')
            ->join('chitietdonhang AS ctdh', 'danhgia.mactdh', '=', 'ctdh.mactdh')
            ->join('sanpham', 'sanpham.masp', '=', 'ctdh.masp')
            ->where('ctdh.masp' , $id);
        $comment = $query->get();

        return view('user.detail_product', ['relatedpro' => $relatedpro , 'detail' => $detail , 'comment' => $comment]);
    }

    // Sản Phẩm theo danh mục
    function category($id){
        $query = DB::table('sanpham')
        ->select('masp' , 'tensp' , 'gia', 'giakhuyenmai' , 'anhsp' ,  'danhmuc.tendm')
        ->join('danhmuc', 'sanpham.madm', '=', 'danhmuc.madm')
        ->where('sanpham.madm' , $id)
        ->orderBy('masp', 'desc'); 
        $category = $query->paginate(8)->withQueryString();

        $query = DB::table('danhmuc')
        ->select('tendm')
        ->where('madm' , $id);
        $danhmuc = $query->first();

        return view('user.category', ['categories' => $category , 'danhmuc1' => $danhmuc]);
    }

    function allproduct(){
        $query = DB::table('sanpham')
        ->select('masp', 'tensp', 'gia', 'giakhuyenmai', 'anhsp', 'soluong', 'danhmuc.tendm')
        ->join('danhmuc', 'sanpham.madm', '=', 'danhmuc.madm')
        ->orderBy('masp', 'desc');    
        $allproduct = $query->paginate(8)->withQueryString();
        return view('user.all_product', compact('allproduct'));
    }

    function sale(){
        $query = DB::table('sanpham')
        ->select('masp', 'tensp', 'giakhuyenmai', 'anhsp', 'danhmuc.tendm')
        ->join('danhmuc', 'sanpham.madm', '=', 'danhmuc.madm')
        ->where('giakhuyenmai', '>', 0)
        ->orderBy('masp', 'desc');    
        $sale = $query->paginate(8)->withQueryString();
        return view('user.saleproduct', compact('sale'));
    }






    
}
