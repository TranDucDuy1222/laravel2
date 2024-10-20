<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\RedirectResponse;
use Redirect;
use Illuminate\Support\Facades\Session;

class GoogleLoginController extends Controller
{
    public function redirectToGoogle(): RedirectResponse
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();
            $existingUser = User::where('google_id', $googleUser->id)->first();
            
            if ($existingUser) {
                auth()->login($existingUser, true);
            } else {
                $newUser = User::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'google_id' => $googleUser->id,
                    'password' => bcrypt(Str::random(16)),
                ]);

                auth()->login($newUser, true);
            }

            return redirect()->intended('/');
        } catch (\Exception $e) {
            // Hiển thị lỗi Google API trong nhật ký Laravel
            \Log::error($e);
            return redirect('/login')->with('thongbao', 'Đăng nhập bằng Google không thành công. Vui lòng thử lại.');
        }
    }  
}