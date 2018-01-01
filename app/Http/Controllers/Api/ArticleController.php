<?php

namespace App\Http\Controllers\Api;

use App\Models\Article;
use App\Repositories\ArticleRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class ArticleController extends Controller
{
    protected $article;

	public function __construct(ArticleRepository $article)
	{
		$this->article = $article;
	}

	/**
	 * 分页获取文章信息
	 * @return mixed
	 */
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

	/**
	 * 编辑文章
	 * @param $id
	 * @return mixed
	 */
	public function edit($id)
	{
		$article = $this->article->getById($id);

		if (!empty($article)) {
			$data = ['success' => true, 'message' => '获取文章数据成功', 'data' => $article];
		} else {
			$data = ['success' => false, 'message' => '获取文章数据失败', 'data' => []];
		}
		return Response::json($data);
	}

	/**
	 * 更新文章信息
	 * @param Request $request
	 * @param $id
	 * @return mixed
	 */
	public function update(Request $request ,$id)
	{
		$input = $request->all();
		$article = Article::find($id);

		if ($article->fill($input)->save()) {
			$data = ['success' => true, 'message' => '修改文章数据成功'];
		} else {
			$data = ['success' => false, 'message' => '修改文章数据失败'];
		}
		return Response::json($data);
	}

	public function store(Request $request)
	{
		$input = $request->all();
		$input = array_merge($input, ['author_id' => Auth::id()]);

		$article = new Article();
		if ($article->fill($input)->save()) {
			$data = ['success' => true, 'message' => '创建文章成功'];
		} else {
			$data = ['success' => false, 'message' => '创建文章失败'];
		}
		Response::json($data);
	}
}
