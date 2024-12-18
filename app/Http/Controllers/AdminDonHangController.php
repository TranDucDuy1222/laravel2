<?php

namespace App\Http\Controllers;

use App\Models\DonHang;
use App\Models\ChiTietDonHang;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class AdminDonHangController extends AdminController
{
    public function index(Request $request)
    {
        $perpage = 15;
        $query = DonHang::query();

        // Chỉ hiển thị các đơn hàng có trạng thái "Chưa xử lý"
        if (!$request->has('trang_thai')) {
            $query->where('trang_thai', 0);
        } 
        if ($request->filled('trang_thai')) {
            $query->where('trang_thai', $request->trang_thai);
        }

        $donHangs = $query->orderBy('id', 'ASC')->paginate($perpage)->withQueryString();
        // Tìm kiếm theo ID
        if ($request->filled('id')) {
            $query->where('id', $request->id);
        }
        $allValid = $donHangs->every(function ($donHang) { 
            return $donHang->trang_thai != 0 && $donHang->trang_thai != 3 && $donHang->trang_thai != 4 && $donHang->trang_thai != 5; 
        });

        return view('admin.order', compact('donHangs' , 'allValid'));
    }

    public function show($id)
    {
        $donHang = DonHang::with(['chiTietDonHangs.sanPham', 'user', 'chiTietDonHangs.size'])->findOrFail($id);
        return view('admin.order_detail', compact('donHang'));
    }


    public function update(Request $request, $id)
    {
    }

    public function updateTrangThai(Request $request, $id)
    {
        $request->validate([
            'trang_thai' => 'required|integer|in:1,2,3,5',
        ]);

        $donHang = DonHang::findOrFail($id);

        if ($donHang->trang_thai == 4) {
            return redirect()->back()->with('thongbao', 'Đơn hàng đã hoàn thành, không thể thay đổi trạng thái!');
        }
        
        // Kiểm tra trạng thái mới có nhỏ hơn trạng thái hiện tại không
        if ($request->trang_thai < $donHang->trang_thai) {
            return redirect()->back()->with('thongbao', 'Hãy kiểm tra lại trạng thái bạn muốn cập nhật!');
        }

        $donHang->trang_thai = $request->trang_thai;
        $donHang->save();

        return redirect()->route('don-hang.index')->with('thongbao', 'Cập nhật trạng thái đơn hàng thành công!');
    }

    public function updateAll(Request $request)
    {
        // Lấy danh sách các id đơn hàng được chọn
        $donHangIds = explode(',', $request->input('selectedDonHangIds', ''));
    
        // Kiểm tra nếu không có id nào được chọn
        if (empty($donHangIds[0])) {
            return redirect()->route('don-hang.index')->with('errors', 'Vui lòng chọn ít nhất một đơn hàng.');
        }
    
        // Cập nhật trạng thái cho các đơn hàng được chọn
        foreach ($donHangIds as $id) {
            $donHang = DonHang::find($id);
            if ($donHang) {
                if ($donHang->trang_thai == 1) {
                    $donHang->trang_thai = 2;
                } elseif ($donHang->trang_thai == 2) {
                    $donHang->trang_thai = 3;
                }
                $donHang->save();
            }
        }
        return redirect()->route('don-hang.index')->with('thongbao', 'Cập nhật trạng thái các đơn hàng thành công.');
    }
    
    


}

