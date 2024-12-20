<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use DB;
use Illuminate\Support\Facades\Session;
use App\Models\GioHang;

abstract class Controller
{
    public function __construct()
    {
        $query = DB::table('loai')
            ->select('id', 'ten_loai', 'slug')
            ->orderBy('id', 'asc');
        $loai = $query->get();
        $danh_muc = DB::table('danh_muc')->where('trang_thai' ,'!=' ,1)->get();
        View::share('loai', $loai);
        View::share('danh_muc', $danh_muc);

        // Kiểm tra người dùng đã đăng nhập hay chưa
        if (Auth::check()) {
            $userId = Auth::id();
            // Truy vấn và lấy tổng số lượng sản phẩm có id_sp và id_size trùng nhau
            $totalProducts = DB::table('gio_hang')
                ->where('user_id', $userId)
                ->distinct('id_sp', 'id_size')
                ->count('id_sp'); // Đếm số lượng id_sp 

            // Kiểm tra và cập nhật giỏ hàng
            $this->capnhatGioHang($userId);
        } else {
            // Người dùng chưa đăng nhập
            $totalProducts = 0;
        }

        // Lưu kết quả vào session
        Session::put('totalProducts', $totalProducts);
    }

    // Phương thức để kiểm tra và cập nhật giỏ hàng
    protected function capnhatGioHang($userId)
    {
        $gioHangs = GioHang::with(['sanPham', 'size'])
                        ->where('user_id', $userId)
                        ->get();

        $outOfStockItems = []; 

        // Kiểm tra số lượng và cập nhật trạng thái sản phẩm 
        foreach ($gioHangs as $gioHang) {
            if ($gioHang->size->so_luong === 0) {
                $gioHang->status = 1; 
                $gioHang->save();
                $outOfStockItems[] = $gioHang; 
            } elseif ($gioHang->so_luong > $gioHang->size->so_luong) {
                // Nếu số lượng trong giỏ hàng lớn hơn số lượng còn lại trong kho thì cập nhật lại bằng số lượng trong kho
                $gioHang->so_luong = $gioHang->size->so_luong; 
                $gioHang->save();
                $outOfStockItems[] = $gioHang; 
            } else { 
                // Nếu số lượng thuộc size đó đã được cập nhật mới, chuyển status thành 0 
                if ($gioHang->status == 1 && $gioHang->so_luong <= $gioHang->size->so_luong) { 
                    $gioHang->status = 0; 
                    $gioHang->save(); 
                } 
            }
        }

        // Sắp xếp sản phẩm theo trạng thái: status 0 trước, status 1 sau và ẩn hiện cũng tương tự
        $gioHangs = $gioHangs->sortBy([
            'status', 
            'an_hien'
        ]);
        

        // Hiển thị sản phẩm bằng session 
        session(['carts' => $gioHangs]);

        // Nếu có sản phẩm hết hàng hiển thị thông báo
        if (!empty($outOfStockItems)) {
            session()->flash('error', 'Một số sản phẩm trong giỏ hàng không còn đủ số lượng, số lượng đã được cập nhật.');
        }
    }
}
