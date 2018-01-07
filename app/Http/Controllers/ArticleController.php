<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Link;
use App\Models\Tag;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
	public function index(Request $request, $id)
	{
		$article = Article::with(['category', 'articleTags'])->findOrFail($id);

		$parseDown = new \Parsedown();
		$article->content = $parseDown->text($article->content);

		foreach ($article->articleTags->toArray() as $value) {
			$tagIds[] = $value['tag_id'];
		}

		$tags = Tag::whereIn('id', $tagIds)->get();
		$categories = Category::all();
		$links = Link::orderBy('rank', 'desc')->take(5)->get();

		// 当文章存在利于SEO优化的slug时，强制重定向到带有slug的url路由中
		if (!empty($article->slug) && $request->slug != $article->slug) {
			return redirect($article->link(), 301);
		}
		return view('articles.detail', compact('article', 'categories', 'links', 'tags'));
    }
}
