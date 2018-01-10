<?php

namespace App\Providers;

use App\Models\Article;
use App\Models\ExchangeLink;
use App\Notifications\ExchangeLinkSucceeded;
use App\Observer\ArticleObserver;
use App\Observer\ExchangeLinkObserver;
use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Carbon::setLocale('zh');
        Article::observe(ArticleObserver::class);
		ExchangeLink::observe(ExchangeLinkObserver::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
