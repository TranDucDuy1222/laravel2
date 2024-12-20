<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChiTietDonHang;
use App\Models\DonHang;
use App\Models\GioHang;
use App\Models\SanPham;
use App\Models\Size;
use App\Models\MaGiamGia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use DB;
use Carbon\Carbon;
use App\Models\DanhGia;
use Illuminate\Support\Str;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
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
        session(['selected_address' => $selectedAddressId, 'discount_amount' => $discountAmount, 'total_payables' => $totalPayable, 'selected_products' => $selectedProductIds, 'payment_method' => $paymentMethod]);

        if (empty($selectedProductIds)) {
            return redirect()->back()->with('error', 'Vui lòng kiểm tra lại sản phẩm được chọn.');
        } elseif (!$selectedAddressId) {
            return redirect()->back()->with('error', 'Vui lòng kiểm tra lại thông tin giao hàng.');
        } elseif (!$paymentMethod) {
            return redirect()->back()->with('error', 'Vui lòng kiểm tra lại phương thức thanh toán.');
        } elseif (!$totalPayable) {
            return redirect()->back()->with('error', 'Vui lòng kiểm tra lại tổng tiền.');
        }

        // Kiểm tra giá trị của $paymentMethod
        Log::info('Payment method: ' . $paymentMethod);

        switch ($paymentMethod) {
            case 'VNPay':
                $paymentUrl = $this->processVNPAY($totalPayable, $userId);
                break;
            case 'Zalopay':
                $paymentUrl = $this->processZALOPAY($totalPayable, $userId);
                break;
            case 'COD':
            default:
                return $this->createOrder($request); // Tạo đơn hàng khi phương thức thanh toán là COD hoặc không xác định
        }

        // Kiểm tra nếu $paymentUrl là một mảng
        if (is_array($paymentUrl)) {
            Log::error('Lỗi: $paymentUrl là một mảng.');
            return redirect()->back()->with('error', 'URL không hợp lệ.');
        }

        // Đảm bảo $paymentUrl là một chuỗi hợp lệ trước khi redirect
        if ($paymentUrl) {
            return redirect()->away($paymentUrl);
        } else {
            return redirect()->back()->with('error', 'Thanh toán không thành công. Vui lòng thử lại.');
        }
    }

    private function cleanHeaders(array $headers)
    {
        foreach ($headers as $key => $value) {
            $headers[$key] = trim(preg_replace('/\s+/', ' ', $value));
        }
        return $headers;
    }

    private function processZALOPAY($totalPayable, $userId) {
        $config = [
            "app_id" => 2553,
            "key1" => "PcY4iZIKFCIdgZvA6ueMcMHHUbRLYjPL",
            "key2" => "kLtgPl8HHhfvMuDHPwKfgfsY4Ydm9eIz",
            "endpoint" => "https://sb-openapi.zalopay.vn/v2/create"
        ];
    
        $callbackUrl = route('zalopay.callback', ['id' => $userId]); // Thêm URL callback của bạn tại đây với tham số id
        $embeddata = json_encode(['redirecturl' => $callbackUrl], JSON_UNESCAPED_SLASHES);
    
        Log::info('ZaloPay embed_data (thô): ' . $embeddata);
        if (json_last_error() !== JSON_ERROR_NONE) {
            Log::error('Lỗi khi mã hóa embed_data: ' . json_last_error_msg());
            return null;
        }
    
        $transID = rand(0, 1000000);
        $app_trans_id = date("ymd") . "_" . $transID;
        $order = [
            "app_id" => $config["app_id"],
            "app_time" => round(microtime(true) * 1000),
            "app_trans_id" => $app_trans_id,
            "app_user" => strval($userId),
            "item" => '[]',
            "embed_data" => $embeddata,
            "amount" => $totalPayable,
            "description" => "Thanh toán đơn hàng #$app_trans_id",
            "bank_code" => "",
            "callback_url" => $callbackUrl // Thêm callback_url vào đây
        ];
    
        $data = $order["app_id"] . "|" . $order["app_trans_id"] . "|" . $order["app_user"] . "|" . $order["amount"] . "|" . $order["app_time"] . "|" . $order["embed_data"] . "|" . $order["item"];
        Log::info('Dữ liệu trước khi băm: ' . $data);
        $order["mac"] = hash_hmac("sha256", $data, $config["key1"]);
        Log::info('Dữ liệu yêu cầu ZaloPay: ' . json_encode($order));
    
        $client = new Client();
        $cleaned_headers = $this->cleanHeaders(['Content-Type' => 'application/x-www-form-urlencoded']);
    
        try {
            $response = $client->post($config["endpoint"], [
                'headers' => $cleaned_headers,
                'form_params' => $order
            ]);
    
            $result = json_decode($response->getBody()->getContents(), true);
            Log::info('Phản hồi từ ZaloPay: ' . json_encode($result));
    
            if ($result && isset($result['return_code']) && $result['return_code'] == 1) {
                if (isset($result['order_url'])) {
                    return $result['order_url']; // Trả về chuỗi URL hợp lệ
                } else {
                    Log::error('Không tìm thấy order_url trong phản hồi.');
                    return null;
                }
            } else {
                if ($result && isset($result['return_code'])) {
                    Log::error('Lỗi return_code từ ZaloPay: ' . $result['return_code'] . ' - ' . $result['return_message']);
                    Log::error('Lỗi sub_return_code từ ZaloPay: ' . $result['sub_return_code'] . ' - ' . $result['sub_return_message']);
                    Log::error('Chi tiết phản hồi từ ZaloPay: ' . json_encode($result));
                    Log::info('App Trans ID: ' . $order['app_trans_id']);
                    Log::info('App Time: ' . $order['app_time']);
                } else {
                    Log::error('Cấu trúc phản hồi từ ZaloPay có lỗi: ' . json_encode($result));
                }
                return null;
            }
        } catch (RequestException $e) {
            Log::error('Yêu cầu ZaloPay thất bại: ' . $e->getMessage());
            return null;
        }
    }    
    
    public function zalopayCallback(Request $request, $userId) {
        Log::info('ZaloPay callback received', $request->all());
    
        $status = $request->input('status');
        $amount = $request->input('amount');
        $apptransid = $request->input('apptransid');
    
        if ($status == 1) {
            // Xử lý đơn hàng thành công
            Log::info("Payment successful for order: $apptransid");
    
            // Lưu thông tin cần thiết vào session
            session([
                'payment_method' => 'ZaloPay',
                'total_payables' => $amount,
                // Bạn có thể cần thêm thông tin khác vào session ở đây
            ]);
    
            // Chuyển hướng đến hàm createOrder
            return $this->createOrder($request);
        } else {
            // Xử lý đơn hàng thất bại
            Log::error("Payment failed for order: $apptransid with status: $status");
            return response()->json(['status' => 'error', 'message' => 'Payment failed']);
        }
    }
    
    public function createOrder(Request $request)
    {
        $userId = Auth::id();
        $selectedProductIds = session('selected_products', []);
        $selectedAddressId = session('selected_address');
        $paymentMethod = session('payment_method', $request->input('payment_method'));
        $totalPayable = session('total_payables');
        $discountAmount = session('discount_amount');
        $orderStatus = ($paymentMethod === 'COD') ? 0 : 1;

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
            $donHang->trang_thai = $orderStatus; // Trạng thái mặc định của đơn hàng
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

                // Cập nhật lượt mua cho sản phẩm
                $sanPham = $gioHang->sanPham;
                if ($sanPham) {
                    $sanPham->luot_mua += $gioHang->so_luong;
                    $sanPham->save();
                }

                // Xóa sản phẩm khỏi giỏ hàng
                $gioHang->delete();
            }

            // Xử lý mã giảm giá sau khi đặt hàng thành công
            $voucherData = session('voucher');
            if ($voucherData) {
                $voucher = MaGiamGia::where('code', $voucherData['code'])->first();

                if ($voucher) {
                    // Giảm số lượng mã giảm giá
                    if ($voucher->ma_gioi_han > 0) {
                        $voucher->ma_gioi_han--;
                    }

                    // Cập nhật danh sách khách hàng đã sử dụng
                    $usedByUsers = json_decode($voucher->id_kh, true) ?? [];
                    $usedByUsers[$userId] = ($usedByUsers[$userId] ?? 0) + 1;
                    $voucher->id_kh = json_encode($usedByUsers);

                    $voucher->save();
                }

                // Xóa session voucher sau khi đặt hàng thành công
                session()->forget('voucher');
            }

            // Xóa các session liên quan sau khi đặt hàng thành công
            session()->forget('selected_products');
            session()->forget('selected_address');
            session()->forget('discount_amount');
            session()->forget('total_payables');
            session()->forget('payment_method');

            DB::commit();

            // Chuyển hướng đến trang 'user.purchase'
            return redirect()->route('user.purchase', ['id' => $userId])->with('thongbao', 'Đặt hàng thành công!');

        } catch (\Exception $e) {
            DB::rollBack();
            // Ghi log lỗi chi tiết
            Log::error('Lỗi lưu đơn hàng: ' . $e->getMessage());
            return redirect()->route('cart.gio-hang')->with('error', 'Có lỗi xảy ra khi đặt hàng. Vui lòng thử lại.');
        }
    }

    private function processVNPAY($totalPayable, $userId)
    {
        $code_cart = rand(00, 9999);
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = route('vnpay.return', ['userId' => $userId]); // URL trả về sau khi thanh toán
        $vnp_TmnCode = "18AB16MA";
        $vnp_HashSecret = "MH03RA1FG6Q1859GFPSKQPKUMY5P5I5G";
        $vnp_TxnRef = $code_cart;
        $vnp_OrderInfo = 'Thanh toán đơn hàng';
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = $totalPayable * 100;
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

        return $vnp_Url; // Trả về URL để điều hướng người dùng đến trang thanh toán VNPay
    }

    public function vnpayCallback(Request $request, $userId)
    {
        $vnp_ResponseCode = $request->input('vnp_ResponseCode');
        $vnp_Amount = $request->input('vnp_Amount');
        $vnp_TxnRef = $request->input('vnp_TxnRef');

        if ($vnp_ResponseCode == '00') {
            return $this->createOrder($request);
        } else {
            return redirect()->route('cart.gio-hang')->with('error', 'Thanh toán không thành công. Vui lòng thử lại.');
        }
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
                'status_6',
                'status_5',
                'status_4',
                'status_3',
                'status_2',
                'status_1',
                'orders_0',
                'orders_1',
                'orders_2',
                'orders_3',
                'orders_4',
                'orders_5',
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
    public function xacnhanDonHang($id_dh)
    {
        $donHang = DonHang::find($id_dh);
        if ($donHang) {
            $donHang->trang_thai = 3;
            $donHang->save();
            return redirect()->back()->with('thongbao', 'Đã nhận được đơn hàng.');
        } else {
            return redirect()->back()->with('thongbao', 'Không tìm thấy đơn hàng.');
        }
    }

}
