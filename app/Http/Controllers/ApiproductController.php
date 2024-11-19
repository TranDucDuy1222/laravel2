<?php

namespace App\Http\Controllers;

use App\Http\Resources\san_pham;
use Illuminate\Http\Request;
use App\Models\SanPham;
use App\Models\Loai;
use App\Models\DanhMuc;
use Log;

class ApiproductController extends Controller
{

    public function sanpham_danhmuc(Request $request, $slug)
    {
        $danh_muc = DanhMuc::where('slug', $slug)->first();
        $title = $danh_muc->ten_dm;

        if ($danh_muc) {
            $list_product = SanPham::where('id_dm', $danh_muc->id)->get();
        } else {
            $list_product = collect(); // Trả về một collection rỗng nếu không tìm thấy danh mục
        }

        return view('user.category', ['title'=> $title ,'products' => $list_product, 'slug' => $slug]);
    }


    public function api_sanpham_danhmuc(Request $request, $slug)
{
    $danh_muc = DanhMuc::where('slug', $slug)->first();

    if ($danh_muc) {
        // Sử dụng with để load mối quan hệ sizes
        $list_product = SanPham::with('sizes')->where('id_dm', $danh_muc->id)->get();
        $danh_mucs = DanhMuc::all(); // Lấy tất cả danh mục
    } else {
        $list_product = collect(); // Trả về một collection rỗng nếu không tìm thấy danh mục
        $danh_mucs = collect(); // Trả về một collection rỗng nếu không tìm thấy danh mục
    }

    return response()->json([
        'list_product' => $list_product,
        'danh_mucs' => $danh_mucs
    ]);
}


}
