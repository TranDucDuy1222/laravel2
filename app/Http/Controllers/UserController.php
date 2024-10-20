<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckLogin;
use App\Http\Requests\CheckRegister;
use Illuminate\Http\Request;
use DB;
use Auth;
use App\Models\DanhMuc as danh_muc;
use App\Models\User as users;
use PhpParser\Node\Expr\Cast\String_;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class UserController extends Controller
{
    
    public function register(Request $request)
    {
        return view('register');
    }
    
    public function register_form(CheckRegister $request)
    {
        $user = users::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        auth()->login($user);

        return redirect()->intended('/')->with('success', 'Đăng ký thành công!');
    }

    function login(){
        return view('login');
    }
    
    public function login_form(CheckLogin $request)
    {
        $user = users::where('email', $request->email)->first();

        if (!$user) {
            return back()->with('thongbao', 'Email này chưa được đăng ký.');
        }
        if (!Hash::check($request->pass, $user->password)) {
            return back()->with('thongbao', 'Mật khẩu không chính xác.');
        }
        if (auth()->guard('web')->attempt(['email' => $request['email'], 'password' => $request['pass']])) {
            if ($user->is_hidden) {
                Auth::guard('web')->logout();
                return back()->with('thongbao', 'Tài khoản này hiện tạm khóa và không thể đăng nhập.');
            }
            return redirect()->intended('/');
        }
        return back()->with('thongbao', 'Đăng nhập không thành công, vui lòng thử lại.');
    }
    
    function logout(){
        Auth::guard('web')->logout();
        return redirect('/login')->with('thongbao','Bạn đã đăng xuất khỏi tài khoản');
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

    public function forgot_pass()
    {
        return view('forgot-password');
    }

    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:users,email']);
        $status = Password::sendResetLink(
            $request->only('email')
        );
        return $status === Password::RESET_LINK_SENT
            ? back()->with('status', 'Đường dẫn đặt lại mật khẩu đã được gửi đến email của bạn.')
            : back()-withInput($request->only('email'))
                    ->withErrors(['email' => __('Không tìm thấy email này.')]);
    }

    public function show_reset(Request $request, $token = null)
    {
        return view('reset-password')->with(['token' => $token, 'email' => $request->email ?? '']);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
            'token' => 'required',
        ]);

        // Reset mật khẩu
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->password = Hash::make($password);
                $user->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('success', __('Mật khẩu đã được đặt lại thành công!'))
            : back()->withErrors(['email' => [__('Email không hợp lệ.')]]);
    }
}
