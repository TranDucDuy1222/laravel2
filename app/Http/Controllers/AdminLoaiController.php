<?php

namespace App\Http\Controllers;

use App\Models\DanhMuc as danh_muc;
use App\Models\Loai;
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
        return view('admin.category_add');
    }
}
