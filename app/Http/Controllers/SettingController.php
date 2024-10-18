<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller
{
    public function index(){
        $setting = DB::table('settings')->first();
        return view('admin.setting' , compact('setting'));
    }
    public function update(Request $request, $id){
        // Lấy dữ liệu hiện tại từ bảng
        $currentData = DB::table('settings')->where('id', $id)->first();
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
                        $oldFile = public_path('uploads/logo/'.$currentData[$key]);
                        if (file_exists($oldFile)) {
                            unlink($oldFile);
                        }
                    }
                    // Lưu file mới vào thư mục
                    $filename = time() . '_' . $file->getClientOriginalName();
                    $file->move(public_path('uploads/logo'), $filename);
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
            DB::table('settings')->where('id', $id)->update($updateData);
        }
    
        return redirect()->route('cai-dat.index')->with('thongbao', 'Cập nhật thành công!');
    }  
}
