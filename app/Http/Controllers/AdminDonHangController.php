<?php

namespace App\Http\Controllers;

use App\Models\DonHang;
use App\Models\ChiTietDonHang;
use Illuminate\Http\Request;

class AdminDonHangController extends AdminController
{
    public function index(Request $request)
    {
        $query = DonHang::query();

        // Chỉ hiển thị các đơn hàng có trạng thái "Chưa xử lý"
        if (!$request->has('trang_thai')) {
            $query->where('trang_thai', 0);
        } 
        if ($request->filled('trang_thai')) {
            $query->where('trang_thai', $request->trang_thai);
        }

        $donHangs = $query->get();
        return view('admin.order', compact('donHangs'));
 
    }

    public function show($id)
    {
        $donHang = DonHang::with(['chiTietDonHangs.sanPham', 'user', 'chiTietDonHangs.size'])->findOrFail($id);
        return view('admin.order_detail', compact('donHang'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'trang_thai' => 'required|integer|in:0,1,2',
        ]);
    
        $donHang = DonHang::findOrFail($id);
        $donHang->trang_thai = $request->trang_thai;
        $donHang->save();
    
        return redirect()->route('don-hang.index')->with('thongbao', 'Cập nhật trạng thái đơn hàng thành công!');
    }

    public function updateTrangThai(Request $request, $id)
    {
        $request->validate([
            'trang_thai' => 'required|integer|in:0,1,2',
        ]);
    
        $donHang = DonHang::findOrFail($id);
        $donHang->trang_thai = $request->trang_thai;
        $donHang->save();
    
            return redirect()->route('don-hang.index')->with('thongbao', 'Cập nhật trạng thái đơn hàng thành công!');
    }
}

