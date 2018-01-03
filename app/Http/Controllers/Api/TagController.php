<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\TagRequest;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;

class TagController extends Controller
{
    public function allTag(Request $request)
    {
        $category_id = $request->input('category_id');
        $tags = Tag::where('category_id', $category_id)->get();

        if (!empty($tags)) {
            $data = ['success' => true, 'message' => '获取标签数据成功', 'data' => $tags];
        } else {
            $data = ['success' => false, 'message' => '获取标签数据失败', 'data' => []];
        }

        return Response::json($data);
    }

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

    public function update(TagRequest $request, $id)
    {
        $tag = Tag::findOrFail($id);
        $input = $request->all();

        if ($tag->fill($input)->save()) {
            $data = ['success' => true, 'message' => '修改保存成功'];
        } else {
            $data = ['success' => false, 'message' => '修改保存失败'];
        }

        return Response::json($data);
    }

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
