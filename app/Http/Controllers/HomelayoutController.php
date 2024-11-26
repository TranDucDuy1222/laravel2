<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\Loai;
use DB;

class HomelayoutController extends AdminController
{
    public function index(Request $request){
        $loai_arr = Loai::all();
        //$first_loai = $loai_arr->first(); // Lấy loại đầu tiên
        $query = DB::table('san_pham')->select('san_pham.id' , 'ten_sp' , 'gia', 'gia_km' , 'hinh', 'san_pham.trang_thai', 'danh_muc.ten_dm')
        ->join('danh_muc', 'san_pham.id_dm', '=', 'danh_muc.id')
        ->orderBy('san_pham.id', 'desc');
        
        $sanphamhome = (clone $query)->limit(2)->get();
        // Sản phảm mới
        $sanphamnew = (clone $query)
        ->where('san_pham.trang_thai', '!=', 3)
        ->limit(4)
        ->get();

        // Sản phẩm khuyến mãi
        $sanphamsale = (clone $query)
        ->where('san_pham.gia_km','>',0)
        ->where('san_pham.trang_thai', '!=', 3)
        ->inRandomOrder()
        ->limit(4)
        ->get();    

        // Sản phẩm sắp về hàng
        $sanphamcs = (clone $query)->where('san_pham.trang_thai','=',3)->limit(4)->get();

        // Sản phẩm theo loại
        $query_theoloai = DB::table('san_pham')
        ->select('san_pham.id', 'ten_sp', 'gia', 'gia_km', 'hinh','san_pham.trang_thai', 'danh_muc.ten_dm')
        ->join('danh_muc', 'san_pham.id_dm', '=', 'danh_muc.id')
        ->join('loai', 'danh_muc.id_loai', '=', 'loai.id')
        ->inRandomOrder() // Random sản phẩm
        ->limit(4); // Lấy ra 4 sản phẩm

        $sanpham = [];
        foreach ($loai_arr as $loai) {
            $sanpham[$loai->slug] = (clone $query_theoloai)->where('loai.slug', $loai->slug)->get();
        }

        // Dữ liệu trang chủ
        $home_page = DB::table('home_layout')->first();
        return view('admin/home_landingpage' , compact('home_page','sanphamhome', 'sanphamnew', 'sanphamsale', 'sanphamcs' , 'loai_arr', 'sanpham'));
    }

    public function update(Request $request, $id){
        // Lấy dữ liệu hiện tại từ bảng
        $currentData = DB::table('home_layout')->where('id', $id)->first();
        // Chuyển đổi thành mảng
        $currentData = (array) $currentData;
        // Lấy dữ liệu từ request
        $newData = $request->except('_token', '_method', 'id');
        // Các định dạng file hợp lệ
        $validExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        // Dữ liệu cần cập nhật
        $updateData = [];
    
        // Kiểm tra từng cột và chỉ thêm những cột thay đổi vào mảng updateData
        foreach ($newData as $key => $value) {
            if ($request->hasFile($key)) {
                // Kiểm tra định dạng file
                $file = $request->file($key);
                $extension = $file->getClientOriginalExtension();
                if (in_array(strtolower($extension), $validExtensions)) {
                    // Xóa file cũ
                    if (!empty($currentData[$key])) {
                        $oldFile = public_path('uploads/banner/'.$currentData[$key]);
                        if (file_exists($oldFile)) {
                            unlink($oldFile);
                        }
                    }
                    // Lưu file mới vào thư mục
                    $filename = time() . '_' . $file->getClientOriginalName();
                    $file->move(public_path('uploads/banner'), $filename);
                    // Cập nhật đường dẫn file mới vào database
                    $updateData[$key] = $filename;
                } else {
                    return redirect()->back()->withErrors(['thongbao' => 'Định dạng file không hợp lệ! Chỉ chấp nhận các định dạng: jpg, jpeg, png, gif, webp.']);
                }
            } elseif ($value !== null) {
                // Nếu giá trị không null và khác giá trị hiện tại
                if (isset($currentData[$key]) && $currentData[$key] != $value) {
                    $updateData[$key] = $value;
                }
            } else {
                // Nếu không có thay đổi ở trường này, giữ nguyên giá trị hiện tại
                $updateData[$key] = $currentData[$key];
            }
        }
    
        // Nếu có dữ liệu thay đổi, tiến hành cập nhật
        if (!empty($updateData)) {
            DB::table('home_layout')->where('id', $id)->update($updateData);
        }
    
        return redirect()->route('trang-chu.index')->with('thongbao', 'Cập nhật thành công!');
    }    
    
}
