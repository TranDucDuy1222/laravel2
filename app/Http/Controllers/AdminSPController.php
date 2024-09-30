<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SanPham as san_pham;
use App\Models\DanhMuc as danh_muc;
use App\Models\Size as size;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;

Paginator::useBootstrap();

class AdminSPController extends Controller
{
    function index(Request $request)
    {
        $id_dm = -1;
        $perpage = env('PER_PAGE');
        $loai_arr = danh_muc::all();
        $size_arr = size::all(); 
        $idsp = DB::table('san_pham')->pluck('id');


        if ($request->has('id_dm')) {
            $id_dm = (int) $request['id_dm'];
        }

        if ($request->has('trangthai')) {
            $trangthai = $request['trangthai'];
        } else {
            $trangthai = 1;
        }
        if ($trangthai == 3) {
            $sanpham_arr = san_pham::onlyTrashed()->orderBy('masp', 'desc')
                ->paginate($perpage)->withQueryString();
            return view('admin/product_admin_delete', compact(['trangthai', 'id_dm', 'sanpham_arr', 'loai_arr']));
        } elseif ($trangthai == 2) {
            $sanpham_arr = san_pham::join('danh_muc', 'san_pham.id_dm', '=', 'danh_muc.id')
                ->where('san_pham.trang_thai', 2)
                ->orderBy('san_pham.id_dm', 'desc')
                ->paginate($perpage)
                ->withQueryString();
            return view('admin/product_admin', compact(['trangthai', 'id_dm', 'sanpham_arr', 'loai_arr']));
        } else {
            if ($id_dm > 0) {
                $sanpham_arr = san_pham::join('danh_muc', 'san_pham.id_dm', '=', 'danh_muc.id')
                    ->select('san_pham.*', 'danh_muc.ten_dm')
                    ->orderBy('san_pham.id', 'desc')
                    ->where('san_pham.id_dm', $id_dm)
                    ->paginate($perpage)
                    ->withQueryString();
                return view('admin/product_admin', compact(['trangthai','id_dm', 'sanpham_arr', 'loai_arr']));
            } else {
                $sanpham_arr = san_pham::join('danh_muc', 'san_pham.id_dm', '=', 'danh_muc.id')
                    ->select('san_pham.*', 'danh_muc.ten_dm')
                    ->orderBy('san_pham.id', 'desc')
                    ->where('san_pham.trang_thai', 1)
                    ->paginate($perpage)
                    ->withQueryString();
            }
            return view('admin/product_admin', compact(['trangthai', 'id_dm', 'sanpham_arr', 'loai_arr', 'size_arr', 'idsp']));
        }
    }
    public function create()
    {
        $loai_arr = DB::table('danh_muc')->orderBy('id', 'asc')->get();
        return view('admin.product_add_admin', compact('loai_arr'));
    }
    public function store(Request $request)
    {
        // Kiểm tra xem tên sản phẩm đã tồn tại trong cơ sở dữ liệu hay chưa
        $checkProduct = san_pham::where('ten_sp', $request['ten_sp'])->first();
        if ($checkProduct) {
            return redirect()->back()->with('thongbao', 'Tên sản phẩm đã tồn tại. Vui lòng chọn tên khác.');
        }
        $size = new size();
        $size->so_luong = $request['so_luong'];
        $size->size_product = $request['size_product'];
        
        $obj = new  san_pham();
        $obj->ten_sp = $request['ten_sp'];
        $obj->slug = Str::slug($obj->ten_sp);
        $obj->gia = (int) $request['gia'];
        $obj->gia_km = (int) $request['gia_km'];
        // Kiểm tra nếu giakhuyenmai lớn hơn gia, gán giakhuyenmai bằng 0
        if ($obj->gia_km > $obj->gia) {
            $obj->gia_km = 0;
        }
        $obj->id_dm = (int) $request['id_dm'];
        
        // Lấy tệp tin từ trường input file
        if ($request->hasFile('hinh')) {
            $file = $request->file('hinh');
            $fileName = $file->getClientOriginalName();
            $file->move(public_path('/imgnew'), $fileName);
            $obj->hinh = $fileName;
        }
        $obj->mo_ta_ct = $request['mo_ta_ct'];
        // $obj->mo_ta_ngan = $request['mo_ta_ngan'];
        // $obj->trang_thai = $request['trang_thai'];
        // $obj->tinh_chat = $request['tinh_chat'];
        // $obj->color = $request['color'];
        $obj->ngay = now();
        $obj->save();
        return redirect(route('san-pham.index'))->with('thongbao', 'Thêm thành công');
    }

    function khoiphuc($id)
    {
        $sp = san_pham::withTrashed()->find($id);
        if ($sp == null) return redirect('/thongbao');
        $sp->restore();
        return redirect('/admin/san-pham?trangthai=3');
    }
    function xoavinhvien($id)
    {
        $sp = san_pham::withTrashed()->find($id);
        if ($sp == null) return redirect('/thongbao');
        $sp->forceDelete();
        return redirect('/admin/san-pham')->with('thongbao', 'Sản Phẩm Đã Được Xóa Vĩnh Viễn!');
    }

    public function edit(Request $request, string $id)
    {
        $sp = san_pham::where('masp', $id)->first();
        if ($sp == null) {
            $request->session()->flash('thongbao', 'Không có sản phẩm này: ' . $id);
            return redirect('/admin/sanpham');
        }
        $loai_arr = DB::table('danhmuc')->orderBy('madm', 'asc')->get();
        return view('admin/product_edit_admin', compact(['sp', 'loai_arr']));
    }

    public function update(Request $request, string $id)
    {
        $obj = san_pham::find($id);
        $obj->tensp = $request['tensp'];
        $obj->slug = Str::slug($obj->tensp);
        $obj->gia = (int) $request['gia'];
        $obj->giakhuyenmai = (int) $request['giakhuyenmai'];
        $obj->madm = (int) $request['madm'];
        $obj->ngay = $request['ngay'];
        $obj->hinh = $request['hinh'];
        $obj->soluong = $request['soluong'];
        $obj->motangan = $request['motangan'];
        $obj->motachitiet = $request['motachitiet'];
        $obj->save();
        return redirect(route('san-pham.index'))->with('thongbao', 'Cập nhập thành công');
    }

    public function destroy(Request $request, string $id)
    {
        $cokhong = san_pham::where('masp', $id)->exists();
        if ($cokhong == false) {
            $request->session()->flash('thongbao', 'Sản phẩm không tồn tại');
            return redirect('/admin/san-pham');
        }
        san_pham::where('masp', $id)->delete();
        $request->session()->flash('thongbao', 'Đã xóa sản phẩm');
        return redirect('/admin/san-pham');
    }
}
