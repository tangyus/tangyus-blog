<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
    	'name', 'desc', 'article_count'
	];

	public function articles()
	{
		return $this->hasMany(Article::class);
	}

	public function tags()
	{
		return $this->hasMany(Tag::class);
	}
}
