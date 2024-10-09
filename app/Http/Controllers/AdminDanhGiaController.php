<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\DanhGia as danh_gia;
use Illuminate\Pagination\Paginator;

Paginator::useBootstrapFive();

class AdminDanhGiaController extends Controller
{
    public function index(Request $request)
{
    $perpage = env('PER_PAGE');

    if($request->has('an_hien')){
        $an_hien = $request['an_hien'];
    }else{
        $an_hien = 1;
    }
    if($an_hien == 0){
        $showall_review = DB::table('danh_gia')
        ->join('users', 'danh_gia.id_user', '=', 'users.id')
        ->join('chi_tiet_don_hang', 'danh_gia.id_ctdh', '=', 'chi_tiet_don_hang.id')
        ->join('san_pham', 'danh_gia.id_sp', '=', 'san_pham.id')
        ->select('danh_gia.*', 'users.name', 'chi_tiet_don_hang.size', 'san_pham.color')
        ->orderByRaw('ISNULL(danh_gia.feedback) ASC') // Sắp xếp theo trạng thái feedback null trước
        ->orderBy('danh_gia.id', 'asc')
        ->where('danh_gia.an_hien', 0)
        ->paginate($perpage)
        ->withQueryString();
    }else{
        $showall_review = DB::table('danh_gia')
        ->join('users', 'danh_gia.id_user', '=', 'users.id')
        ->join('chi_tiet_don_hang', 'danh_gia.id_ctdh', '=', 'chi_tiet_don_hang.id')
        ->join('san_pham', 'danh_gia.id_sp', '=', 'san_pham.id')
        ->select('danh_gia.*', 'users.name', 'chi_tiet_don_hang.size', 'san_pham.color')
        ->orderByRaw('ISNULL(danh_gia.feedback) ASC') // Sắp xếp theo trạng thái feedback null trước
        ->orderBy('danh_gia.id', 'asc')
        ->where('danh_gia.an_hien', 1)
        ->paginate($perpage)
        ->withQueryString();
    }
    
    return view('admin/feedback', compact('showall_review', 'an_hien'));
}
    public function create()
    {

    }
    public function store()
        {
            
        }

    public function edit()
    {
        
    }

    public function update(Request $request, String $id)
    {
        $checkdg = danh_gia::find($id);
        // dd($checkdg);
        if ($checkdg != null && $checkdg != 0) {
            
            if($request->feedback){
                $checkdg->feedback = $request['feedback'];
                $checkdg->save();
            }else{
                return redirect()->back()->with('thongbao', 'Chưa phản hồi đánh giá này');
            }
        }
        return redirect()->back()->with('thongbao', 'Phản hồi đã được gửi thành công.');
    }

    public function destroy()
    {
        
    }

    public function show($id){
        $danh_gia = danh_gia::findOrFail($id);
        
        if ($danh_gia->trang_thai == 0) {
            $danh_gia->trang_thai = 1;
            $danh_gia->save();
        }
        
        return redirect()->route('san-pham.index')->with('thongbao', 'Sản phẩm đã được hiện lại thành công.');
    }

    public function hide($id){
        $danh_gia = danh_gia::findOrFail($id);
        if($danh_gia->an_hien == 1){
            $danh_gia->an_hien = 0; 
            $danh_gia->save();
        }
        return redirect()->route('danh-gia.index')->with('thongbao', 'Đánh giá đã được ẩn thành công.');
    }
}
