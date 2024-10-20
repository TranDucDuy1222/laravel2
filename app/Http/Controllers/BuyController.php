<?php

namespace App\Http\Controllers;

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
        $discountAmount = session('discountAmount') ?? 0;
        $totalAmount = $gioHangs->sum(function($item) {
            return $item->sanPham->gia * $item->so_luong;
        });
        $totalPayable = $totalAmount - $discountAmount;

        $availableVouchers = MaGiamGia::where('is_active', true)->get();

        return view('user.home_giohang', compact('gioHangs', 'totalAmount', 'totalPayable', 'discountAmount', 'availableVouchers'));
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
        $userId = Auth::id();
        $gioHangs = GioHang::with(['sanPham', 'size'])->where('user_id', $userId)->get();
        $totalAmount = $gioHangs->sum(function ($item) {
            return $item->sanPham->gia * $item->so_luong;
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
        session()->put('discountAmount', $discountAmount);
        session()->put('totalPayable', $totalPayable);

        return redirect()->route('cart.gio-hang')->with('success', 'Cập nhật số lượng sản phẩm thành công!');
    }

    public function applyVoucher(Request $request)
    {
        $userId = Auth::id();
        $gioHangs = GioHang::with(['sanPham', 'size'])
                        ->where('user_id', $userId)
                        ->get();

        // Tìm mã giảm giá theo code người dùng nhập vào
        $voucher = MaGiamGia::where('code', $request->input('voucher'))->first();
        if (!$voucher) {
            return redirect()->route('cart.gio-hang')->withErrors(['voucher' => 'Mã giảm giá không hợp lệ.']);
        }

        // Tính tổng tiền sản phẩm trong giỏ hàng
        $totalAmount = $gioHangs->sum(function ($item) {
            return $item->sanPham->gia * $item->so_luong;
        });

        // Tính giá giảm giá
        $discountAmount = ($totalAmount * $voucher->phan_tram) / 100;

        // Tính tổng số tiền sau khi áp dụng mã giảm giá
        $totalPayable = $totalAmount - $discountAmount;

        // Lưu thông tin vào session
        session()->put('voucher', [
            'code' => $voucher->code,
            'amount' => $voucher->phan_tram,
        ]);
        session()->put('discountAmount', $discountAmount);
        session()->put('totalPayable', $totalPayable);

        return redirect()->route('cart.gio-hang')->with('success', 'Áp dụng mã giảm giá thành công!');
    }

    public function removeVoucher()
    {
        session()->forget('voucher');
        session()->forget('discountAmount');

        return redirect()->route('cart.gio-hang')->with('success', 'Đã hủy mã giảm giá.');
    }



}