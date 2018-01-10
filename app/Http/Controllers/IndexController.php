<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Link;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * 首页
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
	public function index()
	{
		$articles = Article::orderBy('published_at', 'desc')->paginate(5);
		$parseDown = new \Parsedown();
		foreach ($articles as $key => $value) {
			$articles[$key]->content = $parseDown->text($articles[$key]->content);
		}
		$categories = Category::all();
		$links = Link::orderBy('rank', 'desc')->take(5)->get();

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
