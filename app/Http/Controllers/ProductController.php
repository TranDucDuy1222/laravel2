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
            ->select('id', 'ten_sp', 'gia', 'gia_km', 'hinh', 'mo_ta_ngan', 'mo_ta_ct' ,'luot_mua' , 'trang_thai')
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
                ->select('san_pham.id', 'ten_sp', 'gia', 'gia_km', 'hinh', 'danh_muc.ten_dm' ,'mo_ta_ngan' , 'luot_mua' )
                ->where('danh_muc.id_loai', $query_loai->id_loai)
                ->where('san_pham.id', '!=', $id)  // không lấy chính sản phẩm hiện tại
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

        return view('user.detail_product', ['sldg' => $so_luong_danh_gia, 'relatedpro' => $relatedpro, 'detail' => $detail, 'comment' => $comment, 'size' => $size_arr, 'currentCustomerId' => $currentCustomerId, 'cart' => $cart]);
    }

    // Sản Phẩm theo danh mục
    public function sanpham_loai(Request $request, $slug)
    {
        $perpage = 12;
        // Khởi tạo query để lấy sản phẩm
        $query = SanPham::with('danhMuc');
        // Kiểm tra slug để xác định hành động
        if ($slug == 'tat-ca-san-pham') {
            $title = 'Mới và Nổi Bật';
        } 
        // Lọc sản phẩm giảm giá nếu slug là 'giam-gia'
        else if ($slug == 'giam-gia') {
            $title = 'Giảm Giá';
            $query->where('gia_km', '>', 0);
        }
        else {
            // Lấy ra loại sản phẩm dựa vào slug
            $loai = Loai::where('slug', $slug)->first();
            // Kiểm tra nếu loại sản phẩm không tồn tại
            if (!$loai) {
                return redirect()->route('home')->with('error', 'Danh mục không tồn tại');
            }
            // Lấy danh sách danh mục thuộc loại sản phẩm đó
            $danh_muc_loai = DanhMuc::where('id_loai', $loai->id)->get();
            // Lấy danh sách sản phẩm thuộc các danh mục đó
            $query = $query->whereIn('id_dm', $danh_muc_loai->pluck('id'));
            $title = $loai->ten_loai; // Đặt tiêu đề là tên loại sản phẩm
        }
        $sortProduct = $request->input('sort', 'moi_nhat'); // Mặc định là sản phẩm mới nhất
        // Xử lý sắp xếp sản phẩm
        switch ($sortProduct) {
            case 'tang_dan':
                $query->orderBy('gia_km', 'asc');
                break;
            case 'giam_dan':
                $query->orderBy('gia_km', 'desc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }

        $list_product = $query->paginate($perpage)->withQueryString();

        return view('user.all_product', [
            'products' => $list_product,
            'title' => $title,
            'danh_muc_loai' => isset($danh_muc_loai) ? $danh_muc_loai : DanhMuc::get() // Lấy danh sách tất cả danh mục nếu không lọc theo loại
        ]);
    }

}