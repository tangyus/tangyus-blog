<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\ArticleRequest;
use App\Models\Article;
use App\Models\ArticleTag;
use App\Repositories\ArticleRepository;
use Carbon\Carbon;
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

		$article = Article::find($id);
        $articleTags = new ArticleTag();
		if ($input['status'] == 20 && empty($input['published_at'])) {
			$input['published_at'] = Carbon::now();
		}

        foreach ($input['articleTags'] as $key => $value) {
            $articleTagsData[$key]['article_id'] = $id;
            $articleTagsData[$key]['tag_id'] = $value;
        }

        $article->fill($input);
        $articleTags->fill($articleTagsData);
        DB::transaction(function () use ($article, $articleTagsData) {
            $article->save();
            DB::table('article_tags')->insert($articleTagsData);
        });

//		if ($article->fill($input)->save()) {
//			$data = ['success' => true, 'message' => '修改文章数据成功'];
//		} else {
//			$data = ['success' => false, 'message' => '修改文章数据失败'];
//		}
		return Response::json(['success' => true, 'message' => '修改文章数据成功']);
	}

	/**
	 * 创建文章
	 * @param ArticleRequest $request
	 * @return mixed
	 */
	public function store(ArticleRequest $request)
	{
		$input = $request->all();

		// 上传的tags数组还未处理
		$input = array_merge($input, ['author_id' => Auth::id()]);
        dd($input);
		if ($input['status'] == 20) {
			$input['published_at'] = Carbon::now();
		}

		$article = new Article();
		if ($article->fill($input)->save()) {
			$data = ['success' => true, 'message' => '创建文章成功'];
		} else {
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
