<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;

class Quantri
{
    public function handle(Request $request, Closure $next): Response
    {
        // if (!empty(auth()->guard('web')->user())) {
        //     if (Auth::user()->role == 1) {
        //         return $next($request);
        //     }
        // }
        // return redirect('admin/login_admin')->with(['thongbao' => "Bạn Không Phải Admin"]);
        if (auth()->check() && Auth::user()->role == 1) {
            return $next($request);
        }

        // Nếu là admin và cố gắng truy cập vào route khách hàng
        if (auth()->check() && Auth::user()->role == 1 && !str_contains($request->path(), 'admin')) {
            // Chuyển hướng về trang chủ admin nếu cố gắng truy cập trang khách hàng
            return redirect()->route('admin');
        }

        return redirect('admin/login_admin')->with(['thongbao' => "Bạn Không Phải Admin"]);
    }
    
}
