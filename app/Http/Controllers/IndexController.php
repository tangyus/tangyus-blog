<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Link;
use Illuminate\Http\Request;

class IndexController extends Controller
{
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

	public function archive()
	{
		$articles = Article::orderBy('published_at', 'desc')->paginate(10);

		return view('articles.archive', compact('articles'));
	}

    public function link()
    {
        return view('articles.links');
	}
}
