<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\ProxyHelpers;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\UnauthorizedException;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers, ProxyHelpers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

	/**
	 * 重写登录
	 * @param Request $request
	 * @return mixed
	 */
	public function login(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'email' => 'required|exists:users',
			'password' => 'required|between:6, 12'
		]);

		if ($validator->fails()) {
			return failed(['errors' => $validator->errors()->toArray()]);
		}

		$tokens = $this->authenticate();

		if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
			return succeed(['token' => $tokens, 'user' => Auth::user()]);
		}

		return failed('登录失败');
    }
}
