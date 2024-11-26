<?php

namespace App\Http\Controllers;

use App\Models\DiaChi;
use App\Models\GioHang;
use App\Models\SanPham;
use App\Models\Size;
use App\Models\MaGiamGia;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BuyController extends Controller
{
    public function themvaogio(Request $request, $id)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('thongbao', 'Bạn cần đăng nhập để thêm sản phẩm vào giỏ hàng.');
        }
    
        $soluong = $request->input('soluong', 1);
        $sanPham = SanPham::findOrFail($id);
        $size = $request->input('size');
        $sizeInfo = Size::where('id_product', $id)
                    ->where('size_product', $size)
                    ->first();
    
        if (!$sizeInfo) {
            return redirect()->back()->with('thongbao', 'Size không tồn tại.');
        }
    
        if ($sizeInfo->so_luong <= 0) {
            return redirect()->back()->with('thongbao', 'Size này đã hết hàng.');
        }
    
        $userId = Auth::id();
        $gioHang = GioHang::where('user_id', $userId)
                        ->where('id_sp', $id)
                        ->where('id_size', $sizeInfo->id)
                        ->first();
    
        // Kiểm tra số lượng
        if ($gioHang) {
            if ($gioHang->so_luong + $soluong > $sizeInfo->so_luong) {
                return redirect()->back()->with('error', 'Số lượng sản phẩm không được vượt quá số lượng hàng có sẵn.');
            }
            $gioHang->so_luong += $soluong;
        } else {
            if ($soluong > $sizeInfo->so_luong) {
                return redirect()->back()->with('error', 'Số lượng sản phẩm không được vượt quá số lượng hàng có sẵn.');
            }
            
            $gioHang = new GioHang();
            $gioHang->user_id = $userId;
            $gioHang->id_sp = $sanPham->id;
            $gioHang->id_size = $sizeInfo->id;
            $gioHang->so_luong = $soluong;
        }
        $gioHang->save();    
        return redirect()->route('cart.gio-hang')->with('thongbao', 'Sản phẩm đã được thêm vào giỏ hàng.');
    }

    public function hiengiohang()
    {
        $userId = Auth::id();
        $gioHangs = GioHang::with(['sanPham', 'size'])
                        ->where('user_id', $userId)
                        ->get();
        // Hiển thị sản phẩm bằng session 
        session(['carts' => $gioHangs]);
        return view('user.home_giohang');
    }

    public function xoasptronggio($idsp)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('thongbao', 'Bạn cần đăng nhập để xóa sản phẩm khỏi giỏ hàng.');
        }
        $userId = Auth::id();
        $gioHang = GioHang::where('user_id', $userId)
                        ->where('id_sp', $idsp)
                        ->first();
        if ($gioHang) {
            $gioHang->delete();
            return redirect()->route('cart.gio-hang')->with('error', 'Sản phẩm đã được xóa khỏi giỏ hàng.');
        } else {
            return redirect()->route('cart.gio-hang')->with('error', 'Sản phẩm không tồn tại trong giỏ hàng.');
        }
    }

    public function update(Request $request, $id)
    {
        $gioHang = GioHang::findOrFail($id);
        $newQuantity = $request->input('quantity');
        $sizeInfo = Size::where('id', $gioHang->id_size)->first();
        if ($newQuantity > $sizeInfo->so_luong) {
            return redirect()->route('cart.gio-hang')->with('thongbao', 'Số lượng sản phẩm không được vượt quá số lượng hàng có sẵn.');
        }
        $gioHang->so_luong = $newQuantity;
        $gioHang->save();
    $gioHang = GioHang::findOrFail($id);
    $newQuantity = $request->input('quantity');
    $sizeInfo = Size::where('id', $gioHang->id_size)->first();
    if ($newQuantity > $sizeInfo->so_luong) {
        return redirect()->route('cart.gio-hang')->with('error', 'Số lượng sản phẩm không được vượt quá số lượng hàng có sẵn.');
    }
    $gioHang->so_luong = $newQuantity;
    $gioHang->save();

    return redirect()->route('cart.gio-hang')->with('thongbao', 'Cập nhật số lượng sản phẩm thành công!');
    }
    
    public function pay(Request $request) {
        if (!Auth::check()) {
            return redirect()->route('login')->with('thongbao', 'Bạn cần đăng nhập để thực hiện thanh toán.');
        }else{
            $userId = Auth::id();
            $selectedProductIdsString = $request->input('selected_products', '');
            $selectedProductIds = explode(',', $selectedProductIdsString);
            session(['selected_products' => $selectedProductIds]);
        
            if (empty($selectedProductIds)) {
                return redirect()->back()->with('thongbao', 'Không có sản phẩm nào được chọn.');
            }
        
            $gioHangs = GioHang::with(['sanPham', 'size'])
                        ->whereIn('id', $selectedProductIds)
                        ->where('user_id', $userId)
                        ->get();
        
            if ($gioHangs->isEmpty()) {
                return redirect()->back()->with('thongbao', 'Không có sản phẩm nào được tìm thấy.');
            }
        
            // Truy vấn địa chỉ 
            $diachis = DiaChi::where('id_user', $userId)->get();
        
            // Truy vấn giá vận chuyển
            $giavc = DB::table('settings')->select('ship_cost_inner_city', 'ship_cost_nationwide')->first();
        
            $totalAmount = $gioHangs->sum(function ($item) {
                if ($item->sanPham->gia_km > 0) {
                    return $item->sanPham->gia_km * $item->so_luong;
                } else {
                    return $item->sanPham->gia * $item->so_luong;
                }
            });
        
            $discountAmount = 0;
            if (session()->has('voucher')) {
                $voucherData = session('voucher');
                $discountAmount = ($totalAmount * $voucherData['amount']) / 100;
            }
        
            $totalPayable = $totalAmount - $discountAmount;
            $availableVouchers = MaGiamGia::where('is_active', true)->get();
            $pays = $gioHangs;
        
            return view('user.home_thanhtoan', compact('pays', 'totalAmount', 'diachis', 'totalPayable', 'discountAmount', 'availableVouchers', 'giavc'));
        }
    }
    
    public function applyVoucher(Request $request) {
        $selectedProductIds = session('selected_products', $request->input('selected_products', []));
        session(['selected_products' => $selectedProductIds]);
    
        $voucherCode = $request->input('voucher');
        $voucher = MaGiamGia::where('code', $voucherCode)->first();
    
        if (!$voucher) {
            return redirect()->back()->with('thongbao', 'Mã giảm giá không hợp lệ.');
        }
    
        // Kiểm tra nếu mã giảm giá chỉ sử dụng một lần cho mỗi khách hàng
        $userId = Auth::id();
        if ($voucher->mot_nhieu == false && $voucher->id_kh == $userId) {
            return redirect()->back()->with('thongbao', 'Mã giảm giá chỉ được sử dụng một lần cho mỗi khách hàng.');
        }
    
        // Áp dụng mã giảm giá vào session
        session(['voucher' => [
            'code' => $voucherCode,
            'amount' => $voucher->phan_tram
        ]]);
    
        // Giảm số lượng mã giảm giá (1 lần mỗi lần sử dụng)
        if ($voucher->mot_nhieu == true && $voucher->ma_gioi_han > 0) {
            $voucher->ma_gioi_han--; // Giảm số lượng có thể sử dụng
        }
        
        // Nếu mã giảm giá chỉ sử dụng 1 lần, lưu id của khách hàng đã sử dụng
        if ($voucher->mot_nhieu == false) {
            $voucher->id_kh = $userId; // Lưu id khách hàng đã dùng
        }
    
        $voucher->save(); // Lưu lại thay đổi vào cơ sở dữ liệu
    
        return redirect()->route('pay')->with('thongbao', 'Áp dụng mã giảm giá thành công!');
    }
    
    public function removeVoucher(Request $request) {
        // Logic để xóa voucher
        session()->forget('voucher');
        session()->forget('discountAmount');
        return redirect()->back()->with('success', 'Voucher đã được hủy!');
    }

}

