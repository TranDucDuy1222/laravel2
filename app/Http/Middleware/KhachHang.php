<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth; 

class KhachHang
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // if (Auth::check() && Auth::user()->role == 0) {
        //     return $next($request);
        // }
        // return redirect('admin')->with('thongbao', 'Bạn đã đăng nhập bằng tài khoản admin');

        if (auth()->check() && Auth::user()->role == 1) {
            return redirect()->route('admin')->with('thongbao', 'Bạn đã đăng nhập bằng tài khoản admin');
        }

        return $next($request);
    }
}
