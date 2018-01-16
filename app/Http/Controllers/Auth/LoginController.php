<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

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

    use AuthenticatesUsers;

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
//	public function login(Request $request)
//	{
//		$validator = Validator::make($request->all(), [
//			'email' => 'required|exists:users',
//			'password' => 'required|between:6, 12'
//		]);
//
//		if ($validator->fails()) {
//			$request->request->add([
//				'errors' => $validator->errors()->toArray(),
//				'code' => 401
//			]);
//
//			return $this->sendFailedLoginResponse($request);
//		}
//
//		$credentials = $this->credentials($request);
//		if ($this->guard('api')->attempt($credentials, $request->has('remember'))) {
//			return $this->sendLoginResponse($request);
//		}
//
//		return $this->setStatusCode(401)->failed('登录失败');
//    }

//	public function logout(Request $request)
//	{
//		if (Auth::guard('api')->check()) {
//			Auth::guard('api')->user()->token()->revoke();
//		}
//
//		return $this->message('退出登录成功');
//    }


//    protected function authenticateClient(Request $request) {
//        $credentials = $this->credentials($request);
//
//        $request->request->add([
//            'grant_type' => env('grant_type', 'password'),
//            'client_id' => env('client_id', '2'),
//            'client_secret' => env('client_secret', 'uhJ1ixu3BEpPAO6ptDC7YNRibV214ShiX5mf1ohf'),
//            'username' => $credentials['email'],
//            'password' => $credentials['password'],
//            'scope' => env('scope', '*')
//        ]);
//
//        $proxy = Request::create('oauth/token', 'POST');
//
//        $response = Route::dispatch($proxy);
////        return $response;
//    }

//    protected function authenticated(Request $request) {
//        return $this->authenticateClient($request);
//    }
//
//    protected function sendLoginResponse(Request $request) {
//        $this->clearLoginAttempts($request);
//
//        return $this->authenticated($request);
//    }
//
//    public function sendFailedLoginResponse(Request $request)
//    {
//        $msg = $request['errors'];
//        $code = $request['code'];
//
//		dd($request['code']);
//        return $this->failed($msg, $code);
//    }
}
