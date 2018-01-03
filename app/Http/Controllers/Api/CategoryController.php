<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;

class CategoryController extends Controller
{
    public function allCategory()
    {
        $categories = Category::all();

        if (!empty($categories)) {
            $data = ['success' => true, 'message' => '获取分类数据成功', 'data' => $categories];
        } else {
            $data = ['success' => false, 'message' => '获取分类数据失败', 'data' => []];
        }

        return Response::json($data);
    }

    public function index()
    {
        $categories = Category::paginate(10);

        if (!empty($categories)) {
            $data = ['success' => true, 'message' => '获取分类数据成功', 'data' => $categories];
        } else {
            $data = ['success' => false, 'message' => '获取分类数据失败', 'data' => []];
        }

        return Response::json($data);
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);

        if (!empty($category)) {
            $data = ['success' => true, 'message' => '获取分类数据成功', 'data' => $category];
        } else {
            $data = ['success' => false, 'message' => '获取分类数据失败', 'data' => []];
        }

        return Response::json($data);
    }

    public function update(CategoryRequest $request, $id)
    {
        $input = $request->all();
        $category = Category::findOrFail($id);

        if ($category->fill($input)->save()) {
            $data = ['success' => true, 'message' => '保存成功'];
        } else {
            $data = ['success' => false, 'message' => '保存失败'];
        }
        return Response::json($data);
    }

    public function store(CategoryRequest $request)
    {
        $input = $request->all();

        $category = new Category();
        if ($category->fill($input)->save()) {
            $data = ['success' => true, 'message' => '创建成功'];
        } else {
            $data = ['success' => false, 'message' => '创建失败'];
        }
        return Response::json($data);
    }

    public function destroy($id)
    {
        $category =  Category::findOrFail($id);

        if ($category->delete()) {
            $data = ['success' => true, 'message' => '删除成功'];
        } else {
            $data = ['success' => false, 'message' => '删除失败'];
        }
        return Response::json($data);
    }
}
