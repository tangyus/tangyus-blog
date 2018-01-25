<?php

namespace App\Handlers;

use Illuminate\Support\Facades\Cache;

class ViewCountCacheHandler
{
	protected $cache_key = 'article_view_count_';
	protected $cache_expire = 24 * 60;

	/**
	 * 自增缓存数据或存储到数据库
	 * @param $article
	 */
	public function incrementAndStoreViewCount($article)
	{
		// 拼接文章浏览量的缓存key格式，类似article_view_count_1/article_view_count_2
		$this->cache_key = $this->cache_key . $article->id;

		Cache::remember($this->cache_key, $this->cache_expire, function () {
			return 0;
		});
		Cache::increment($this->cache_key);

		$count = Cache::get($this->cache_key);
		if ($count == 10) {
			$article->view_count = $article->view_count + $count;
			$article->save();

			Cache::forget($this->cache_key);
		}
	}
}