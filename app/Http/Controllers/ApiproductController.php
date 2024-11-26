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
        } 
        else{
            $category = Loai::where('slug', $slug)->first(); 
            if ($category) { 
                $title = $category->ten_loai; 
            } else { 
                return back()->with('thongbao', 'Loại sản phẩm không tồn tại.'); 
            }
        }

        return view('user.all_product', [
            'title' => $title,
            'slug' => $slug
        ]);
    }

    public function api_sanpham_loai(Request $request, $slug)
    {
        // Kiểm tra slug để xác định hành động
        if ($slug === 'tat-ca-san-pham') {
            $list_product = SanPham::with('sizes')->get();
        } 
        // Lọc sản phẩm giảm giá nếu slug là 'giam-gia'
        else if ($slug === 'giam-gia') {
            $list_product = SanPham::with('sizes')->where('gia_km', '>', 0)->get();
        }
        // Lọc sản phẩm theo loại khác dựa trên slug 
        else { 
            $loai = Loai::where('slug', $slug)->first(); 
            if ($loai) { 
                // Lấy các danh mục thuộc loại đó 
                $danh_muc = DanhMuc::where('id_loai', $loai->id)->get(); 
                // Lấy các sản phẩm trong các danh mục đó 
                $danh_muc_ids = $danh_muc->pluck('id'); 
                $list_product = SanPham::with('sizes')
                ->whereIn('id_dm', $danh_muc_ids)
                ->get(); 
                } else { 
                    return response()->json(['error' => 'Loại sản phẩm không tồn tại.'], 404); 
                } 
            }

        $danh_mucs = DanhMuc::all();

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
            $list_product = collect(); 
            $danh_mucs = collect(); 
        }

        return response()->json([
            'list_product' => $list_product,
            'danh_mucs' => $danh_mucs
        ]);
    }

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
