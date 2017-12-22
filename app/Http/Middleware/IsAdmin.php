<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
		dd(213123);
		// 未登录或者不是管理员，则不通过验证
		if (!Auth::guest() || !Auth::user()->is_admin) {
			redirect('/');
		}

        return $next($request);
    }
}
