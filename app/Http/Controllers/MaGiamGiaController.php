<?php

namespace App\Http\Controllers;

use App\Models\MaGiamGia;
use Illuminate\Http\Request;

class MaGiamGiaController extends AdminController
{
    public function index(Request $request)
    {
        $query = MaGiamGia::query();
        if ($request->has('type') && $request->type != '') {
            if ($request->type == '0') {
                $query->where('mot_nhieu', true); // Mã dùng 1 lần
            } elseif ($request->type == '1') {
                $query->where('mot_nhieu', false); // Mã dùng nhiều lần
            }
        }

    $discounts = $query->get();
        return view('admin.magiamgia', compact('discounts'));
    }

    public function create()
    {
        return view('admin.magiamgia_add');//
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string|unique:magiamgia,code',
            'phan_tram' => 'required|numeric|min:0|max:100',
            'mo_ta' => 'nullable|string',
            'mot_nhieu' => 'boolean',
            'ngay_het_han' => 'nullable|date',
        ]);
        

        MaGiamGia::create($request->all());
        return redirect()->route('magiamgia.index')->with('success', 'Mã giảm giá đã được tạo thành công.');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $discount = MaGiamGia::findOrFail($id);
        return view('admin.magiamgia_edit', compact('discount'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'code' => 'required|string|unique:magiamgia,code,'.$id,
            'phan_tram' => 'required|numeric|min:0|max:100',
            'mo_ta' => 'nullable|string',
            'mot_nhieu' => 'boolean',
            'ngay_het_han' => 'nullable|date',
        ]);

        $discount = MaGiamGia::findOrFail($id);
        $discount->update($request->all());
        return redirect()->route('magiamgia.index')->with('success', 'Mã giảm giá đã được cập nhật thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $discount = MaGiamGia::findOrFail($id);
        $discount->delete();
        return redirect()->route('magiamgia.index')->with('success', 'Mã giảm giá đã được xóa thành công.');
    }
}
