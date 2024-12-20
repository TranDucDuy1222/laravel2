<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use App\Models\Size as size;
use App\Models\GioHang;
use App\Models\SanPham;
use App\Models\Loai;
use App\Models\DanhMuc;

Paginator::useBootstrap();

class ProductController extends Controller
{

    private function getCartForCustomer($userId)
    {
        return GioHang::where('user_id', $userId)->get()->keyBy('size'); // Lấy giỏ hàng theo size
    }

    function detail($id)
    {
        $detail = DB::table('san_pham')
            ->select('id', 'ten_sp', 'gia', 'gia_km', 'hinh', 'mo_ta_ngan', 'mo_ta_ct' ,'luot_mua' , 'trang_thai','an_hien')
            ->where('id', $id)
            ->first();

        $query_loai = DB::table('san_pham')
            ->join('danh_muc', 'san_pham.id_dm', '=', 'danh_muc.id')
            ->select('danh_muc.id_loai')
            ->where('san_pham.id', $id)
            ->first();
        
        // Kiểm tra xem $madm có tồn tại không để tránh lỗi null
        if ($query_loai) {
            // Dựa trên id_loai để lấy ra các sản phẩm liên quan
            $relatedpro = DB::table('san_pham')
                ->join('danh_muc', 'san_pham.id_dm', '=', 'danh_muc.id')
                ->join('loai', 'danh_muc.id_loai', '=', 'loai.id')
                ->select('san_pham.id', 'ten_sp', 'gia', 'gia_km', 'hinh', 'danh_muc.ten_dm' ,'mo_ta_ngan' , 'luot_mua' , 'san_pham.trang_thai as trang_thai_san_pham')
                ->where('danh_muc.id_loai', $query_loai->id_loai)
                ->where('san_pham.id', '!=', $id)  // không lấy chính sản phẩm hiện tại
                ->whereNotIn('san_pham.trang_thai', [1])
                ->where('san_pham.an_hien', '!=', 1)
                ->inRandomOrder()
                ->limit(4)
                ->get();
        } else {
            //không tìm thấy id_loai
            $relatedpro = collect(); // Trả về rỗng
        }

        $comment = DB::table('danh_gia')
            ->select('danh_gia.*', 'users.name', 'ctdh.*', 'san_pham.ten_sp', 'san_pham.color' , 'sizes.size_product')
            ->join('users', 'danh_gia.id_user', '=', 'users.id')
            ->join('chi_tiet_don_hang AS ctdh', 'danh_gia.id_ctdh', '=', 'ctdh.id')
            ->join('san_pham', 'san_pham.id', '=', 'ctdh.id_sp')
            ->join('sizes', 'ctdh.id_size', '=', 'sizes.id')
            ->where('danh_gia.id_sp', $id)
            ->where('danh_gia.an_hien', 1)
            ->get();

        $size_arr = DB::table('sizes')
            ->select('sizes.size_product', 'sizes.so_luong')
            ->where('sizes.id_product', $id)
            ->get();

        if (auth()->check()) {
            $currentCustomerId = auth()->user()->id;
            $cart = $this->getCartForCustomer($currentCustomerId);
        } else {
            // Xử lý trường hợp người dùng chưa đăng nhập
            $currentCustomerId = null;
            $cart = null;
        }

        // Đếm số lượng đánh giá cho sản phẩm
        $so_luong_danh_gia = DB::table('danh_gia')
            ->where('id_sp', $id)
            ->count();

        // Truy vấn mã khuyến mãi
        $ma_giam_gia = DB::table('maGiamGia')->select('code' , 'mo_ta')->get();

        return view('user.detail_product', ['ma_giam_gia' => $ma_giam_gia ,'sldg' => $so_luong_danh_gia, 'relatedpro' => $relatedpro, 'detail' => $detail, 'comment' => $comment, 'size' => $size_arr, 'currentCustomerId' => $currentCustomerId, 'cart' => $cart]);
    }

    // Chuyển trang các sản phẩm liên quan khi tìm kiếm
    public function ket_qua_tim_kiem(Request $request)
    {
        $query = $request->input('tim-kiem');
        $sanphamsQuery = SanPham::with('danhMuc')
            ->where('ten_sp', 'like', "%{$query}%")
            ->orWhere('slug', 'like', "%{$query}%");
    
        $sanphams = $sanphamsQuery->get();
        $sanphamsCount = $sanphamsQuery->count();
        // Dữ liệu cài đặt 
        $settings = DB::table('settings')->select('logo_sale' , 'logo_cms' , 'banner_dung_sale' , 'banner_dung_cms')->first();
        
// Kiểm tra nếu không có bản ghi hoặc bản ghi không phải là đối tượng 
if (!$settings || !is_object($settings)) { // Tạo một đối tượng tạm thời với các giá trị mặc định 
    $settings = (object) [ 'logo_sale' => 'default_logo.png', 'logo_cms' => 'default_cms.png', 'banner_dung_sale' => 'default_banner_sale.png', 'banner_dung_cms' => 'default_banner_cms.png', ]; }
    
        return view('user.result_search', compact('settings','sanphams', 'sanphamsCount'));
    }
    

    

}