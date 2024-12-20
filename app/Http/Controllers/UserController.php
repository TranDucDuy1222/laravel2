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
use App\Mail\OtpMail;

class UserController extends Controller
{
    
    public function register(Request $request)
    {
        return view('register');
    }
    
    public function register_form(CheckRegister $request)
    {
        $otp = rand(100000, 999999);
        $expiresAt = now()->addMinutes(1);// OTP hết hạn sau 1 phút

        // Lưu thông tin vào session
        $user = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'otp' => $otp,
            'expires_at' => $expiresAt,
        ];
        session(['pending_user' => $user]);
        // Gửi mã OTP qua email
        Mail::to($request->email)->send(new OtpMail($otp));

        return redirect()->route('otpform')->with([
            'email' => $request->email,
            'expires_at' => $expiresAt,
            'thongbao' => 'Vui lòng kiểm tra email để nhận mã OTP và xác nhận tài khoản.',
        ]);
    }

    public function showOtpForm()
    {
        return view('otp');
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|array|min:6|max:6',
        ]);

        // Gộp mảng các số thành chuỗi
        $otp = implode('', $request->otp);

        // Lấy thông tin user từ session
        $pendingUser = session('pending_user');
        if (!$pendingUser || $pendingUser['email'] !== $request->email) {
            return redirect()->back()->with('error', 'Người dùng không tồn tại hoặc thông tin không hợp lệ!');
        }
        
        // Kiểm tra thời gian OTP hết hạn
        if (!$pendingUser || now()->greaterThan($pendingUser['expires_at'])) {
            return redirect()->back()->with('error', 'Mã OTP đã hết hạn!');
        }

        if ((string)$otp === (string)$pendingUser['otp']) {
            // Lưu tài khoản vào cơ sở dữ liệu
            $user = users::create([
                'name' => $pendingUser['name'],
                'email' => $pendingUser['email'],
                'password' => $pendingUser['password'],
            ]);

            // Xóa OTP khỏi session
            session()->forget('pending_user');

            auth()->login($user);

            return redirect()->intended('/')->with('thongbao', 'Đăng ký thành công!');
        }

        session()->put('email', $pendingUser['email']);
        session()->flash('expires_at', $pendingUser['expires_at']);

        return redirect()->back()->with('error', 'Mã OTP không đúng. Vui lòng thử lại!');
    }

    public function resendOtp(Request $request)
    {
        $pendingUser = session('pending_user');
        if (!$pendingUser) {
            return redirect()->route('register')->with('error', 'Không tìm thấy thông tin đăng ký!');
        }
    
        // Tạo lại mã OTP mới
        $otp = rand(100000, 999999);
        $pendingUser['otp'] = $otp;
        $pendingUser['expires_at'] = now()->addMinutes(2); // Gia hạn thời gian OTP
    
        session(['pending_user' => $pendingUser]);

        Mail::to($pendingUser['email'])->send(new OtpMail($otp));

        session()->put('expires_at', $pendingUser['expires_at']);
    
        return redirect()->back()->with('thongbao', 'Mã OTP mới đã được gửi. Vui lòng kiểm tra email của bạn.');
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
            
            if ($user->role == 1) {
                return redirect('admin/');  // Chuyển hướng về trang admin
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
                return redirect()->back()->with('error', 'Mật khẩu cũ không đúng, vui lòng nhập lại!');
            }
    
            $taiKhoan->password = Hash::make($request->mkmoi);
            $taiKhoan->save();
            return redirect()->route('user.profile', ['id' => $id])->with('thongbao', 'Mật khẩu được cập nhật thành công!');
        }
    
        return redirect()->back()->with('error', 'Vui lòng nhập đầy đủ thông tin!');
    }

    public function forgot_pass()
    {
        return view('forgot-password');
    }

    public function sendResetLink(Request $request)
    {
        // $request->validate(['email' => 'required|email|exists:users,email']);
        $status = Password::sendResetLink(
            $request->only('email')
        );
        if ($status === Password::RESET_LINK_SENT) {
            return back()->with('thongbao', 'Đường dẫn đặt lại mật khẩu đã được gửi đến email của bạn.');
        }

        return back()->with('error','Không tìm thấy email này.');

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

        if ($status === Password::PASSWORD_RESET) {
            return redirect()->route('login')->with('thongbao', 'Mật khẩu đã được đặt lại thành công!');
        }

        return back()->withErrors('error', 'Email không hợp lệ.');
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
