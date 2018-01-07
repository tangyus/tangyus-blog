<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\ArticleRequest;
use App\Models\Article;
use App\Repositories\ArticleRepository;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
	 * @param ArticleRequest $request
	 * @param $id
	 * @return mixed
	 */
	public function update(ArticleRequest $request ,$id)
	{
		$input = $request->all();

		$article = Article::with('articleTags')->find($id);
		if ($input['status'] == 20 && empty($input['published_at'])) {
			$input['published_at'] = Carbon::now();
		}

		// 原先文章的标签ID
		$oldArticleTagsId = array();
		$oldArticleTags = $article->toArray()['article_tags'];
		if (!empty($oldArticleTags)) {
			foreach ($oldArticleTags as $value) {
				$oldArticleTagsId[] = $value['tag_id'];
			}
		}

		DB::beginTransaction();
		try {
			// 修改文章信息
			$article->fill($input)->save();
			$needAddTagIds = array_diff($input['articleTags'], $oldArticleTagsId);// 需要新增的标签
			$needDeleteTagIds = array_diff($oldArticleTagsId, $input['articleTags']);//需要删除的标签

			// 新增标签
			if (!empty($needAddTagIds)) {
				$i = 0;
				foreach ($needAddTagIds as $value) {
					$addArticleTagsData[$i]['article_id'] = $id;
					$addArticleTagsData[$i]['tag_id'] = $value;
					$addArticleTagsData[$i]['created_at'] = Carbon::now();
					$addArticleTagsData[$i]['updated_at'] = $addArticleTagsData[$i]['created_at'];
					$i++;
				}

				DB::table('article_tags')->insert($addArticleTagsData);
			}

			// 删除标签
			if (!empty($needDeleteTagIds)) {
				foreach ($needDeleteTagIds as $value) {
					$deleteTagIds[] = $value;
				}

				DB::table('article_tags')->where('article_id', $id)->whereIn('tag_id', $deleteTagIds)->delete();
			}


			DB::commit();
			$data = ['success' => true, 'message' => '修改文章数据成功'];
		} catch (QueryException $e) {
			DB::rollback();
			$data = ['success' => false, 'message' => '修改文章数据失败'];
		}
		return Response::json($data);
	}

	/**
	 * 创建文章
	 * @param ArticleRequest $request
	 * @return mixed
	 */
	public function store(ArticleRequest $request)
	{
		$input = $request->all();

		$input = array_merge($input, ['author_id' => Auth::id()]);
		if ($input['status'] == 20) {
			$input['published_at'] = Carbon::now();
		}

		DB::beginTransaction();
		try {
			$article = Article::create($input);
			if ($article) {
				foreach ($input['articleTags'] as $key => $value) {
					$articleTagsData[$key]['article_id'] = $article->id;
					$articleTagsData[$key]['tag_id'] = $value;
					$articleTagsData[$key]['created_at'] = Carbon::now();
					$articleTagsData[$key]['updated_at'] = $articleTagsData[$key]['created_at'];
				}

				DB::table('article_tags')->insert($articleTagsData);
			}

			DB::commit();
			$data = ['success' => true, 'message' => '创建文章成功'];
		} catch (QueryException $e) {
			DB::rollback();
			$data = ['success' => false, 'message' => '创建文章失败'];
		}
		return Response::json($data);
	}

	/**
	 * 删除文章
	 * @param $id
	 * @return mixed
	 */
	public function destroy($id)
	{
		$article = Article::findOrFail($id);

		if ($article->delete()) {
			$data = ['success' => true, 'message' => '删除文章成功'];
		} else {
			$data = ['success' => false, 'message' => '删除文章失败'];
		}
		return Response::json($data);
	}
}
