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
		// 游客或非管理员登录，则不通过验证
		if (Auth::guest() || !Auth::user()->is_admin) {
            abort(404);
		}

        return $next($request);
    }
}
