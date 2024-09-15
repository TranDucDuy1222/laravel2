<?php

namespace App\Http\Controllers;

use App\Models\DanhMuc as danh_muc;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
Paginator::useBootstrap();

class AdminLoaiController extends Controller
{
    public function index() {
        $perPage = env('PER_PAGE');
        $loai_arr = danh_muc::orderBy('id', 'asc')->paginate($perPage)->withQueryString();      
        return view('admin.category', compact('loai_arr'));
    }
}
