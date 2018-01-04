<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\TagRequest;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;

class TagController extends Controller
{
	/**
	 * 获取分类下所有标签
	 * @param Request $request
	 * @return mixed
	 */
    public function allTag(Request $request)
    {
        $category_id = $request->input('category_id');
        $tags = Tag::where('category_id', $category_id)->get();

        if (!empty($tags)) {
            $data = ['success' => true, 'message' => '获取当前分类标签数据成功', 'data' => $tags];
        } else {
            $data = ['success' => false, 'message' => '获取当前分类标签数据失败', 'data' => []];
        }

        return Response::json($data);
    }

	/**
	 * 分页获取标签信息
	 * @return mixed
	 */
    public function index()
    {
        $tags = Tag::with('category')->orderBy('category_id')->paginate(10);

        if (!empty($tags)) {
            $data = ['success' => true, 'message' => '获取标签数据成功', 'data' => $tags];
        } else {
            $data = ['success' => false, 'message' => '获取标签数据失败', 'data' => []];
        }

        return Response::json($data);
    }

	/**
	 * 编辑标签
	 * @param $id
	 * @return mixed
	 */
    public function edit($id)
    {
        $tag = Tag::findOrFail($id);

        if (!empty($tag)) {
            $data = ['success' => true, 'message' => '获取标签数据成功', 'data' => $tag];
        } else {
            $data = ['success' => false, 'message' => '获取标签数据失败', 'data' => []];
        }

        return Response::json($data);
    }

	/**
	 * 保存更新标签
	 * @param TagRequest $request
	 * @param $id
	 * @return mixed
	 */
    public function update(TagRequest $request, $id)
    {
        $tag = Tag::findOrFail($id);
        $input = $request->all();

        if ($tag->fill($input)->save()) {
            $data = ['success' => true, 'message' => '修改保存标签成功'];
        } else {
            $data = ['success' => false, 'message' => '修改保存标签失败'];
        }

        return Response::json($data);
    }

	/**
	 * 创建标签
	 * @param TagRequest $request
	 * @return mixed
	 */
    public function store(TagRequest $request)
    {
        $input = $request->all();

        $tag = new Tag();
        if ($tag->fill($input)->save()) {
            $data = ['success' => true, 'message' => '创建标签成功'];
        } else {
            $data = ['success' => false, 'message' => '创建标签失败'];
        }

        return Response::json($data);
    }

	/**
	 * 删除标签
	 * @param $id
	 * @return mixed
	 */
    public function destroy($id)
    {
        $tag = Tag::findOrFail($id);

        if ($tag->delete()) {
            $data = ['success' => true, 'message' => '删除标签成功'];
        } else {
            $data = ['success' => false, 'message' => '删除标签失败'];
        }

        return Response::json($data);
    }
}
