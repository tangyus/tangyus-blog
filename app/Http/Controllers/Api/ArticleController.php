<?php

namespace App\Http\Controllers\Api;

use App\Repositories\ArticleRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;

class ArticleController extends Controller
{
    protected $article;

	public function __construct(ArticleRepository $article)
	{
		$this->article = $article;
	}

	public function index()
	{
		$articles = $this->article->page();

		if (!empty($articles)) {
			$data = ['success' => true, 'message' => '获取文章数据成功', 'data' => $articles];
		} else {
			$data = ['success' => false, 'message' => '获取文章数据失败', 'data' => []];
		}
		return Response::json($data);
	}

	public function edit($id)
	{
		$article = $this->article->getById($id);
		$article['category'] = $article->category();
		$article['tags'] = $article->tags();

		if (!empty($article)) {
			$data = ['success' => true, 'message' => '获取文章数据成功', 'data' => $article];
		} else {
			$data = ['success' => false, 'message' => '获取文章数据失败', 'data' => []];
		}
		return Response::json($data);
	}
}
