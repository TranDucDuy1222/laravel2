<?php

namespace App\Http\Controllers;

use App\Models\Loai;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
Paginator::useBootstrap();

class AdminLoaiController extends Controller
{
    public function index() {
        $perPage = env('PER_PAGE');
        $loai_arr = Loai::orderBy('madm', 'asc')->paginate($perPage)->withQueryString();      
        return view('admin.category', compact('loai_arr'));
    }
}
