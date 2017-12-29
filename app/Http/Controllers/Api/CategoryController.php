<?php

namespace App\Http\Controllers\Api;

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
}
