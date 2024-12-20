<?php

namespace App\Http\Controllers;

use App\Models\DanhMuc as danh_muc;
use App\Models\GioHang;
use App\Models\Loai;
use App\Models\SanPham as san_pham;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Log;
Paginator::useBootstrap();

class AdminLoaiController extends AdminController
{

    public function index(Request $request) {
        $perPage = env('PER_PAGE');
        $loai_arr = Loai::orderBy('id', 'asc')->get();
        $slug = $request->input('slug', 'All');
        $trangThai = $request->input('trang_thai', '0');
        $loai = null;
    
        $query = danh_muc::select('danh_muc.*', 'loai.ten_loai')
            ->join('loai', 'danh_muc.id_loai', '=', 'loai.id');
    
        // Mặc định chỉ hiển thị các danh mục có trang_thai = 0
        if ($trangThai === '0') {
            $query->where('danh_muc.trang_thai', '0');
        }
        // Ngược lại sẽ hiển thị danh mục dựa trên request trả về cho $trangThai 
        else {
            $query->where('danh_muc.trang_thai', $trangThai);
        }
        
        // Nếu request trả về cho slug không phải 'All' thì sẽ hiển thị danh mục dựa trên slug
        if ($slug !== 'All') {
            $loai = Loai::select('id')->where('slug', $slug)->first();
            if ($loai) {
                $query->where('loai.id', $loai->id);
            }
        }
    
        $danhmuc_arr = $query->orderBy('danh_muc.id', 'desc')
            ->paginate($perPage)
            ->withQueryString();
    
        return view('admin.category', compact('loai_arr', 'danhmuc_arr', 'slug', 'trangThai'));
    }
    
    

    public function create() {
        $loai_arr = Loai::all();
        return view('admin.category_add', compact('loai_arr'));
    }
    public function store(Request $request){
        $request->validate([
            'ten_dm' =>'required|unique:danh_muc,ten_dm',
            'id_loai' =>'required|min:1'
        ]);
        
        $checkDanhMuc = danh_muc::where('ten_dm', $request->input('ten_dm'))->first();
        if($checkDanhMuc){
            return redirect()->back()->with('thongbao', 'Tên danh mục đã tồn tại');
        }
        //dd($request->all());
        $id_loai = (int)$request['id_loai'];
        if($id_loai>0){
            $danhmuc_new = new danh_muc();
            $danhmuc_new->ten_dm = $request['ten_dm'];
            $danhmuc_new->slug = Str::slug($request['ten_dm']);
            $danhmuc_new->trang_thai = 0;
            $danhmuc_new->an_hien = 0;
            $danhmuc_new->thu_tu = 0;
            $danhmuc_new->id_loai = $id_loai;
            $danhmuc_new->save();
        }
        else{
            return redirect()->back()->with('thongbao', 'Bạn phải chọn loại danh mục');
        }

        return redirect()->route('danh-muc.index')->with('thongbao', 'Thêm danh mục thành công');
    }
    public function delete(Request $request , string $id){
        // Kiểm tra xem có sản phẩm nào thuộc danh mục này không
        $sanPhamCount = san_pham::where('id_dm', $id)->count();
        $danhMuc = danh_muc::find($id);
        if ($sanPhamCount > 0) {
            return redirect()->back()->with('thongbao', 'Danh mục này đã có sản phẩm, bạn không thể xóa');
        }
        if ($sanPhamCount == 0) {
            $danhMuc->delete();
        }
        return redirect()->route('danh-muc.index')->with('thongbao', 'Xóa danh mục thành công');
    }


    // public function edit(Request $request, string $id){
    //     $danhMuc = danh_muc::find($id);
    //     $loai_arr = Loai::all();
    //     return view('admin.category_edit', compact('danhMuc', 'loai_arr'));
    // }
    public function update(Request $request, string $id)
    {
        $request->validate([
            'ten_dm' => 'required',
            'id_loai' => 'required|min:1'
        ]);
    
        // Kiểm tra xem có bản ghi nào trùng với ten_dm và id_loai không
        $exists = danh_muc::where('ten_dm', $request->ten_dm)
                          ->where('id_loai', $request->id_loai)
                          ->where('id', '!=', $id) // Loại trừ bản ghi hiện tại
                          ->exists();
    
        if ($exists) {
            // Nếu trùng, hiển thị thông báo lỗi
            return redirect()->back()->withErrors(['ten_dm' => 'Tên danh mục và loại đã tồn tại.']);
        }
    
        // Nếu không trùng, tiến hành cập nhật
        $danhMuc = danh_muc::find($id);
        $danhMuc->ten_dm = $request->ten_dm;
        $danhMuc->slug = Str::slug($request->ten_dm);
        $danhMuc->id_loai = $request->id_loai;
        $danhMuc->save();
    
        return redirect()->route('danh-muc.index')->with('thongbao', 'Cập nhật danh mục thành công');
    }

    public function hidden(Request $request, string $id) {
        // Tìm đối tượng danh_muc theo ID
        $danhMuc = danh_muc::find($id);
        // Kiểm tra và cập nhật trạng thái của danh_muc
        if ($danhMuc->trang_thai == 0) {
            $danhMuc->trang_thai = 1;
            $danhMuc->save();
        }
        // Tìm các sản phẩm có id_dm bằng với id truyền vào và cập nhật trạng thái
        $sanPhams = san_pham::where('id_dm', $id)->get();
        foreach ($sanPhams as $sanPham) {
            $sanPham->an_hien = 1;
            $sanPham->save();
            GioHang::where('id_sp', $sanPham->id)->update(['an_hien' => 1]);

        }
    
        return redirect()->back()->with('thongbao', 'Đã ẩn danh mục và sản phẩm thuộc danh mục.');
    }
    
    public function show(Request $request , string $id){
                // Tìm đối tượng danh_muc theo ID từ route 
                $danhMuc = danh_muc::find($id);
                // Kiểm tra và cập nhật trạng thái của danh_muc
                if ($danhMuc->trang_thai == 1) {
                    $danhMuc->trang_thai = 0;
                    $danhMuc->save();
                }
                // Tìm các sản phẩm có id_dm bằng với id truyền vào và cập nhật trạng thái
                $sanPhams = san_pham::where('id_dm', $id)->get();
                foreach ($sanPhams as $sanPham) {
                    $sanPham->an_hien = 0;
                    $sanPham->save();
                    // Cập nhật trạng thái an_hien cho các sản phẩm trong giỏ hàng có id_sp đang ẩn
                    GioHang::where('id_sp', $sanPham->id)->update(['an_hien' => 0]);
                }
                return redirect()->back()->with('thongbao', 'Đã hiển thị danh mục và sản phẩm thuộc danh mục.');
    }
    

}
