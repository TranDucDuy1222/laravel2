<?php

namespace App\Http\Controllers;

use App\Http\Resources\san_pham;
use Illuminate\Http\Request;
use App\Models\SanPham;
use App\Models\Loai;
use App\Models\DanhMuc;
use Log;
use Illuminate\Support\Str;

class ApiproductController extends Controller
{
    // Tất cả sản phẩm hoặc giảm giá
    public function sanpham_loai(Request $request, $slug)
    {
        // Kiểm tra slug để xác định hành động
        if ($slug == 'tat-ca-san-pham') {
            $title = 'Tất cả sản phẩm';
        } 
        // Lọc sản phẩm giảm giá nếu slug là 'giam-gia'
        else if ($slug == 'giam-gia') {
            $title = 'Giảm giá';
        } else{
            return back()->with('thongbao', 'Loại sản phẩm không tồn tại.');
        }

        return view('user.all_product', [
            'title' => $title,
            'slug' => $slug
        ]);
    }

    public function api_sanpham_loai(Request $request, $slug)
    {
        if ($slug === 'tat-ca-san-pham') {
            // Lấy tất cả sản phẩm
            $list_product = SanPham::with('sizes')->get();
            $danh_mucs = DanhMuc::all();
        } else{
            // Lấy những sản phẩm có gia_km lớn hơn 0
            $list_product = SanPham::with('sizes')->where('gia_km', '>', 0)->get();
            $danh_mucs = DanhMuc::all();
        }

        return response()->json([
            'list_product' => $list_product,
            'danh_mucs' => $danh_mucs
        ]);
    }

    // Sản Phẩm theo danh mục
    public function sanpham_danhmuc(Request $request, $slug)
    {
        $danh_muc = DanhMuc::where('slug', $slug)->first();

        if (!$danh_muc) {
            return back()->with('thongbao', 'Danh mục không tồn tại.');
        }

        $title = $danh_muc->ten_dm;
        $list_product = SanPham::with('sizes')->where('id_dm', $danh_muc->id)->get();

        return view('user.category', ['title'=> $title, 'products' => $list_product, 'slug' => $slug]);
    }

    public function api_sanpham_danhmuc(Request $request, $slug)
    {
        $danh_muc = DanhMuc::where('slug', $slug)->first();
        if ($danh_muc) {
            // Sử dụng with để load mối quan hệ sizes
            $list_product = SanPham::with('sizes')->where('id_dm', $danh_muc->id)->get();
            $danh_mucs = DanhMuc::all();
        } else {
            $list_product = collect(); // Trả về một collection rỗng nếu không tìm thấy danh mục
            $danh_mucs = collect(); // Trả về một collection rỗng nếu không tìm thấy danh mục
        }

        return response()->json([
            'list_product' => $list_product,
            'danh_mucs' => $danh_mucs
        ]);
    }

    // Tìm kiếm
    // public function tim_kiem(Request $request, $slug) { 
    //     $keyword = $request->query('q', ''); 
    //     $title = $keyword; 
    //     return view('user.search' , compact('title')); 
    // }

    public function api_tim_kiem(Request $request, $slug)
    {
        $keyword_slug = Str::slug($slug); 
        $products = SanPham::with('sizes')
        ->where('slug', 'LIKE', '%' . $keyword_slug . '%')
        ->orWhere('ten_sp', 'LIKE', '%' . $slug . '%')
        ->get(); 
        return response()->json([ 'products' => $products ]); 
    }


}
