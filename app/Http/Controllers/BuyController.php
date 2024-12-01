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
use Illuminate\Support\Facades\Log;

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
        Log::info('Handling pay request', $request->all());
    
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để thực hiện thanh toán.');
        }
    
        $userId = Auth::id();
        $selectedProductIdsString = $request->input('selected_products', '');
    
        // Thiết lập lại session chỉ khi selected_products có giá trị
        if ($selectedProductIdsString) {
            $selectedProductIds = explode(',', $selectedProductIdsString);
            session(['selected_products' => $selectedProductIds]);
        } else {
            $selectedProductIds = session('selected_products', []);
        }
    
        // Kiểm tra nếu không có sản phẩm nào được chọn 
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
        Log::info('Applying voucher', $request->all());
        $selectedProductIds = session('selected_products', $request->input('selected_products', []));
        session(['selected_products' => $selectedProductIds]);

        $voucherCode = $request->input('voucher');
        $voucher = MaGiamGia::where('code', $voucherCode)->first();

        if (!$voucher) {
            session()->flash('thongbao', 'Mã giảm giá không hợp lệ.');
            return $this->pay($request);
        }

        if ($voucher->ngay_het_han && $voucher->ngay_het_han < now()) {
            session()->flash('thongbao', 'Mã giảm giá đã hết hạn.');
            return $this->pay($request);
        }

        $userId = Auth::id();

        // Kiểm tra mã giảm giá chỉ dùng một lần cho mỗi khách hàng
        if ($voucher->mot_nhieu == false) {
            // Kiểm tra xem khách hàng đã sử dụng mã này chưa
            $usedCustomers = json_decode($voucher->id_kh, true) ?: [];
            if (in_array($userId, $usedCustomers)) {
                session()->flash('thongbao', 'Mã giảm giá này bạn đã sử dụng rồi.');
                return $this->pay($request);
            }

            // Nếu chưa sử dụng, thêm khách hàng vào mảng đã sử dụng
            $usedCustomers[] = $userId;
            $voucher->id_kh = json_encode($usedCustomers);
        }

        // Kiểm tra nếu mã giảm giá có giới hạn số lượng
        if ($voucher->mot_nhieu == true && $voucher->ma_gioi_han > 0) {
            if ($voucher->ma_gioi_han <= 0) {
                return back()->with('thongbao', 'Mã giảm giá đã hết.');
            }
        }

        // Áp dụng mã giảm giá vào session
        session(['voucher' => [
            'code' => $voucherCode,
            'amount' => $voucher->phan_tram,
        ]]);

        session()->flash('thongbao', 'Áp dụng mã giảm giá thành công!');
        // Chuyển hướng đến hàm `pay` để tính toán và hiển thị lại trang thanh toán
        return $this->pay($request);
    }
    
    public function removeVoucher(Request $request) {
        session()->forget('voucher');
        session()->forget('discountAmount');
        session()->flash('thongbao', 'Hủy mã giảm giá thành công!');
        return $this->pay($request);
    }

}

