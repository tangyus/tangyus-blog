<?php

namespace App\Http\Controllers;

use App\Handlers\ViewCountCacheHandler;
use App\Models\Article;
use App\Models\Category;
use App\Models\Link;
use App\Models\Tag;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
	/*
	 * 文章详情页面
	 * @param Request $request
	 * @param ViewCountCacheHandler $handler
	 * @param $id
	 */
	public function index(Request $request, ViewCountCacheHandler $handler, $id)
	{
		$article = Article::with(['category', 'articleTags'])->where('status', 20)->findOrFail($id);

		// 处理文章浏览量缓存
		$handler->incrementAndStoreViewCount($article);

        // markdown解析
		$parseDown = new \Parsedown();
		$article->content = $parseDown->text($article->content);

        // 获取文章的标签
        $tagIds = array();
		foreach ($article->articleTags->toArray() as $value) {
			$tagIds[] = $value['tag_id'];
		}

		$tags = Tag::whereIn('id', $tagIds)->get();

		// 当文章存在利于SEO优化的slug时，强制重定向到带有slug的url路由中
		if (!empty($article->slug) && $request->slug != $article->slug) {
			return redirect($article->link(), 301);
		}

		return view('articles.detail', compact('article', 'tags'));
    }

    /**
     * 文章分类页面
     * @param null $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function categories($id = null)
    {
        if ($id) {
            $categories = Category::with('tags')
                                ->where('id', $id)
                                ->get();
            $articles = Article::where('category_id', $categories[0]->id)
                                ->orderBy('published_at', 'desc')
                                ->paginate(5);

            if (!empty($articles)) {
                $parseDown = new \Parsedown();
                foreach ($articles as $key => $value) {
                    $articles[$key]->content = $parseDown->text($value->content);
                }
            }
        } else {
            $categories = Category::with('tags')->get();
            $articles = array();
        }

        return view('articles.categories', compact('categories', 'articles'));
    }
}
