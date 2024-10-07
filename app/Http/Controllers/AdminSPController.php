<?php

namespace App\Http\Controllers;

use App\Http\Requests\checkNhapSanPham;
use Illuminate\Http\Request;
use App\Models\SanPham as san_pham;
use App\Models\DanhMuc as danh_muc;
use App\Models\Size as size;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;

Paginator::useBootstrapFive();

class AdminSPController extends Controller
{
    function index(Request $request)
    {
        $id_dm = -1;
        $perpage = env('PER_PAGE');
        $loai_arr = danh_muc::all();
        $size_arr = size::all();
        $idsp = DB::table('san_pham')->pluck('id');


        if ($request->has('id_dm')) {
            $id_dm = (int) $request['id_dm'];
        }
        if ($request->has('trangthai')) {
            $trangthai = $request['trangthai'];
        } else {
            $trangthai = 0;
        }
        if ($trangthai == 2) {
            $sanpham_arr = san_pham::join('danh_muc', 'san_pham.id_dm', '=', 'danh_muc.id')
                ->select('san_pham.*', 'danh_muc.ten_dm')
                ->orderBy('san_pham.id', 'desc')
                ->where('san_pham.trang_thai', 2)
                ->paginate($perpage)
                ->withQueryString();
            return view('admin/product_admin', compact(['trangthai', 'id_dm', 'sanpham_arr', 'loai_arr', 'size_arr']));
        } elseif ($trangthai == 1) {
            $sanpham_arr = san_pham::join('danh_muc', 'san_pham.id_dm', '=', 'danh_muc.id')
                ->select('san_pham.*', 'danh_muc.ten_dm')
                ->orderBy('san_pham.id', 'desc')
                ->where('san_pham.trang_thai', 1)
                ->paginate($perpage)
                ->withQueryString();
            return view('admin/product_admin', compact(['trangthai', 'id_dm', 'sanpham_arr', 'loai_arr', 'size_arr']));
        } else if ($trangthai == 3) {
            $sanpham_arr = san_pham::join('danh_muc', 'san_pham.id_dm', '=', 'danh_muc.id')
                ->select('san_pham.*', 'danh_muc.ten_dm')
                ->orderBy('san_pham.id', 'desc')
                ->where('san_pham.trang_thai', 3)
                ->paginate($perpage)
                ->withQueryString();
            return view('admin/product_admin', compact(['trangthai', 'id_dm', 'sanpham_arr', 'loai_arr', 'size_arr']));
        } else {
            if ($id_dm > 0) {
                $sanpham_arr = san_pham::join('danh_muc', 'san_pham.id_dm', '=', 'danh_muc.id')
                    ->select('san_pham.*', 'danh_muc.ten_dm')
                    ->orderBy('san_pham.id', 'desc')
                    ->where('san_pham.id_dm', $id_dm)
                    ->paginate($perpage)
                    ->withQueryString();
                return view('admin/product_admin', compact(['trangthai', 'id_dm', 'sanpham_arr', 'loai_arr', 'size_arr']));
            } else {
                $sanpham_arr = san_pham::join('danh_muc', 'san_pham.id_dm', '=', 'danh_muc.id')
                    ->select('san_pham.*', 'danh_muc.ten_dm')
                    ->orderBy('san_pham.id', 'desc')
                    ->where('san_pham.trang_thai', 0)
                    ->paginate($perpage)
                    ->withQueryString();
            }
            return view('admin/product_admin', compact(['trangthai', 'id_dm', 'sanpham_arr', 'loai_arr', 'size_arr', 'idsp']));
        }
    }
    public function create()
    {
        $loai_arr = DB::table('danh_muc')->orderBy('id', 'asc')->get();
        return view('admin.product_add_admin', compact('loai_arr'));
    }
    public function store(checkNhapSanPham $request)
    {
        $hasproduct = false;
        // Kiểm tra xem tên sản phẩm đã tồn tại trong cơ sở dữ liệu hay chưa
        $checkProduct = san_pham::where('ten_sp', $request['ten_sp'])->first();
        if ($checkProduct) {
            return redirect()->back()->with('thongbao', 'Tên sản phẩm đã tồn tại. Vui lòng chọn tên khác.');
        }
        if ($request['ten_sp'] && $request['gia'] && $request['gia_km'] && $request['id_dm'] && $request->hasFile('hinh') && $request['mo_ta_ct'] && $request['mo_ta_ngan'] && $request['color']) {

            $obj = new  san_pham();
            $obj->ten_sp = $request['ten_sp'];
            $obj->slug = Str::slug($obj->ten_sp);
            $obj->gia = (int) $request['gia'];
            $obj->gia_km = (int) $request['gia_km'];
            // Kiểm tra nếu giakhuyenmai lớn hơn gia, gán giakhuyenmai bằng 0
            if ($obj->gia_km > $obj->gia) {
                $obj->gia_km = 0;
            }
            $obj->id_dm = (int) $request['id_dm'];

            // Lấy tệp tin từ trường input file
            if ($request->hasFile('hinh')) {
                $file = $request->file('hinh');
                $fileName = $file->getClientOriginalName();
                $ext = pathinfo($fileName, PATHINFO_EXTENSION); // Lấy phần mở rộng của tệp tin
                // Mảng chứa các phần mở rộng bạn muốn kiểm tra
                $allowedExtensions = ['jpg', 'png', 'gif', 'webp', 'jpeg'];
                if (in_array($ext, $allowedExtensions)) {
                    $file->move(public_path('/imgnew'), $fileName);
                    $obj->hinh = $fileName;
                } else {
                    return redirect()->back()->with('thongbao', 'Phần mở rộng tệp tin không đúng định dạng');
                }
            }
            $obj->mo_ta_ct = $request['mo_ta_ct'];
            $obj->mo_ta_ngan = $request['mo_ta_ngan'];
            $obj->an_hien = 0;
            $obj->trang_thai = $request['trang_thai'];
            $obj->color = $request['color'];
            $obj->ngay = now();
            $obj->save();
            $hasproduct = true;
        } else {
            $hasproduct = false;
            return redirect()->back()->with('thongbao', 'Thông tin sản phẩm chưa đầy đủ!');
        }
        $size_products = [];
        if ($hasproduct && is_array($request['size_product']) && is_array($request['so_luong'])) {
            $size_products = $request->input('size_product');
            $so_luongs = $request->input('so_luong');
            $product_id = $obj->id; // lấy id sản phẩm mới tạo
            //dd($request->all());

            if (is_array($size_products) && is_array($so_luongs)) {
                foreach ($size_products as $index => $sizes) {
                    $sizeObj = new Size();
                    $sizeObj->size_product = (string)$sizes;
                    $sizeObj->so_luong = intval($so_luongs[$index]);
                    $sizeObj->id_product = $product_id; // Gán id sản phẩm mới tạo vào cột id_product 
                    $sizeObj->save();
                }
            }
            // else {
            //     // Xử lý khi không nhập được sản phẩm
            //     return redirect()->back()->with('thongbao', 'Size và số lượng');
            // }
        } else {
            // Xử lý khi không nhập được sản phẩm
            return redirect()->back()->with('thongbao', 'Vui lòng nhập thông tin số lượng đầy đủ.');
        }

        return redirect(route('san-pham.index'))->with('thongbao', 'Thêm thành công');
    }

    function khoiphuc($id)
    {
        $sp = san_pham::withTrashed()->find($id);
        if ($sp == null) return redirect('/thongbao');
        $sp->restore();
        return redirect('/admin/san-pham?trangthai=3');
    }
    function xoavinhvien($id)
    {
        $sp = san_pham::withTrashed()->find($id);
        if ($sp == null)
            return redirect('/thongbao');
        $sp->forceDelete();
        return redirect('/admin/san-pham')->with('thongbao', 'Sản Phẩm Đã Được Xóa Vĩnh Viễn!');
    }

    public function edit(Request $request, string $id)
    {
        $sp = san_pham::where('id', $id)->first();
        $sizeProduct = size::where('id_product', $id)->get();
        if ($sp == null) {
            $request->session()->flash('thongbao', 'Không có sản phẩm này: ' . $id);
            return redirect('/admin/san-pham');
        }
        $loai_arr = DB::table('danh_muc')->orderBy('id', 'asc')->get();
        return view('admin/product_edit_admin', compact(['sp', 'loai_arr', 'sizeProduct']));
    }

    public function update(Request $request, string $id)
    {
        //dd($request->all());
        // Kiểm tra xem sản phẩm có tồn tại
        $obj = san_pham::find($id);
        if (!$obj) {
            return redirect()->back()->with('thongbao', 'Sản phẩm không tồn tại.');
        }

        // Kiểm tra xem tên sản phẩm đã tồn tại trong cơ sở dữ liệu hay chưa
        $checkProduct = san_pham::where('ten_sp', $request['ten_sp'])->where('id', '!=', $id)->first();
        if ($checkProduct) {
            return redirect()->back()->with('thongbao', 'Tên sản phẩm đã tồn tại. Vui lòng chọn tên khác.');
        }

        // Kiểm tra các trường bắt buộc
        if ($request->filled(['ten_sp', 'gia', 'gia_km', 'id_dm', 'mo_ta_ct', 'mo_ta_ngan', 'color', 'hinh'])) {

            $obj->ten_sp = $request['ten_sp'];
            $obj->slug = Str::slug($obj->ten_sp);
            $obj->gia = (int) $request['gia'];
            $obj->gia_km = (int) $request['gia_km'];

            // Kiểm tra nếu giá khuyến mãi lớn hơn giá, gán giá khuyến mãi bằng 0
            if ($obj->gia_km > $obj->gia) {
                $obj->gia_km = 0;
            }

            $obj->id_dm = (int) $request['id_dm'];

            // Lấy tệp tin từ trường input file
            if ($request->hasFile('hinh')) {
                $file = $request->file('hinh');
                $fileName = $file->getClientOriginalName();
                $ext = pathinfo($fileName, PATHINFO_EXTENSION); // Lấy phần mở rộng của tệp tin
                // Mảng chứa các phần mở rộng bạn muốn kiểm tra
                $allowedExtensions = ['jpg', 'png', 'gif', 'webp', 'jpeg'];
                if (in_array($ext, $allowedExtensions)) {
                    $file->move(public_path('/uploads/images'), $fileName);
                    $obj->hinh = $fileName;
                } else {
                    return redirect()->back()->with('thongbao', 'Phần mở rộng tệp tin không đúng định dạng');
                }
            }

            $obj->mo_ta_ct = $request['mo_ta_ct'];
            $obj->mo_ta_ngan = $request['mo_ta_ngan'];
            $obj->trang_thai = 0;
            $obj->color = $request['color'];
            $obj->ngay = now();
            $obj->save();

            // Xử lý size và số lượng sản phẩm
            if (is_array($request['size_product']) && is_array($request['so_luong'])) {
                $size_products = $request->input('size_product');
                $so_luongs = $request->input('so_luong');
                $product_id = $obj->id; // lấy id sản phẩm hiện tại
                foreach ($size_products as $index => $sizes) {
                    // Kiểm tra xem bản ghi size đã tồn tại hay chưa
                    $sizeObj = Size::where('id_product', $product_id)
                        ->where('size_product', $sizes)
                        ->first();
                    // Nếu tồn tại, cập nhật bản ghi
                    $sizeObj->so_luong = intval($so_luongs[$index]);
                    $sizeObj->save();
                }
            } else {
                return redirect()->back()->with('thongbao', 'Vui lòng nhập thông tin số lượng đầy đủ.');
            }

            return redirect(route('san-pham.index'))->with('thongbao', 'Cập nhật thành công');
        } else {
            return redirect()->back()->with('thongbao', 'Thông tin sản phẩm chưa đầy đủ!');
        }
    }

    public function destroy(Request $request, string $id)
    {
        $cokhong = san_pham::where('id', $id)->exists();
        if ($cokhong == false) {
            $request->session()->flash('thongbao', 'Sản phẩm không tồn tại');
            return redirect('/admin/san-pham');
        }
        san_pham::where('id', $id)->delete();
        $request->session()->flash('thongbao', 'Đã xóa sản phẩm');
        return redirect('/admin/san-pham');
    }

    public function hide($id)
    {
        $san_pham = san_pham::findOrFail($id);
        $san_pham->an_hien = 1; //0 là hiện 1 là ẩn
        $san_pham->save();
        return redirect()->route('san-pham.index')->with('thongbao', 'Sản phẩm đã được ẩn thành công.');
    }

    public function show($id, $trang_thai)
    {
        
        $san_pham = san_pham::findOrFail($id);
        $san_pham->an_hien = 0; //0 là hiện 1 là ẩn
        $san_pham->save();
        return redirect()->route('san-pham.index')->with('thongbao', 'Sản phẩm đã được hiện lại thành công.');
    }
}
