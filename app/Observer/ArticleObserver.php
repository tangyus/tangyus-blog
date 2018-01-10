<?php

namespace App\Observer;

use App\Handlers\SlugTranslateHandler;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class ArticleObserver
{
	public function saving(Article $article)
	{
		if (!$article->slug) {
			$article->slug = app(SlugTranslateHandler::class)->translate($article->title);
		}
	}

	public function created(Article $article)
	{
		Category::where('id', $article->category_id)->increment('article_count', 1);
	}
}