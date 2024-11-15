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

    public function sanpham_loai(Request $request, $slug)
    {
        $perpage = 12;
        $danh_muc = DanhMuc::get();
        $query = SanPham::with('danhMuc');
        
        $sortProduct = $request->input('sort', 'moi_nhat'); // Mặc định là sản phẩm mới nhất

        if ($slug == 'tat-ca-san-pham') { $title = 'Mới và Nổi Bật'; } 
        elseif ($slug == 'giam-gia') { $title = 'Giảm Giá'; }

        // Xử lý sắp xếp sản phẩm
        if ($slug == 'tat-ca-san-pham' || $slug == 'giam-gia') {
            if ($slug == 'giam-gia') {
                $query->where('gia_km', '>', 0);
            }
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
            return view('user.all_product', ['products' => $list_product , 'title' => $title , 'danh_muc' => $danh_muc]);
        } else {
            return redirect()->route('home')->with('error', 'Danh mục không tồn tại');
        }
    }

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
            $list_product = SanPham::where('id_dm', $danh_muc->id)->get();
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
