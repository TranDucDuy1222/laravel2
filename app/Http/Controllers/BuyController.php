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


    public function pay(Request $request) {
        $userId = Auth::id();
        $selectedProductIds = $request->input('selected_products', session('selected_products', []));
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
    
    // private function handleInvalidVoucher($selectedProductIds) {
    //     $userId = Auth::id();
    //     $gioHangs = GioHang::with(['sanPham', 'size'])
    //                 ->whereIn('id', $selectedProductIds)
    //                 ->where('user_id', $userId)
    //                 ->get();
    //     $diachis = DiaChi::where('id_user', $userId)->get();
    //     $totalAmount = $gioHangs->sum(function ($item) {
    //         return $item->sanPham->gia_km > 0 ? $item->sanPham->gia_km * $item->so_luong : $item->sanPham->gia * $item->so_luong;
    //     });
    //     $discountAmount = 0;
    //     $totalPayable = $totalAmount - $discountAmount;
    //     $availableVouchers = MaGiamGia::where('is_active', true)->get();
    //     $pays = $gioHangs;
    
    //     return view('user.home_thanhtoan', compact('pays', 'diachis', 'totalPayable', 'discountAmount', 'availableVouchers'));
    // }
    
    //     // Lưu thông tin mã giảm giá và mức giảm vào session
    //     session(['voucher' => [
    //         'code' => $voucherCode,
    //         'amount' => $voucher->phan_tram
    //     ]]);
    
    //     return redirect()->route('pay')->with('success', 'Áp dụng mã giảm giá thành công!');
    // }
    
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
    public function thanh_toan_vnpay(){
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "https://localhost/vnpay_php/vnpay_return.php";
        $vnp_TmnCode = "18AB16MA";//Mã website tại VNPAY 
        $vnp_HashSecret = "MH03RA1FG6Q1859GFPSKQPKUMY5P5I5G"; //Chuỗi bí mật
        
        $vnp_TxnRef = $_POST['order_id']; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = $_POST['order_desc'];
        $vnp_OrderType = $_POST['order_type'];
        $vnp_Amount = $_POST['amount'] * 100;
        $vnp_Locale = $_POST['language'];
        $vnp_BankCode = $_POST['bank_code'];
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        //Add Params of 2.0.1 Version
        $vnp_ExpireDate = $_POST['txtexpire'];
        //Billing
        $vnp_Bill_Mobile = $_POST['txt_billing_mobile'];
        $vnp_Bill_Email = $_POST['txt_billing_email'];
        $fullName = trim($_POST['txt_billing_fullname']);
        if (isset($fullName) && trim($fullName) != '') {
            $name = explode(' ', $fullName);
            $vnp_Bill_FirstName = array_shift($name);
            $vnp_Bill_LastName = array_pop($name);
        }
        $vnp_Bill_Address=$_POST['txt_inv_addr1'];
        $vnp_Bill_City=$_POST['txt_bill_city'];
        $vnp_Bill_Country=$_POST['txt_bill_country'];
        $vnp_Bill_State=$_POST['txt_bill_state'];
        // Invoice
        $vnp_Inv_Phone=$_POST['txt_inv_mobile'];
        $vnp_Inv_Email=$_POST['txt_inv_email'];
        $vnp_Inv_Customer=$_POST['txt_inv_customer'];
        $vnp_Inv_Address=$_POST['txt_inv_addr1'];
        $vnp_Inv_Company=$_POST['txt_inv_company'];
        $vnp_Inv_Taxcode=$_POST['txt_inv_taxcode'];
        $vnp_Inv_Type=$_POST['cbo_inv_type'];
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
            "vnp_ExpireDate"=>$vnp_ExpireDate,
            "vnp_Bill_Mobile"=>$vnp_Bill_Mobile,
            "vnp_Bill_Email"=>$vnp_Bill_Email,
            "vnp_Bill_FirstName"=>$vnp_Bill_FirstName,
            "vnp_Bill_LastName"=>$vnp_Bill_LastName,
            "vnp_Bill_Address"=>$vnp_Bill_Address,
            "vnp_Bill_City"=>$vnp_Bill_City,
            "vnp_Bill_Country"=>$vnp_Bill_Country,
            "vnp_Inv_Phone"=>$vnp_Inv_Phone,
            "vnp_Inv_Email"=>$vnp_Inv_Email,
            "vnp_Inv_Customer"=>$vnp_Inv_Customer,
            "vnp_Inv_Address"=>$vnp_Inv_Address,
            "vnp_Inv_Company"=>$vnp_Inv_Company,
            "vnp_Inv_Taxcode"=>$vnp_Inv_Taxcode,
            "vnp_Inv_Type"=>$vnp_Inv_Type
        );
        
        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }
        
        //var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
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
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array('code' => '00'
            , 'message' => 'success'
            , 'data' => $vnp_Url);
            if (isset($_POST['redirect'])) {
                header('Location: ' . $vnp_Url);
                die();
            } else {
                echo json_encode($returnData);
            }
            // vui lòng tham khảo thêm tại code demo
    }

}

