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
use Carbon\Carbon;
use App\Models\DanhGia;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    public function datHang(Request $request)
    {
        $userId = Auth::id();
        $selectedProductIds = session('selected_products', []);
        $selectedAddressId = $request->input('selected_address');
        $paymentMethod = $request->input('payment_method');
        $totalPayable = $request->input('total_payables');
        $discountAmount = $request->input('discount_amount');

        if (empty($selectedProductIds)) {
            return redirect()->back()->with('error', 'Vui lòng kiểm tra lại sản phẩm được chọn.');
        } elseif (!$selectedAddressId) {
            return redirect()->back()->with('error', 'Vui lòng kiểm tra lại thông tin giao hàng.');

        } elseif (!$paymentMethod) {
            return redirect()->back()->with('error', 'Vui lòng kiểm tra lại phương thức thanh toán.');

        } elseif (!$totalPayable) {
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
            $donHang->uu_dai = $discountAmount;
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

            return redirect()->route('user.purchase', ['id' => $userId])->with('success', 'Đặt hàng thành công!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xảy ra. Vui lòng thử lại.');
        }
    }

    public function thanh_toan_vnpay(Request $request) {
        $code_cart = rand(00, 9999);
        $userId = Auth::id();
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = route('user.purchase', $userId); // URL trả về sau khi thanh toán
        $vnp_TmnCode = "18AB16MA";
        $vnp_HashSecret = "MH03RA1FG6Q1859GFPSKQPKUMY5P5I5G";
        $vnp_TxnRef = $code_cart;
        $vnp_OrderInfo = 'Thanh toán đơn hàng';
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = 20000 * 100;
        $vnp_Locale = 'vn';
        $vnp_BankCode = 'NCB';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
    
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        );
    
        ksort($inputData);
        $query = "";
        $hashdata = "";
        $i = 0;
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }
    
        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
    
        // \Log::info('VNPAY URL: ' . $vnp_Url);
        // \Log::info('VNPAY Return URL: ' . $vnp_Returnurl);
    
        return redirect()->to($vnp_Url);
    }

    public function donHangDaMua($id, Request $request)
    {
        if (Auth::check()) {

            // Truy vấn đơn hàng đã mua 
            $orders = DonHang::join('dia_chi', 'dia_chi.id', '=', 'don_hang.id_dc')
            ->where('don_hang.id_user', $id)
            ->select('don_hang.*', 'dia_chi.id as dia_chi_id', 'dia_chi.dc_chi_tiet', 'dia_chi.phone', 'dia_chi.thanh_pho', 'dia_chi.ho_ten');
            
            // Tách đơn hàng theo từng trạng thái 
            $orders_0 = $this->tinhToanNgayDuKienGiaoHang((clone $orders)->where('don_hang.trang_thai', 0)->orderBy('don_hang.id', 'desc')->get());
            $orders_1 = $this->tinhToanNgayDuKienGiaoHang((clone $orders)->where('don_hang.trang_thai', 1)->orderBy('don_hang.id', 'desc')->get());
            $orders_2 = $this->tinhToanNgayDuKienGiaoHang((clone $orders)->where('don_hang.trang_thai', 2)->orderBy('don_hang.id', 'desc')->get());
            $orders_3 = $this->tinhToanNgayDuKienGiaoHang((clone $orders)->where('don_hang.trang_thai', 3)->orderBy('don_hang.id', 'desc')->get());
            $orders_4 = $this->tinhToanNgayDuKienGiaoHang((clone $orders)->where('don_hang.trang_thai', 4)->orderBy('don_hang.id', 'desc')->get());
            $orders_5 = $this->tinhToanNgayDuKienGiaoHang((clone $orders)->where('don_hang.trang_thai', 5)->orderBy('don_hang.id', 'ASC')->get());

            $purchased = DB::table('chi_tiet_don_hang')
                ->join('don_hang', 'don_hang.id', '=', 'chi_tiet_don_hang.id_dh')
                ->join('san_pham', 'san_pham.id', '=', 'chi_tiet_don_hang.id_sp')
                ->join('sizes', 'sizes.id', '=', 'chi_tiet_don_hang.id_size')
                ->join('dia_chi', 'dia_chi.id', '=', 'don_hang.id_dc')
                ->select('don_hang.*', 'chi_tiet_don_hang.*', 'chi_tiet_don_hang.id as id_ctdh', 'san_pham.id as id_sp', 'san_pham.ten_sp', 'san_pham.hinh', 'san_pham.color', 'sizes.size_product', 'dia_chi.*')
                ->where('don_hang.id_user', $id)
                ->get();

            // Truy vấn phí vận chuyển
            $phivc = DB::table('settings')->select('ship_cost_inner_city', 'ship_cost_nationwide')->first();

            // Truy vấn trạng thái chờ xác nhận
            $status = DonHang::select('trang_thai')
                ->where('id_user', $id)
                ->orderBy('id', 'desc');

            $status_1 = (clone $status)
                ->where('trang_thai', 0)
                ->count();

            $status_2 = (clone $status)
                ->where('trang_thai', 1)
                ->count();

            $status_3 = (clone $status)
                ->where('trang_thai', 2)
                ->count();

            $status_4 = (clone $status)
                ->where('trang_thai', 3)
                ->count();

            $status_5 = (clone $status)
                ->where('trang_thai', 4)
                ->count();

            $status_6 = (clone $status)
                ->where('trang_thai', 5)
                ->count();

            return view('user.home_purchased', compact(
                'status_6','status_5', 'status_4', 'status_3', 'status_2', 'status_1',
                'orders_0', 'orders_1', 'orders_2', 'orders_3', 'orders_4', 'orders_5',
                'purchased',
                'phivc'
            ));
        } else {
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập!');
        }
    }
    private function tinhToanNgayDuKienGiaoHang($orders)
    {
        foreach ($orders as $order) {
            $thoiDiemMuaHang = Carbon::parse($order->thoi_diem_mua_hang);
            if ($order->thanh_pho == 'Thành Phố Hồ Chí Minh' || $order->thanh_pho == 'Hồ Chí Minh') {
                $order->ngay_du_kien_giao_hang = $thoiDiemMuaHang->addDays(2);
            } else {
                $order->ngay_du_kien_giao_hang = $thoiDiemMuaHang->addDays(4);
            }
        }
        return $orders;
    }

    public function danhGia(Request $request)
    {
        $id_user = $request->input('id_user');
        $id_dh = $request->input('id_dh');
        $id_ctdh = $request->input('id_ctdh'); // Chắc chắn rằng id_ctdh là một mảng
        $ratings = $request->input('rating');
        $reviews = $request->input('noi_dung');
        $images = $request->file('hinh_dg');

        foreach ($ratings as $id_sp => $rating) {

            if (isset($id_ctdh[$id_sp]) && isset($reviews[$id_sp])) { // Kiểm tra xem các giá trị này có tồn tại hay không
                $review = new DanhGia();
                $review->id_user = $id_user;
                $review->id_sp = $id_sp;
                $review->id_ctdh = $id_ctdh[$id_sp]; // Gán đúng giá trị cho từng sản phẩm
                $review->noi_dung = $reviews[$id_sp];
                $review->quality_product = $rating;
                $review->thoi_diem = now();
                $review->an_hien = 1;
                if (isset($images[$id_sp])) {
                    $fileName = time() . '_' . $images[$id_sp]->getClientOriginalName();
                    $images[$id_sp]->move(public_path('uploads/review/'), $fileName);
                    $review->hinh_dg = $fileName;
                }

                $review->save();
            } else {
                return redirect()->back()->with('thongbao', 'Có lỗi xảy ra, vui lòng kiểm tra lại dữ liệu.');
            }
        }

        $donHang = DonHang::find($id_dh);
        $donHang->trang_thai = 4;
        $donHang->save();

        return redirect()->back()->with('thongbao', 'Đánh giá của bạn đã được lưu thành công.');
    }
    public function huyDon($id_dh)
    {
        $donHang = DonHang::find($id_dh);
        if ($donHang) {
            $donHang->trang_thai = 5;
            $donHang->save();
            return redirect()->back()->with('thongbao', 'Đơn hàng đã được hủy thành công.');
        } else {
            return redirect()->back()->with('thongbao', 'Không tìm thấy đơn hàng.');
        }
    }

}
