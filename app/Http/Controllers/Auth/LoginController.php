<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

    protected function authenticateClient(Request $request) {
        $credentials = $this->credentials($request);

        $request->request->add([
            'grant_type' => env('grant_type', 'password'),
            'client_id' => env('client_id', '2'),
            'client_secret' => env('client_secret', 'V6m0OJWhY2AgFMJBoWMeA8geQfT3befxJ2YRmlrk'),
            'username' => $credentials['email'],
            'password' => $credentials['password'],
            'scope' => env('scope', '*')
        ]);

        $proxy = Request::create('oauth/token', 'POST');

        $response = Route::dispatch($proxy);
        dd($response);
        return $response;
    }

    protected function authenticated(Request $request) {
        return $this->authenticateClient($request);
    }

    protected function sendLoginResponse(Request $request) {
        $this->clearLoginAttempts($request);

        return $this->authenticated($request);
    }

    public function sendFailedLoginResponse(Request $request)
    {
        $msg = $request['errors'];
        $code = $request['code'];

        return $this->failed($msg, $code);
    }

    /**
     * 获取登录TOKEN
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
//    public function token(Request $request)
//    {
//        dd($request);
//        $username = $request->get('username');
//        $user = User::Where('email', $username)->first();
//
//        if ($user && ($user->status == 0)) {
//            throw  new UnauthorizedHttpException('', '账号已被禁用');
//        }
//
//        $client = new Client();
//        try {
//            $request = $client->request('POST', request()->root() . '/api/oauth/token', [
//                'form_params' => config('passport') + $request->only(array_keys($request->rules()))
//            ]);
//
//        } catch (RequestException $e) {
//            throw  new UnauthorizedHttpException('', '账号验证失败');
//        }
//
//        if ($request->getStatusCode() == 401) {
//            throw  new UnauthorizedHttpException('', '账号验证失败');
//        }
//        return response()->json($request->getBody()->getContents());
//    }

//    public function logout()
//    {
//        if (Auth::guard('api')->check()) {
//            Auth::guard('api')->user()->token()->delete();
//        }
//
//        return response()->json(['message' => '登出成功', 'status_code' => 200, 'data' => null]);
//    }
}
