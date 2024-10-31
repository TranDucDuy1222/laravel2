<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CheckLogin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

abstract class AdminController extends Controller
{
    public function __construct() {
        $product_quantity = DB::table('san_pham')
        ->select('id')
        ->count();
        $review_quantity = DB::table('danh_gia')
        ->select('id')
        ->where('feedback', null)
        ->count();
        $category_quantity = DB::table('danh_muc')
        ->select('id')
        ->count();
        $order_quantity = DB::table('don_hang')
        ->select('id')
        ->where('trang_thai', 0)
        ->count();
        $voucher_quantity = DB::table('magiamgia')
        ->select('id')
        ->count();
        $user_quantity = DB::table('users')
        ->select('id')
        ->where('role', 0)
        ->count();
        View::share(['product_quantity'=> $product_quantity, 
                    'review_quantity'=> $review_quantity, 
                    'category_quantity'=> $category_quantity, 
                    'order_quantity'=> $order_quantity,
                    'voucher_quantity'=> $voucher_quantity,
                    'user_quantity'=> $user_quantity
                ]);
    }
}
