<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;
use Laravel\Passport\RouteRegistrar;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

		// 目前只需要提供一个获取token的路由
		// 多平台认证时，请使用Passport::routes();
        Passport::routes(function (RouteRegistrar $routeRegistrar) {
			$routeRegistrar->forAccessTokens();
		}, ['prefix' => 'api/oauth']);

		Passport::tokensExpireIn(Carbon::now()->addDays(7));

		Passport::refreshTokensExpireIn(Carbon::now()->addDays(7));
    }
}
