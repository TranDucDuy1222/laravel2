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
        if (!empty(auth()->guard('web')->user())) {
            if (Auth::user()->role == 1) {
                return $next($request);
            }
        }
        return redirect('admin/login_admin')->with(['thongbao' => "Bạn Không Phải Admin"]);
    }
    
}
