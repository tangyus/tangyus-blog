<?php

namespace App\Http\Controllers\Api;

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
}
