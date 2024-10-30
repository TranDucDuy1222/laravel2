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

                // Cập nhật số lượng sản phẩm trong bảng sizes
                $size = Size::find($gioHang->id_size);
                if ($size) {
                    $size->so_luong -= $gioHang->so_luong;
                    $size->save();
                }
                // Cập nhật luot_mua cho sản phẩm
                $sanPham = $gioHang->sanPham;
                if ($sanPham) {
                    $sanPham->luot_mua += $gioHang->so_luong;
                    $sanPham->save();
                }
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

    public function donHangDaMua($id){
        if(Auth::check()){
            $order = DonHang::join('dia_chi', 'dia_chi.id', '=', 'don_hang.id_dc')
            ->where('don_hang.id_user', $id)
            
            ->select('don_hang.*', 'dia_chi.id as dia_chi_id', 'dia_chi.dc_chi_tiet', 'dia_chi.phone', 'dia_chi.thanh_pho', 'dia_chi.ho_ten')
            ->orderBy('don_hang.id','desc')
            ->get();

            $purchased = DB::table('chi_tiet_don_hang')
            ->join('don_hang', 'don_hang.id', '=', 'chi_tiet_don_hang.id_dh')
            ->join('san_pham', 'san_pham.id', '=', 'chi_tiet_don_hang.id_sp')
            ->join('sizes', 'sizes.id', '=', 'chi_tiet_don_hang.id_size')
            ->join('dia_chi', 'dia_chi.id', '=', 'don_hang.id_dc')
            ->select('don_hang.*', 'chi_tiet_don_hang.*', 'san_pham.ten_sp', 'san_pham.hinh', 'san_pham.color' , 'sizes.size_product' , 'dia_chi.*')
            ->where('don_hang.id_user', $id)
            ->get();
            return view('user.home_purchased', compact('purchased' , 'order'));
        }else {
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập!');
        }        

    }




}
