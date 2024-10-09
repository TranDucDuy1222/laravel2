<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckLogin;
use Illuminate\Http\Request;
use DB;
use Auth;
use App\Models\DanhMuc as danh_muc;

class UserController extends Controller
{
    public function __construct() 
    {
        $danhmuc = danh_muc::select('ten_dm' ,'id')->orderBy('id' , 'asc')->get();
        \View::share( 'danhmuc', $danhmuc );
    }

    function login(){
        return view('login');
    }
    function login_form(CheckLogin $request) {
        if (auth()->guard('web')->attempt(['email' => $request['email'], 'password' => $request['pass']])) {
            $user = auth()->guard('web')->user();

            if ($user->is_hidden) {
                Auth::guard('web')->logout();
                return back()->with('thongbao', 'Tài khoản này hiện tạm khóa và không thể đăng nhập.');
            }
            if ($user->role == 0) {
                return redirect()->intended('/');
            } else {
                return back()->with('thongbao', 'Email hoặc mật khẩu không đúng');
            }
        }
        return back()->with('thongbao', 'Email hoặc mật khẩu không đúng');
    }
    
    function logout(){
        Auth::guard('web')->logout();
        return redirect('/login')->with('thongbao','Bạn đã thoát tài khoản');
    }
}
