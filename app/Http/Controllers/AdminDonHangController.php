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

        // Tìm kiếm theo ID
        if ($request->filled('id')) {
            $query->where('id', $request->id);
        }
        
        $donHangs = $query->orderBy('id', 'DESC')->paginate($perpage)->withQueryString();
        return view('admin.order', compact('donHangs'));
 
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

        return redirect()->back()->with('thongbao', 'Cập nhật trạng thái đơn hàng thành công!');
    }

}

