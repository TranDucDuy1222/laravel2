<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CheckLogin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use App\Models\DonHang as don_hang;
use App\Models\DanhGia as danh_gia;

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

        // Kiểm tra đơn hàng mới 
        $newOrders = don_hang::where('trang_thai', '0')->get(); 
        foreach ($newOrders as $order) { 
            $key = 'order_notification_' . $order->id; 
            Session::put($key, 'Bạn có đơn hàng mới: Đơn hàng mã ' . $order->id); 
        } 
        // Kiểm tra đánh giá mới 
        $newReviews = danh_gia::where('feedback', 'NULL')->get(); 
        foreach ($newReviews as $review) { 
            $key = 'review_notification_' . $review->id; 
            Session::put($key, 'Bạn có đánh giá mới của đơn hàng '.$order->id.': Đánh giá mã ' . $review->id); 
        }
    }

    // Phương thức để xóa thông báo
    public function xoaThongBao(Request $request){
        $key = $request->input('key');
        Session::forget($key);
        return response()->json(['status' => 'Notification removed']);
    }

    // Định nghĩa phương thức index trống
    public function index(Request $request)
    { 
    }
    
}
