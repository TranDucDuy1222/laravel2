<?php

namespace App\Http\Controllers;

use App\Models\DanhMuc as danh_muc;
use App\Models\Loai;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
Paginator::useBootstrap();

class AdminLoaiController extends Controller
{

    public function index(Request $request) {
        $perPage = env('PER_PAGE');
        $loai_arr = Loai::orderBy('id', 'asc')->get();
        $slug = null;
        $loai = null;
    
        if ($request->has('slug')) {
            $slug = $request->input('slug');
            $loai = Loai::select('id')->where('slug', $slug)->first();
        }
        if (is_null($slug) || is_null($loai)) {
            $danhmuc_arr = danh_muc::select('danh_muc.*', 'loai.ten_loai')
                ->join('loai', 'danh_muc.id_loai', '=', 'loai.id')
                ->orderBy('danh_muc.id', 'asc')
                ->paginate($perPage)
                ->withQueryString();
        } else {
            $danhmuc_arr = danh_muc::select('danh_muc.*', 'loai.ten_loai')
                ->join('loai', 'danh_muc.id_loai', '=', 'loai.id')
                ->where('loai.id', $loai->id)
                ->orderBy('danh_muc.id', 'asc')
                ->paginate($perPage)
                ->withQueryString();
        }
        return view('admin.category', compact('loai_arr', 'danhmuc_arr', 'slug'));
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
    
}
