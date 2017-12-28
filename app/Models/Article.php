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

	public function tags()
	{
		return $this->hasMany(Tag::class);
	}
}
