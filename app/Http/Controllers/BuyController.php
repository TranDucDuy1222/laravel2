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
            return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để xóa sản phẩm khỏi giỏ hàng.');
        }
        $userId = Auth::id();
        $gioHang = GioHang::where('user_id', $userId)
                        ->where('id_sp', $idsp)
                        ->first();
        if ($gioHang) {
            $gioHang->delete();
            return redirect()->route('cart.gio-hang')->with('success', 'Sản phẩm đã được xóa khỏi giỏ hàng.');
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
            return redirect()->route('cart.gio-hang')->with('error', 'Số lượng sản phẩm không được vượt quá số lượng hàng có sẵn.');
        }
        $gioHang->so_luong = $newQuantity;
        $gioHang->save();

        return redirect()->route('cart.gio-hang')->with('success', 'Cập nhật số lượng sản phẩm thành công!');
    }

    public function pay(Request $request) {
        $userId = Auth::id();
        $selectedProductIds = $request->input('selected_products', session('selected_products', []));  // Lấy danh sách sản phẩm đã chọn từ request hoặc từ session nếu có
        session(['selected_products' => $selectedProductIds]);  // Lưu danh sách sản phẩm đã chọn vào session
    
        if (empty($selectedProductIds)) {
            return redirect()->back()->with('error', 'Không có sản phẩm nào được chọn.');
        }
    
        $gioHangs = GioHang::with(['sanPham', 'size'])
                    ->whereIn('id', $selectedProductIds)
                    ->where('user_id', $userId)
                    ->get();
    
        if ($gioHangs->isEmpty()) {
            return redirect()->back()->with('error', 'Không có sản phẩm nào được tìm thấy.');
        }
    
        // Truy vấn địa chỉ 
        $diachis = DiaChi::where('id_user', $userId)->get();
    
        $totalAmount = $gioHangs->sum(function ($item) {
            if ($item->sanPham->gia_km > 0) {
                return $item->sanPham->gia_km * $item->so_luong;
            } else {
                return $item->sanPham->gia * $item->so_luong;
            }
        });
    
        $discountAmount = 0;
        if (session()->has('voucher')) {
            $voucherCode = session('voucher');
            $voucher = MaGiamGia::where('code', $voucherCode)->first();
            if ($voucher) {
                $discountAmount = ($totalAmount * $voucher->phan_tram) / 100;
            }
        }
    
        $totalPayable = $totalAmount - $discountAmount;
        $availableVouchers = MaGiamGia::where('is_active', true)->get();
        $pays = $gioHangs;
    
        return view('user.home_thanhtoan', compact('pays', 'diachis', 'totalPayable', 'discountAmount', 'availableVouchers'));
    }
    
    public function applyVoucher(Request $request) {
        $selectedProductIds = session('selected_products', $request->input('selected_products', []));
        session(['selected_products' => $selectedProductIds]);  // Lưu danh sách sản phẩm đã chọn vào session
    
        $voucherCode = $request->input('voucher');
        $voucher = MaGiamGia::where('code', $voucherCode)->first();
        if (!$voucher) {
            $error = 'Mã giảm giá không hợp lệ.';
            $userId = Auth::id();
            $gioHangs = GioHang::with(['sanPham', 'size'])
                        ->whereIn('id', $selectedProductIds)
                        ->where('user_id', $userId)
                        ->get();
            $diachis = DiaChi::where('id_user', $userId)->get();
            $totalAmount = $gioHangs->sum(function ($item) {
                return $item->sanPham->gia_km > 0 ? $item->sanPham->gia_km * $item->so_luong : $item->sanPham->gia * $item->so_luong;
            });
            $discountAmount = 0;
            $totalPayable = $totalAmount - $discountAmount;
            $availableVouchers = MaGiamGia::where('is_active', true)->get();
            $pays = $gioHangs;
            return view('user.home_thanhtoan', compact('pays', 'diachis', 'totalPayable', 'discountAmount', 'availableVouchers', 'error'));
        }
    
        // Lưu thông tin mã giảm giá và mức giảm vào session
        session(['voucher' => [
            'code' => $voucherCode,
            'amount' => $voucher->phan_tram
        ]]);
    
        return $this->pay($request)->with('success', 'Áp dụng mã giảm giá thành công!');
    }
    
    public function updatePay(Request $request, $id) {
        $selectedProductIds = session('selected_products', $request->input('selected_products', []));
        session(['selected_products' => $selectedProductIds]);  // Lưu danh sách sản phẩm đã chọn vào session
    
        $gioHang = GioHang::findOrFail($id);
        $newQuantity = $request->input('quantity');
        $sizeInfo = Size::where('id', $gioHang->id_size)->first();
        if ($newQuantity > $sizeInfo->so_luong) {
            return redirect()->route('pay')->with('error', 'Số lượng sản phẩm không được vượt quá số lượng hàng có sẵn.');
        }
        $gioHang->so_luong = $newQuantity;
        $gioHang->save();
    
        return $this->pay($request);
    }

    public function removeVoucher()
    {
        session()->forget('voucher');
        session()->forget('discountAmount');

        return redirect()->route('pay')->with('success', 'Đã hủy mã giảm giá.');
    }


}

