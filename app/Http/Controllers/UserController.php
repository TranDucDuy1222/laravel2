<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckLogin;
use App\Http\Requests\CheckRegister;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User as users;
use App\Models\DiaChi;
use PhpParser\Node\Expr\Cast\String_;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Mail;
use App\Mail\GuiEmail;
use App\Models\ReplyEmail;

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

        return redirect()->intended('/')->with('thongbao', 'Đăng ký thành công!');
    }

    function login(){
        return view('login');
    }
    
    public function login_form(CheckLogin $request)
    {
        $user = users::where('email', $request->email)->first();

        if (!$user) {
            return back()->with('error', 'Email này chưa được đăng ký.');
        }
        if (!Hash::check($request->password, $user->password)) {
            return back()->with('error', 'Mật khẩu không chính xác.');
        }
        if (auth()->guard('web')->attempt(['email' => $request['email'], 'password' => $request['password']])) {
            if ($user->is_hidden) {
                Auth::guard('web')->logout();
                return back()->with('error', 'Tài khoản này hiện tạm khóa và không thể đăng nhập.');
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
        if(empty(Auth::check())){
            return redirect()->back()->with('thongbao', 'Đường dẫn không hợp lệ');
        }else {
            $taiKhoan = DB::table('users')
            
            ->select('users.*')
            ->where('id', $id)
            ->first();

            $diachi = DB::table('dia_chi')
            ->join('users', 'dia_chi.id_user','=','users.id')
            ->select('dia_chi.*', 'users.name' )
            ->where('users.id', $id)
            ->orderBy('dia_chi.id', 'desc')
            ->get();
            if(!$taiKhoan){
                return redirect()->back()->with('thongbao','Không tìm thấy tài khoản');
            }
            else{
                if(isset($diachi)){
                    $diachi = $diachi->toArray();
                }else{
                    $diachi = [];
                }
                return view('user.home_myprofile',compact('taiKhoan', 'diachi'));
            }
        }
    }

    public function capnhatdiachi(Request $request, $id)
    {
        $obj = DiaChi::find($id);

        // Kiểm tra và cập nhật từng trường riêng lẻ nếu có giá trị mới
        if ($request->filled('ho_ten')) {
            $obj->ho_ten = $request->input('ho_ten');
        }
        if ($request->filled('phone')) {
            $obj->phone = $request->input('phone');
        }
        if ($request->filled('dc_chi_tiet')) {
            $obj->dc_chi_tiet = $request->input('dc_chi_tiet');
        }
        if ($request->filled('qh')) {
            $obj->qh = $request->input('qh');
        }
        if ($request->filled('thanh_pho')) {
            $obj->thanh_pho = $request->input('thanh_pho');
        }

        // Lưu thay đổi
        $obj->save();

        return redirect()->back()->with('success', 'Cập nhật địa chỉ thành công!');
    }

    public function xoa_dc($id)
    {
        $address = DiaChi::findOrFail($id);
        $address->delete();
    
        return redirect()->back()->with('success', 'Địa chỉ đã được xóa thành công!');
    }
    public function themDiaChi(Request $request, $id)
    {
        // Kiểm tra xem $id có tồn tại trong bảng users không
        $user = users::find($id);
        if (!$user) {
            return redirect()->back()->with('error', 'Người dùng không tồn tại.');
        }

        // Kiểm tra thông tin người dùng nhập vào
        $validatedData = $request->validate([
            'ho_ten' => 'required|string|max:50',
            'phone' => 'required|string|max:15',
            'thanh_pho' => 'required|string|max:255',
            'quan_huyen' => 'required|string|max:255',
            'phuong_xa' => 'required|string|max:255',
            'diachichitiet' => 'required|string|max:255',
        ]);

        // Nếu tất cả thông tin hợp lệ, lưu địa chỉ mới sử dụng model DiaChi
        $diaChi = new DiaChi();
        $diaChi->id_user = $id;
        $diaChi->ho_ten = $validatedData['ho_ten'];
        $diaChi->phone = $validatedData['phone'];
        $diaChi->thanh_pho = $validatedData['thanh_pho'];
        $diaChi->qh = $validatedData['quan_huyen'];
        $diaChi->dc_chi_tiet = $validatedData['diachichitiet'] . ', ' . $validatedData['phuong_xa'];
        $diaChi->save();

        return redirect()->back()->with('success', 'Địa chỉ mới đã được thêm thành công.');
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
            : back()->withInput($request->only('email'))
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

    public function lienHe(){
        $lien_he = DB::table('settings')->select('phone')->first(); 
        $sdtlien_he = $lien_he ? $lien_he->phone : '';
        return view('user.home_contact' , compact('sdtlien_he'));
    }
    public function sendContact(Request $request)
    {
        $arr = $request->post();
        $ht = trim(strip_tags($arr['name']));
        $email = trim(strip_tags($arr['email']));
        $nd = trim(strip_tags($arr['noidung']));

        // Lưu thông tin vào bảng reply_email 
        $replyEmail = new ReplyEmail(); 
        $replyEmail->ho_ten = $ht; 
        $replyEmail->email = $email; 
        $replyEmail->noi_dung = $nd; 
        $replyEmail->save();

        $adminEmail = 'trendyu02@gmail.com'; // Thư được gửi tới quản trị của email này
        Mail::mailer('smtp')->to($adminEmail)->send(new GuiEmail($ht, $email, $nd));
        return redirect()->route('user.contact')->with('success', 'Gửi mail thành công!');
    }

    

}
