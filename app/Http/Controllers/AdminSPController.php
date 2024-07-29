<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SanPham;
use App\Models\Loai;
use Illuminate\Support\Str;
use DB;
use Illuminate\Pagination\Paginator;
Paginator::useBootstrap();

class AdminSPController extends Controller
{
    function index(Request $request){
        $id_loai = -1;
        $perpage = env('PER_PAGE');
        $loai_arr = Loai::all();    
        if ($request->has('madm')) {
            $id_loai = (int) $request['madm'];
            $trangthai= 1; //chuaxoa, daxoa
        }
        if ($request->has('trangthai')){
            $trangthai = $request['trangthai'];
        }else {
            $trangthai = 1;
        }

        if ($trangthai== 3){
            $sanpham_arr = SanPham::onlyTrashed()->orderBy('masp','desc')
            ->paginate($perpage)->withQueryString();
            return view('admin/product_admin_delete',compact(['trangthai','id_loai','sanpham_arr','loai_arr']));
        }
        elseif ($trangthai == 2) {
            $sanpham_arr = SanPham::join('danhmuc', 'sanpham.madm', '=', 'danhmuc.madm')
            ->where('sanpham.trangthai', 2)
            ->orderBy('sanpham.masp', 'desc')
            ->paginate($perpage)
            ->withQueryString();
            return view('admin/product_admin',compact(['trangthai','id_loai','sanpham_arr','loai_arr']));

        }
        else {
            if ($id_loai>0){
                $sanpham_arr = SanPham::join('danhmuc', 'sanpham.madm', '=', 'danhmuc.madm')
                ->orderBy('sanpham.masp', 'desc')
                ->where('sanpham.madm', $id_loai)
                ->paginate($perpage)
                ->withQueryString();
            } else {
                $sanpham_arr = SanPham::join('danhmuc', 'sanpham.madm', '=', 'danhmuc.madm')
                ->orderBy('sanpham.masp', 'desc')
                ->where('sanpham.trangthai', 1)
                ->paginate($perpage)
                ->withQueryString();
            }
            return view('admin/product_admin',compact(['trangthai','id_loai','sanpham_arr','loai_arr']));
        }
    }
    public function create()
    {
        $loai_arr = DB::table('danhmuc')->orderBy('madm' , 'asc')->get();
        return view('admin.product_add_admin',compact('loai_arr'));
    
    }
    public function store(Request $request)
    {
        // Kiểm tra xem tên sản phẩm đã tồn tại trong cơ sở dữ liệu hay chưa
        $checkProduct = SanPham::where('tensp', $request['tensp'])->first();
        if ($checkProduct) {
            return redirect()->back()->with('thongbao', 'Tên sản phẩm đã tồn tại. Vui lòng chọn tên khác.');
        }
        $obj = new  SanPham();
        $obj->tensp = $request['tensp'];
        $obj->slug = Str::slug($obj->tensp);
        $obj->gia = (int) $request['gia'];
        $obj->giakhuyenmai = (int) $request['giakhuyenmai'];
        // Kiểm tra nếu giakhuyenmai lớn hơn gia, gán giakhuyenmai bằng 0
        if ($obj->giakhuyenmai > $obj->gia) {
            $obj->giakhuyenmai = 0;
        }
        $obj->madm = (int) $request['madm'];
        $obj->ngay = now();  
        // Lấy tệp tin từ trường input file
        if ($request->hasFile('anhsp')) {
            $file = $request->file('anhsp');
            $fileName = $file->getClientOriginalName();
            $file->move(public_path('/imgnew'), $fileName);
            $obj->anhsp = $fileName;
        }        
        $obj->soluong = $request['soluong'];
        $obj->motangan = $request['motangan'];
        $obj->motachitiet = $request['motachitiet']; 
        $obj->save();
        return redirect(route('san-pham.index'))->with('thongbao','Thêm thành công');
    
    }

    function khoiphuc($id) {
            $sp = SanPham::withTrashed()->find($id);
            if ($sp == null) return redirect('/thongbao');
            $sp->restore();
            return redirect('/admin/san-pham?trangthai=3');
    }
    function xoavinhvien($id) {
        $sp = SanPham::withTrashed()->find($id);
        if ($sp == null) return redirect('/thongbao');
        $sp->forceDelete();
        return redirect('/admin/san-pham')->with('thongbao', 'Sản Phẩm Đã Được Xóa Vĩnh Viễn!');
    }

    public function edit( Request $request , string $id) {
        $sp = SanPham::where('masp', $id)->first();
        if ($sp==null){
            $request->session()->flash('thongbao','Không có sản phẩm này: '. $id);
            return redirect('/admin/sanpham');
        }
        $loai_arr = DB::table('danhmuc')->orderBy('madm' , 'asc')->get();
        return view('admin/product_edit_admin' , compact(['sp','loai_arr']));
    }

    public function update(Request $request, string $id) {
        $obj = SanPham::find($id);
        $obj->tensp = $request['tensp'];
        $obj->slug = Str::slug($obj->tensp);     
        $obj->gia = (int) $request['gia'];
        $obj->giakhuyenmai = (int) $request['giakhuyenmai'];
        $obj->madm = (int) $request['madm'];
        $obj->ngay = $request['ngay']; 
        $obj->anhsp = $request['anhsp'];
        $obj->soluong = $request['soluong'];
        $obj->motangan = $request['motangan'];
        $obj->motachitiet = $request['motachitiet'];
        $obj->save();
        return redirect(route('san-pham.index'))->with('thongbao', 'Cập nhập thành công');
    }

    public function destroy( Request $request, string $id) 
    {
        $cokhong = SanPham::where('masp', $id)->exists();
        if ($cokhong==false) {
            $request->session()->flash('thongbao','Sản phẩm không tồn tại');
            return redirect('/admin/san-pham');
        }
        SanPham::where('masp', $id)->delete();
        $request->session()->flash('thongbao', 'Đã xóa sản phẩm');
        return redirect('/admin/san-pham');
    }
}
