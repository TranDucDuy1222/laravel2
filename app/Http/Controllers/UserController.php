<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckLogin;
use Illuminate\Http\Request;
use DB;
use Auth;
use App\Models\DanhMuc as danh_muc;
use App\Models\User as users;
use PhpParser\Node\Expr\Cast\String_;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // function __construct(){
    //     $query = DB::table('loai')
    //     ->select('id', 'ten_loai', 'slug')
    //     ->orderBy('id', 'asc');
    //     $loai = $query->get();
    //     $danh_muc = DB::table('danh_muc')->get();
    //     \View::share('loai', $loai);
    //     \View::share('danh_muc', $danh_muc);
    // }

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

    public function quanLyTk($id){
        $taiKhoan = DB::table('users')
        ->join('dia_chi', 'dia_chi.id_user','=','users.id')
        ->select('users.*', 'dia_chi.phone', 'dia_chi.dc_chi_tiet',)
        ->where('users.id', $id)
        ->first();
        if(!$taiKhoan){
            return redirect()->back()->with('thongbao','Không tìm thấy tài khoản');
        }

        return view('user.home_myprofile',compact('taiKhoan'));
    }

    public function chinhSuaThongTin(Request $request ,$id){
        $taiKhoan = users::find($id);

        return view('user.home_edit_profile', compact('taiKhoan'));
    }
    public function chinhSuaMk(Request $request, $id)
    {
        $taiKhoan = users::find($id);
    
        if ($request->filled(['mkcu', 'mkmoi'])) {
            if (!Hash::check($request->mkcu, $taiKhoan->password)) {
                return redirect()->back()->with('thongbao', 'Mật khẩu cũ không đúng, vui lòng nhập lại!');
            }
    
            $taiKhoan->password = Hash::make($request->mkmoi);
            $taiKhoan->save();
            return redirect()->route('user.profile', ['id' => $id])->with('thongbao', 'Mật khẩu được cập nhật thành công!');
        }
    
        return redirect()->back()->with('thongbao', 'Vui lòng nhập đầy đủ thông tin!');
    }
}
