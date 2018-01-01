<?php

namespace App\Repositories;

use App\Models\Article;

class ArticleRepository
{
	use BaseRepository;

	protected $model;

	public function __construct(Article $article)
	{
		$this->model = $article;
	}

	public function page($number = 10, $sort = 'desc', $sortColumn = 'created_at')
	{
		return $this->model->with('category')->orderBy($sortColumn, $sort)->paginate($number);
	}

	public function getById($id)
	{
		return $this->model->with(['category', 'articleTags'])->find($id);
	}
}