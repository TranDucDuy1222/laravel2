<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use DB;
use Illuminate\Support\Facades\Session;

abstract class Controller
{
    public function __construct()
    {
        $query = DB::table('loai')
            ->select('id', 'ten_loai', 'slug')
            ->orderBy('id', 'asc');
        $loai = $query->get();
        $danh_muc = DB::table('danh_muc')->get();
        View::share('loai', $loai);
        View::share('danh_muc', $danh_muc);

        // Kiểm tra người dùng đã đăng nhập hay chưa
        if (Auth::check()) {
            $userId = Auth::id();
            // Thực hiện truy vấn SQL và lấy tổng số lượng sản phẩm có id_sp và id_size duy nhất
            $totalProducts = DB::table('gio_hang')
                ->where('user_id', $userId)
                ->distinct('id_sp', 'id_size')
                ->count('id_sp'); // Đếm số lượng id_sp duy nhất
        } else {
            // Người dùng chưa đăng nhập
            $totalProducts = 0;
        }

        // Lưu kết quả vào session
        Session::put('totalProducts', $totalProducts);
    }
}

