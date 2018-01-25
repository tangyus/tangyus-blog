<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Link;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class IndexController extends Controller
{
    /**
     * 首页
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
	public function index()
	{
		// 文章数据放入内存，1h更新
		$articles_cache_key = 'articles_' . request()->get('page');
		Cache::remember($articles_cache_key, 60, function () {
			return Article::with('category')->orderBy('published_at', 'desc')->paginate(10);
		});
		$articles = $categories = Cache::get($articles_cache_key);

		$parseDown = new \Parsedown();
		foreach ($articles as $key => $value) {
			$articles[$key]->content = $parseDown->text($articles[$key]->content);
			$articles[$key]->published_at = Carbon::parse($articles[$key]->published_at);
		}

		// 文章分类和友链分别存放在内存中，过期时间分别为24h和6h
		Cache::remember('categories', 24 * 60, function () {
			return Category::all();
		});
		$categories = Cache::get('categories');

		Cache::remember('links', 6 * 60, function () {
			return Link::orderBy('rank', 'desc')->take(5)->get();
		});
		$links = Cache::get('links');

		return view('articles.index', compact('articles', 'categories', 'links'));
    }

    /**
     * 文章归档页面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
	public function archive()
	{
		$articles = Article::orderBy('published_at', 'desc')->paginate(10);

		return view('articles.archive', compact('articles'));
	}

	public function about()
	{
		return view('articles.about');
	}
}
