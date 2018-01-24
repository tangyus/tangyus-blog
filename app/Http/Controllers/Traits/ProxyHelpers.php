<?php

namespace App\Http\Controllers\Traits;

use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\UnauthorizedException;

trait ProxyHelpers
{
	/**
	 * 模拟http请求，每次用户登录获取access_token
	 * @return mixed
	 */
	public function authenticate()
	{
		$client = new Client();

		try {
			$url = request()->root() . '/api/oauth/token';

			$params = array_merge(config('passport.proxy'), [
				'username' => request('email'),
				'password' => request('password')
			]);

			$respond = $client->request('POST', $url, ['form_params' => $params]);
		} catch (RequestException $exception) {
			throw new UnauthorizedException('请求token失败');
		}

		if ($respond->getStatusCode() !== 401) {
			try {
				DB::table('oauth_access_tokens')->where('expires_at', '<', Carbon::now())->delete();

				DB::table('oauth_refresh_tokens')
					->where('expires_at', '<', Carbon::now())
					->delete();
			} catch (QueryException $queryException) {
				throw new QueryException('清除token错误');
			}

			return json_decode($respond->getBody()->getContents(), true);
		}

		throw new UnauthorizedException('账号或密码错误');
	}
}