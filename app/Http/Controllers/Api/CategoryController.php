<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;

class CategoryController extends Controller
{
	/**
	 * 获取所有分类信息
	 * @return mixed
	 */
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

	/**
	 * 分页获取分类信息
	 * @return mixed
	 */
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

	/**
	 * 编辑分类
	 * @param $id
	 * @return mixed
	 */
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

	/**
	 * 保存更新分类
	 * @param CategoryRequest $request
	 * @param $id
	 * @return mixed
	 */
    public function update(CategoryRequest $request, $id)
    {
        $input = $request->all();
        $category = Category::findOrFail($id);

        if ($category->fill($input)->save()) {
            $data = ['success' => true, 'message' => '保存分类成功'];
        } else {
            $data = ['success' => false, 'message' => '保存分类失败'];
        }
        return Response::json($data);
    }

	/**
	 * 创建分类
	 * @param CategoryRequest $request
	 * @return mixed
	 */
    public function store(CategoryRequest $request)
    {
        $input = $request->all();

        $category = new Category();
        if ($category->fill($input)->save()) {
            $data = ['success' => true, 'message' => '创建分类成功'];
        } else {
            $data = ['success' => false, 'message' => '创建分类失败'];
        }
        return Response::json($data);
    }

	/**
	 * 删除分类
	 * @param $id
	 * @return mixed
	 */
    public function destroy($id)
    {
        $category =  Category::findOrFail($id);

        if ($category->delete()) {
            $data = ['success' => true, 'message' => '删除分类成功'];
        } else {
            $data = ['success' => false, 'message' => '删除分类失败'];
        }
        return Response::json($data);
    }
}
