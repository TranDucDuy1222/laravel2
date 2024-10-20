<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use App\Models\Size as size;
use App\Models\GioHang;

Paginator::useBootstrap();

class ProductController extends Controller
{

    function __construct()
    {
        $query = DB::table('loai')
        ->select('id', 'ten_loai', 'slug')
        ->orderBy('id', 'asc');
        $loai = $query->get();
        $danh_muc = DB::table('danh_muc')->get();
        \View::share('loai', $loai);
        \View::share('danh_muc', $danh_muc);
    }

    private function getCartForCustomer($userId)
    {
        return GioHang::where('user_id', $userId)->get()->keyBy('size'); // Lấy giỏ hàng theo size
    }

    function detail($id)
    {
        $query = DB::table('san_pham')
            ->select('id', 'ten_sp', 'gia', 'gia_km', 'hinh', 'mo_ta_ngan', 'mo_ta_ct')
            ->where('id', $id);
            
        $detail = $query->first();

        $query = DB::table('san_pham')
            ->select('id_dm')
            ->where('id', $id);
        $madm = $query->first();

        $query = DB::table('san_pham')
            ->select('san_pham.id', 'ten_sp', 'gia', 'gia_km', 'hinh', 'danh_muc.ten_dm')
            ->join('danh_muc', 'san_pham.id_dm', '=', 'danh_muc.id')
            ->where('san_pham.id_dm', $madm->id_dm)
            ->inRandomOrder()
            ->limit(3);

        $relatedpro = $query->get();

        $query = DB::table('danh_gia')
            ->select('danh_gia.*', 'users.name', 'ctdh.*', 'san_pham.ten_sp')
            ->join('users', 'danh_gia.id_user', '=', 'users.id')
            ->join('chi_tiet_don_hang AS ctdh', 'danh_gia.id_ctdh', '=', 'ctdh.id')
            ->join('san_pham', 'san_pham.id', '=', 'ctdh.id')
            ->where('ctdh.id', $id);
        $comment = $query->get();

        $size_arr = DB::table('sizes')
            ->select('sizes.size_product', 'sizes.so_luong')
            ->where('sizes.id_product', $id)
            ->get();

        $currentCustomerId = auth()->user()->id;
        $cart = $this->getCartForCustomer($currentCustomerId);
        return view('user.detail_product', ['relatedpro' => $relatedpro, 'detail' => $detail, 'comment' => $comment, 'size' => $size_arr, 'currentCustomerId' => $currentCustomerId, 'cart' => $cart]);
    }

    // Sản Phẩm theo danh mục
    function category($slug)
    {
        // Xử lý lại hàm này khi truyền slug thì lấy ra id của danh mục đó và sử dụng id_dm đó để tìm sản phẩm thuộc danh mục đó hiển thị ra
        $query = DB::table('san_pham')
            ->select('id', 'ten_sp', 'gia', 'gia_km', 'hinh',  'danh_muc.ten_dm')
            ->join('danh_muc', 'sanpham.id_dm', '=', 'danh_muc.id')
            ->where('san_pham.id', $slug)
            ->orderBy('masp', 'desc');
        $category = $query->paginate(9)->withQueryString();

        $query = DB::table('danh_muc')
            ->select('ten_dm')
            ->where('slug', $slug);
        $danhmuc = $query->first();

        return view('user.category', ['categories' => $category, 'danhmuc1' => $danhmuc]);
    }

    function allproduct()
    {
        $query = DB::table('san_pham')
            ->select('san_pham.id', 'ten_sp', 'gia', 'gia_km', 'hinh', 'danh_muc.ten_dm')
            ->join('danh_muc', 'san_pham.id_dm', '=', 'danh_muc.id')
            ->orderBy('san_pham.id', 'desc');
        $allproduct = $query->paginate(8)->withQueryString();
        return view('user.all_product', compact('allproduct'));
    }

    function sale()
    {
        $query = DB::table('san_pham')
            ->select('id', 'ten_sp', 'gia_km', 'hinh', 'danhmuc.tendm')
            ->join('danhmuc', 'san_pham.madm', '=', 'danhmuc.madm')
            ->where('gia_km', '>', 0)
            ->orderBy('id', 'desc');
        $sale = $query->paginate(8)->withQueryString();
        return view('user.saleproduct', compact('sale'));
    }
}
