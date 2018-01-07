<?php

namespace App\Observer;

use App\Handlers\SlugTranslateHandler;
use App\Models\Article;

class ArticleObserver
{
	public function saving(Article $article)
	{
		if (!$article->slug) {
			$article->slug = app(SlugTranslateHandler::class)->translate($article->title);
		}
	}
}