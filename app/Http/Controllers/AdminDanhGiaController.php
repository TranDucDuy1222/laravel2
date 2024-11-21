<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\DanhGia as danh_gia;
use Illuminate\Pagination\Paginator;

Paginator::useBootstrapFive();

class AdminDanhGiaController extends AdminController
{
    public function index(Request $request)
    {
        $perpage = env('PER_PAGE', 10);  // Đặt giá trị mặc định nếu không tìm thấy trong .env
        $an_hien = $request->input('an_hien', 1);

        $query = DB::table('danh_gia')
            ->join('users', 'danh_gia.id_user', '=', 'users.id')
            ->join('chi_tiet_don_hang', 'danh_gia.id_ctdh', '=', 'chi_tiet_don_hang.id')
            ->join('san_pham', 'danh_gia.id_sp', '=', 'san_pham.id')
            ->join('sizes', 'chi_tiet_don_hang.id_size', '=', 'sizes.id')
            ->select('danh_gia.*', 'users.name', 'chi_tiet_don_hang.id_size', 'san_pham.color' , 'sizes.size_product')
            ->where('danh_gia.an_hien', $an_hien)
            ->orderByRaw('IFNULL(danh_gia.feedback, 1) ASC')
            ->orderBy('danh_gia.id', 'asc');

        $showall_review = $query->paginate($perpage)->withQueryString();

        return view('admin.feedback', compact('showall_review', 'an_hien'));
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

    public function update(Request $request, $id)
    {
        $checkdg = danh_gia::find($id);
        if ($checkdg != null) {
            // Kiểm tra xem feedback có tồn tại và không rỗng
            if ($request->has('feedback') && !empty($request->feedback)) {
                $checkdg->feedback = $request->feedback;
                $checkdg->save();
                return redirect()->back()->with('thongbao', 'Phản hồi đã được gửi thành công.');
            } else {
                return redirect()->back()->with('thongbao', 'Chưa phản hồi đánh giá này');
            }
        } else {
            return redirect()->back()->with('thongbao', 'Không tìm thấy đánh giá này');
        }
    }


    public function destroy()
    {
        
    }

    public function show($id){
        $danh_gia = danh_gia::findOrFail($id);
        
        if ($danh_gia->an_hien == 0) {
            $danh_gia->an_hien = 1;
            $danh_gia->save();
        }
        
        return redirect()->route('danh-gia.index')->with('thongbao', 'Đánh giá đã được hiện lại thành công.');
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
