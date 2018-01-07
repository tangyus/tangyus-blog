<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
    	'title', 'content', 'category_id', 'author_id', 'status',
		'view_count', 'is_original', 'article_image', 'slug', 'published_at'
	];

	public function category()
	{
		return $this->belongsTo(Category::class);
	}

	public function articleTags()
	{
		return $this->hasMany(ArticleTag::class);
	}

	/**
	 * 利于SEO优化的链接
	 * @param array $params
	 * @return string
	 */
	public function link($params = [])
	{
		return route('article.index', array_merge([$this->id, $this->slug], $params));
	}
}
