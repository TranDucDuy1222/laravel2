<?php

namespace App\Http\Controllers;

use App\Models\DiaChi;
use App\Models\GioHang;
use App\Models\SanPham;
use App\Models\Size;
use App\Models\MaGiamGia;
use DB;
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
        return redirect()->route('cart.gio-hang')->with('success', 'Sản phẩm đã được thêm vào giỏ hàng.');
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
            return redirect()->route('login')->with('success', 'Bạn cần đăng nhập để xóa sản phẩm khỏi giỏ hàng.');
        }
        $userId = Auth::id();
        $gioHang = GioHang::where('user_id', $userId)
                        ->where('id_sp', $idsp)
                        ->first();
        if ($gioHang) {
            $gioHang->delete();
            return redirect()->route('cart.gio-hang')->with('success', 'Sản phẩm đã được xóa khỏi giỏ hàng.');
        } else {
            return redirect()->route('cart.gio-hang')->with('thongbao', 'Sản phẩm không tồn tại trong giỏ hàng.');
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

    return redirect()->route('cart.gio-hang')->with('success', 'Cập nhật số lượng sản phẩm thành công!');
    }


    // public function pay(Request $request) {
    //     $userId = Auth::id();
    //     $selectedProductIds = $request->input('selected_products', session('selected_products', []));
    //     session(['selected_products' => $selectedProductIds]);
    
    //     if (empty($selectedProductIds)) {
    //         return redirect()->back()->with('thongbao', 'Không có sản phẩm nào được chọn.');
    //     }
    
    //     $gioHangs = GioHang::with(['sanPham', 'size'])
    //                 ->whereIn('id', $selectedProductIds)
    //                 ->where('user_id', $userId)
    //                 ->get();
    
    //     if ($gioHangs->isEmpty()) {
    //         return redirect()->back()->with('thongbao', 'Không có sản phẩm nào được tìm thấy.');
    //     }
    
    //     // Truy vấn địa chỉ 
    //     $diachis = DiaChi::where('id_user', $userId)->get();
    
    //     // Truy vấn giá vận chuyển
    //     $giavc = DB::table('settings')->select('ship_cost_inner_city', 'ship_cost_nationwide')->first();
    
    //     $totalAmount = $gioHangs->sum(function ($item) {
    //         if ($item->sanPham->gia_km > 0) {
    //             return $item->sanPham->gia_km * $item->so_luong;
    //         } else {
    //             return $item->sanPham->gia * $item->so_luong;
    //         }
    //     });
    
    //     $discountAmount = 0;
    //     if (session()->has('voucher')) {
    //         $voucherData = session('voucher');
    //         $discountAmount = ($totalAmount * $voucherData['amount']) / 100;
    //     }
    
    //     $totalPayable = $totalAmount - $discountAmount;
    //     $availableVouchers = MaGiamGia::where('is_active', true)->get();
    //     $pays = $gioHangs;
    
    //     return view('user.home_thanhtoan', compact('pays', 'totalAmount', 'diachis', 'totalPayable', 'discountAmount', 'availableVouchers', 'giavc'));
    // }
    
    
    public function pay(Request $request) {
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
    
    public function applyVoucher(Request $request) {
        $selectedProductIds = session('selected_products', $request->input('selected_products', []));
        session(['selected_products' => $selectedProductIds]);
    
        $voucherCode = $request->input('voucher');
        $voucher = MaGiamGia::where('code', $voucherCode)->first();
    
        if (!$voucher) {
            $error = 'Mã giảm giá không hợp lệ.';
            session()->flash('thongbao', $error);
            return $this->handleInvalidVoucher($selectedProductIds);
        }
    
        // Kiểm tra xem mã giảm giá đã được sử dụng cho khách hàng này chưa
        $userId = Auth::id();
        if ($voucher->mot_nhieu == false && $voucher->id_kh == $userId) {
            $error = 'Mã giảm giá chỉ được sử dụng một lần cho mỗi khách hàng.';
            session()->flash('thongbao', $error);
            return $this->handleInvalidVoucher($selectedProductIds);
        }
    
        // Áp dụng mã giảm giá
        session(['voucher' => [
            'code' => $voucherCode,
            'amount' => $voucher->phan_tram
        ]]);
    
        // Cập nhật trạng thái mã giảm giá nếu nó chỉ có thể sử dụng một lần
        if ($voucher->mot_nhieu == false) {
            $voucher->id_kh = $userId;
        } else {
            if ($voucher->ma_gioi_han > 0) {
                $voucher->ma_gioi_han--; // Giảm số lần sử dụng
            }
        }
        $voucher->save();
    
        return $this->pay($request)->with('success', 'Áp dụng mã giảm giá thành công!');
    }
    
    public function updatePay(Request $request, $id) {
        try {
            // Lấy danh sách sản phẩm đã chọn từ session
            $selectedProductIds = session('selected_products', $request->input('selected_products', []));
            session(['selected_products' => $selectedProductIds]);  // Lưu danh sách sản phẩm đã chọn vào session
    
            // Tìm giỏ hàng bằng id
            $gioHang = GioHang::findOrFail($id);
            $newQuantity = $request->input('quantity');
    
            // Lấy thông tin size sản phẩm
            $sizeInfo = Size::where('id', $gioHang->id_size)->first();
            if ($newQuantity > $sizeInfo->so_luong) {
                return redirect()->route('pay')->with('error', 'Số lượng sản phẩm không được vượt quá số lượng hàng có sẵn.');
            }
    
            // Cập nhật số lượng sản phẩm trong giỏ hàng
            $gioHang->so_luong = $newQuantity;
            $gioHang->save();
    
            // Chuyển hướng về trang thanh toán
            return $this->pay($request);
    
        } catch (\Exception $e) {
            // Trả về lỗi nếu có vấn đề
            return redirect()->route('pay')->with('error', 'Có lỗi xảy ra. Vui lòng thử lại.');
        }
    }

    public function removeVoucher()
    {
        session()->forget('voucher');
        session()->forget('discountAmount');

        return redirect()->route('pay')->with('success', 'Đã hủy mã giảm giá.');
    }

}

