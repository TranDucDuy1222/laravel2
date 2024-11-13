<?php

namespace App\Http\Controllers;

use App\Http\Resources\san_pham;
use Illuminate\Http\Request;
use App\Models\SanPham;
use App\Models\Loai;
use App\Models\DanhMuc;

class ApiproductController extends Controller
{
    public function sanpham_loai(Request $request, $slug)
    {
        if ($slug == 'tat-ca-san-pham') {
            // Lấy tất cả sản phẩm kèm theo tên danh mục
            $list_product = SanPham::with('danhMuc')->get();
        } elseif ($slug == 'giam-gia') {
            // Lấy những sản phẩm có gia_km lớn hơn 0 kèm theo tên danh mục
            $list_product = SanPham::with('danhMuc')->where('gia_km', '>', 0)->get();
        } else {
            $list_product = collect(); // Trả về một collection rỗng nếu không tìm thấy loại
            
        }
    
        // Kiểm tra dữ liệu trước khi trả về
        //dd($list_product);
    
        return response()->json($list_product);
    }    

    public function sanpham_danhmuc(Request $request, $slug)
    {
        // Tìm danh mục dựa trên slug
        $danh_muc = DanhMuc::where('slug', $slug)->first();

        if ($danh_muc) {
            // Lấy các sản phẩm có id_dm tương ứng với id của danh mục
            $list_product = SanPham::where('id_dm', $danh_muc->id)->get();
        } else {
            $list_product = collect(); // Trả về một collection rỗng nếu không tìm thấy danh mục
        }

        dd($list_product);
        // Trả về dữ liệu dạng JSON
        return response()->json($list_product);
    }
}
