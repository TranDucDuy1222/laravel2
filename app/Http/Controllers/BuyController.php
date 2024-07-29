<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class BuyController extends Controller
{
    function __construct(Request $request){
        $tongsp = 0;
        $cart = '';
        if (!empty($request->session()->get('cart') )) {
            $cart =  $request->session()->get('cart') ;
            for ( $i=0; $i<count($cart) ; $i++) {
                $sp = $cart[$i];
                $tongsp += $sp['soluong'];
            }
        }else{
            $cart = 0;
        }
        $query = DB::table('danhmuc')
        ->select('madm', 'tendm')
        ->orderBy('madm', 'asc');
        $danhmuc = $query->get();
        \View::share('danhmuc', $danhmuc);
        
    }
    function themvaogio(Request $request, $masp = 0, $soluong=1){
        if ($request->session()->exists('cart')==false) {//chưa có cart trong session           
            $request->session()->push('cart', ['masp'=> $masp,  'soluong'=> $soluong]);          
        } else {// đã có cart, kiểm tra id_sp có trong cart không
            $cart =  $request->session()->get('cart'); 
            $index = array_search($masp, array_column($cart, 'masp'));
            if ($index!=''){ //id_sp có trong giỏ hàng thì tăhg số lượng
                $cart[$index]['soluong']+=$soluong;
                $request->session()->put('cart', $cart);
            }
            else { //sp chưa có trong arrary cart thì thêm vào 
                $cart[]= ['masp'=> $masp, 'soluong'=> $soluong];
                $request->session()->put('cart', $cart);
            }    
        }        
    }
    function hiengiohang(Request $request){
        $cart =  $request->session()->get('cart'); 
        $tongtien = 0;   
        $tongsoluong=0;
        $giasp = 0;
        for ( $i=0; $i<count($cart) ; $i++) {
          $sp = $cart[$i]; // $sp = [ 'id_sp' =>100, 'soluong'=>3]
          $ten_sp = DB::table('sanpham')->where('maps', $sp['masp'] )->value('tensp');
          $gia_km = DB::table('sanpham')->where('masp', $sp['masp'] )->value('giakhuyenmai');
          $gia = DB::table('sanpham')->where('masp', $sp['masp'] )->value('gia');
          $hinh = DB::table('sanpham')->where('masp', $sp['masp'] )->value('anhsp');  
          if ($gia_km>0 && $gia_km<$gia) {
            $thanhtien = $gia_km*$sp['soluong'];
          }else {
            $thanhtien = $gia*$sp['soluong'];
          }
          $tongsoluong+=$sp['soluong'];
          $tongtien += $thanhtien;
          if ($gia_km>0 && $gia_km<$gia) {
            
          }
          $sp['ten_sp'] = $ten_sp;

          $sp['gia'] = $gia_km;
          $sp['hinh'] = $hinh;
          $sp['thanhtien'] = $thanhtien;
          $cart[$i] = $sp;
        }
        $request->session()->put('cart', $cart);
        return view('user.home_giohang', compact(['cart', 'tongsoluong','tongtien']));
    }
    function xoasptronggio(Request $request, $id =0){
        $cart =  $request->session()->get('cart'); 
        $index = array_search($id, array_column($cart, 'id_sp'));
        if ($index!=''){ 
            array_splice($cart, $index, 1);
            $request->session()->put('cart', $cart);
        }
        return redirect('/hiengiohang');
    }
}
