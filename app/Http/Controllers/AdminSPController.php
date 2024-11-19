<?php

namespace App\Http\Controllers;

use App\Http\Requests\checkNhapSanPham;
use Illuminate\Http\Request;
use App\Models\SanPham as san_pham;
use App\Models\DanhMuc as danh_muc;
use App\Models\Size as size;
use App\Models\Loai;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

Paginator::useBootstrapFive();

class AdminSPController extends AdminController
{
    function index(Request $request)
    {
        // Khởi tạo các biến cần thiết
        $id_dm = -1;
        $perpage = env('PER_PAGE');
        $loai_arr = danh_muc::all();
        $size_arr = size::all();
        $idsp = DB::table('san_pham')->pluck('id');

        // Kiểm tra và gán giá trị cho $id_dm nếu có trong request
        if ($request->has('id_dm')) {
            $id_dm = (int) $request['id_dm'];
        }

        // Kiểm tra và gán giá trị cho $trangthai nếu có trong request, mặc định là 0
        $trangthai = $request->has('trangthai') ? $request['trangthai'] : 0;

        // Lọc sản phẩm theo trạng thái
        $query = san_pham::join('danh_muc', 'san_pham.id_dm', '=', 'danh_muc.id')
            ->select('san_pham.*', 'danh_muc.ten_dm')
            ->orderBy('san_pham.id', 'desc');

        if ($trangthai != 0) {
            $query->where('san_pham.trang_thai', $trangthai);
        }

        // Lọc sản phẩm theo danh mục nếu $id_dm > 0
        if ($id_dm > 0) {
            $query->where('san_pham.id_dm', $id_dm);
        }

        // Kiểm tra và gán giá trị cho $keyword nếu có trong request
        if ($request->has('keyword') && $request->keyword != '') {
            $keyword = $request->keyword;
            // Thêm điều kiện lọc theo slug
            $query->where('san_pham.slug', 'like', '%' . $keyword . '%');
        }

        // Lấy danh sách sản phẩm với phân trang
        $sanpham_arr = $query->paginate($perpage)->withQueryString();



        // Trả về view với các biến cần thiết
        return view('admin.product', compact('trangthai', 'id_dm', 'sanpham_arr', 'loai_arr', 'size_arr', 'idsp'));
    }

    public function create(Request $request)
    {
        $selectedOption = $request->query('selection');
        Log::info('Selected Option:', ['selection' => $selectedOption]);
        $request->session()->put('selected_option', $selectedOption);
        $loai_arr = DB::table('danh_muc')->orderBy('id', 'asc')->get();
        return view('admin.product_add', compact('loai_arr', 'selectedOption'));
    }


    public function store(Request $request)
    {
        $hasproduct = false;
        // Kiểm tra xem tên sản phẩm đã tồn tại trong cơ sở dữ liệu hay chưa
        $checkProduct = san_pham::where('ten_sp', $request['ten_sp'])->first();
        if ($checkProduct) {
            return redirect()->back()->with('thongbao', 'Tên sản phẩm đã tồn tại. Vui lòng chọn tên khác.');
        }
        if ($request['ten_sp'] && $request['gia'] && $request['id_dm'] && $request->hasFile('hinh') && $request['mo_ta_ct'] && $request['mo_ta_ngan'] && $request['color']) {
            $obj = new san_pham();
            $obj->ten_sp = $request['ten_sp'];
            $obj->slug = Str::slug($obj->ten_sp);
            $obj->gia = (int) $request['gia'];
            $obj->gia_km = (int) $request['gia_km'];
            // Kiểm tra nếu giakhuyenmai lớn hơn gia, gán giakhuyenmai bằng 0
            if ($obj->gia_km > $obj->gia) {
                $obj->gia_km = 0;
            }else if ($obj->gia_km == null) {
                $obj->gia_km = 0;
            }else if ($obj->gia_km < 0){
                $obj->gia_km = 0;
            }else if ($obj->gia == null) {
                return redirect()->back()->with('thongbao', 'Vui lòng nhập giá hợp lệl!');
            }else if ($obj->gia < 0){
                return redirect()->back()->with('thongbao', 'Vui lòng nhập giá hợp lệl!');
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
                    $filePath = public_path('/uploads/product/' . $fileName);
                    if (file_exists($filePath)) {
                        // Hiện thông báo nếu tệp tin đã tồn tại
                        return redirect()->back()->with('thongbao', 'Sản phẩm này đã tồn tại');
                    } else {
                        $file->move(public_path('/uploads/product/'), $fileName);
                        $obj->hinh = $fileName;
                    }
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
                    $sizeObj->size_product = (string) $sizes;
                    $sizeObj->so_luong = intval($so_luongs[$index]);
                    $sizeObj->id_product = $product_id; // Gán id sản phẩm mới tạo vào cột id_product 
                    $sizeObj->save();
                }
            }
        } else {
            // Xử lý khi không nhập được sản phẩm
            return redirect()->back()->with('thongbao', 'Vui lòng nhập thông tin số lượng đầy đủ.');
        }

        return redirect()->route('san-pham.index')->with('thongbao', 'Thêm thành công');
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
        return view('admin/product_edit', compact(['sp', 'loai_arr', 'sizeProduct']));
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
                    $filePath = 'uploads/product/' . $fileName;
                    if (Storage::exists($filePath)) {
                        Storage::delete($filePath); // Xóa tệp tin nếu đã tồn tại
                    }
                    $file->move(public_path('uploads/product'), $fileName);
                    $obj->hinh = $fileName;
                } else {
                    return redirect()->back()->with('thongbao', 'Phần mở rộng tệp tin không đúng định dạng');
                }
            }

            $obj->mo_ta_ct = $request['mo_ta_ct'];
            $obj->mo_ta_ngan = $request['mo_ta_ngan'];
            $obj->trang_thai = $request['trang_thai'];
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
        if ($san_pham->trang_thai == 0) {
            $san_pham->trang_thai = 2;
            $san_pham->save();
        }
        return redirect()->route('san-pham.index')->with('thongbao', 'Sản phẩm đã được ẩn thành công.');
    }

    public function show($id)
    {
        //Tìm đối tượng
        $san_pham = san_pham::findOrFail($id);
        //Kiểm tra
        if ($san_pham->trang_thai == 2) {
            $san_pham->trang_thai = 0;
            $san_pham->save();
        }
        $danh_muc = danh_muc::where('id', $san_pham->id_dm)->first();
        if ($danh_muc->trang_thai == 1) {
            $danh_muc->trang_thai = 0;
            $danh_muc->save();
        }

        return redirect()->route('san-pham.index')->with('thongbao', 'Sản phẩm đã được hiện lại thành công.');
    }

}
