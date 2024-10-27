<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChiTietDonHang;
use App\Models\DonHang;
use App\Models\GioHang;
use App\Models\SanPham;
use App\Models\Size;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use DB;

class OrderController extends Controller
{
    public function datHang(Request $request) {
        $userId = Auth::id();
        $selectedProductIds = session('selected_products', []);
        $selectedAddressId = $request->input('selected_address');
        $paymentMethod = $request->input('payment_method');
        $totalPayable = $request->input('total_payables');

        if (empty($selectedProductIds)) {
            return redirect()->back()->with('error', 'Vui lòng kiểm tra lại sản phẩm được chọn.');
        }elseif (!$selectedAddressId ) {
            return redirect()->back()->with('error', 'Vui lòng kiểm tra lại thông tin giao hàng.');

        }elseif (!$paymentMethod  ) {
            return redirect()->back()->with('error', 'Vui lòng kiểm tra lại phương thức thanh toán.');

        }elseif (!$totalPayable) {
            return redirect()->back()->with('error', 'Vui lòng kiểm tra lại tổng tiền.');
        }

        DB::beginTransaction();

        try {
            // Tạo đơn hàng mới
            $donHang = new DonHang();
            $donHang->id_user = $userId;
            $donHang->thoi_diem_mua_hang = now();
            $donHang->id_dc = $selectedAddressId;
            $donHang->tong_dh = $totalPayable;
            $donHang->pttt = $paymentMethod;
            $donHang->trang_thai = 0;
            $donHang->save();

            // Lưu chi tiết đơn hàng
            foreach ($selectedProductIds as $productId) {
                $gioHang = GioHang::with(['sanPham', 'size'])->where('id', $productId)->first();
                $chiTietDonHang = new ChiTietDonHang();
                $chiTietDonHang->id_dh = $donHang->id;
                $chiTietDonHang->id_sp = $gioHang->sanPham->id;
                $chiTietDonHang->so_luong = $gioHang->so_luong;
                $chiTietDonHang->id_size = $gioHang->id_size;
                $chiTietDonHang->gia = $gioHang->sanPham->gia_km > 0 ? $gioHang->sanPham->gia_km : $gioHang->sanPham->gia;
                $chiTietDonHang->save();

                // Xóa sản phẩm khỏi giỏ hàng
                $gioHang->delete();
            }

            // Xóa session voucher sau khi đặt hàng thành công
            session()->forget('voucher');
            DB::commit();
            return redirect()->route('home')->with('success', 'Đặt hàng thành công!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xảy ra. Vui lòng thử lại.');
        }
    }
}
